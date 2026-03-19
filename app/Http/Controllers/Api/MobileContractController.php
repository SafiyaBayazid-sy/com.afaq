<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Project;
use App\Models\ServiceOrder;
use App\Models\User;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class MobileContractController extends Controller
{
    use ApiResponseTrait;

    /**
     * Register a customer account using the exact contract requested by the mobile PDF.
     */
    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make(
            $request->all(),
            [
                'full_name' => ['required_without:name', 'string', 'max:255'],
                'name' => ['nullable', 'string', 'max:255'],
                'phone' => ['required', 'string', 'max:20', 'regex:/^0[0-9]{8,14}$/', 'unique:customers,phone'],
                'email' => ['required', 'email', 'max:255', 'unique:users,email'],
                'password' => ['required', 'string', 'min:8'],
                'source' => ['nullable', Rule::in([
                    'social_media',
                    'friends',
                    'ads',
                    'other',
                    'facebook',
                    'google_ad',
                    'snapchat',
                    'tiktok',
                    'friend',
                    'google_search',
                ])],
            ],
            [
                'full_name.required_without' => 'الاسم الكامل للمستخدم مطلوب',
                'phone.required' => 'رقم الهاتف مطلوب',
                'phone.regex' => 'رقم الهاتف غير صحيح',
                'phone.unique' => 'رقم الهاتف مستخدم مسبقاً',
                'email.required' => 'البريد الإلكتروني مطلوب',
                'email.email' => 'يرجى إدخال بريد إلكتروني صحيح',
                'email.unique' => 'البريد الإلكتروني مستخدم مسبقاً',
                'password.required' => 'كلمة المرور مطلوبة',
                'password.min' => 'كلمة المرور يجب أن تكون 8 أحرف على الأقل',
                'source.in' => 'قيمة حقل المصدر غير مدعومة',
            ]
        );

        if ($validator->fails()) {
            return $this->errorResponse('البيانات المدخلة غير صحيحة', 422, $validator->errors()->toArray());
        }

        $validated = $validator->validated();
        $fullName = $validated['full_name'] ?? $validated['name'];

        $data = DB::transaction(function () use ($validated, $fullName) {
            $user = User::create([
                'name' => $fullName,
                'email' => $validated['email'],
                'password' => $validated['password'],
                'user_type' => 'customer',
                'is_active' => true,
            ]);

            $customer = Customer::create([
                'user_id' => $user->id,
                'phone' => $validated['phone'],
                'source' => $this->normalizeSource($validated['source'] ?? 'other'),
            ]);

            $token = $user->createToken('mobile-contract-token', ['*'])->plainTextToken;

            return [
                'token' => $token,
                'user' => $this->serializeContractUser($user, $customer),
            ];
        });

        return $this->successResponse($data, 'تم إنشاء الحساب بنجاح', 201);
    }

    /**
     * Log in a customer using the exact contract requested by the mobile PDF.
     */
    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email' => ['required', 'email'],
                'password' => ['required', 'string'],
            ],
            [
                'email.required' => 'البريد الإلكتروني مطلوب',
                'email.email' => 'يرجى إدخال بريد إلكتروني صحيح',
                'password.required' => 'كلمة المرور مطلوبة',
            ]
        );

        if ($validator->fails()) {
            return $this->errorResponse('توجد أخطاء في البيانات المرسلة', 422, $validator->errors()->toArray());
        }

        $validated = $validator->validated();

        $user = User::query()
            ->with('customerProfile')
            ->where('email', $validated['email'])
            ->where('user_type', 'customer')
            ->where('is_active', true)
            ->first();

        if (! $user || ! Hash::check($validated['password'], $user->password)) {
            return $this->errorResponse('البريد الإلكتروني أو كلمة المرور غير صحيحة', 401);
        }

        $user->tokens()->delete();
        $token = $user->createToken('mobile-contract-token', ['*'])->plainTextToken;

        return $this->successResponse([
            'token' => $token,
            'user' => $this->serializeContractUser($user, $user->customerProfile),
        ], 'تم تسجيل الدخول بنجاح');
    }

    /**
     * Return the simplified project list required by the mobile PDF contract.
     */
    public function projects(): JsonResponse
    {
        $projects = Project::query()
            ->with('mainImage')
            ->where('is_active', true)
            ->latest()
            ->get()
            ->map(fn (Project $project) => [
                'id' => $project->id,
                'title' => $project->name,
                'description' => $project->description,
                'image_url' => $project->mainImage?->image_path ?? $project->first_image,
            ])
            ->values();

        return $this->successResponse($projects, 'تم جلب المشاريع بنجاح');
    }

    /**
     * Store a mobile engineering inspection request.
     */
    public function storeInspection(Request $request): JsonResponse
    {
        $validator = Validator::make(
            $request->all(),
            [
                'authorized_person' => ['required', 'string', 'max:255'],
                'agent_phone' => ['required', 'string', 'max:20', 'regex:/^0[0-9]{8,14}$/'],
                'owner_phone' => ['nullable', 'string', 'max:20', 'regex:/^0[0-9]{8,14}$/'],
                'description' => ['required', 'string'],
                'address' => ['required', 'string', 'max:1000'],
            ],
            [
                'authorized_person.required' => 'اسم الوكيل المفوض مطلوب',
                'agent_phone.required' => 'رقم هاتف الوكيل مطلوب',
                'agent_phone.regex' => 'تنسيق رقم الهاتف غير صحيح',
                'owner_phone.regex' => 'تنسيق رقم الهاتف غير صحيح',
                'description.required' => 'وصف الحالة مطلوب',
                'address.required' => 'يرجى تحديد الموقع على الخريطة بدقة',
            ]
        );

        if ($validator->fails()) {
            return $this->errorResponse('يوجد نقص في بيانات الطلب', 422, $validator->errors()->toArray());
        }

        $user = $request->user();
        $order = ServiceOrder::create([
            'user_id' => $user->id,
            'customer_id' => $user->customerProfile?->id,
            'order_type' => 'inspection',
            'title' => 'طلب معاينة هندسية',
            'status' => 'pending',
            'status_text' => 'قيد الانتظار',
            'authorized_person' => $request->string('authorized_person')->toString(),
            'agent_phone' => $request->string('agent_phone')->toString(),
            'owner_phone' => $request->string('owner_phone')->toString(),
            'description' => $request->string('description')->toString(),
            'address' => $request->string('address')->toString(),
            'location' => $request->string('address')->toString(),
            'submitted_at' => now(),
        ]);

        return $this->successResponse([
            'inspection_id' => $order->id,
            'status' => 'pending',
            'submission_date' => $order->submitted_at?->toDateString(),
        ], 'تم استلام طلب المعاينة بنجاح، وسنتواصل معكم بعد دراسة الموقع', 201);
    }

    /**
     * Store a mobile engineering consultation request.
     */
    public function storeConsultation(Request $request): JsonResponse
    {
        $validator = Validator::make(
            $request->all(),
            [
                'full_name' => ['required', 'string', 'max:255'],
                'phone_number' => ['required', 'string', 'max:20', 'regex:/^0[0-9]{8,14}$/'],
                'consultation_type' => ['required', 'string', 'max:255'],
                'question' => ['required', 'string'],
            ],
            [
                'full_name.required' => 'اسم صاحب الاستشارة مطلوب',
                'phone_number.required' => 'رقم الهاتف مطلوب',
                'phone_number.regex' => 'تنسيق رقم الهاتف غير صحيح',
                'consultation_type.required' => 'نوع الاستشارة مطلوب',
                'question.required' => 'نص السؤال أو الاستفسار مطلوب',
            ]
        );

        if ($validator->fails()) {
            return $this->errorResponse('البيانات المدخلة غير صحيحة', 422, $validator->errors()->toArray());
        }

        $user = $request->user();
        $order = ServiceOrder::create([
            'user_id' => $user->id,
            'customer_id' => $user->customerProfile?->id,
            'order_type' => 'consultation',
            'title' => 'طلب استشارة هندسية',
            'status' => 'pending',
            'status_text' => 'قيد الانتظار',
            'consultation_full_name' => $request->string('full_name')->toString(),
            'consultation_phone_number' => $request->string('phone_number')->toString(),
            'consultation_type' => $request->string('consultation_type')->toString(),
            'question' => $request->string('question')->toString(),
            'submitted_at' => now(),
        ]);

        return $this->successResponse([
            'consultation_id' => $order->id,
            'status' => 'assigned_soon',
        ], 'تم استلام استفسارك بنجاح. سنقوم بتعيين مهندس مختص وسيتواصل معك عبر الواتساب للرد على استفسارك في أقرب وقت', 201);
    }

    /**
     * List the authenticated customer's service orders.
     */
    public function orders(Request $request): JsonResponse
    {
        $orders = ServiceOrder::query()
            ->where('user_id', $request->user()->id)
            ->latest('submitted_at')
            ->latest('id')
            ->get()
            ->map(fn (ServiceOrder $order) => [
                'id' => $order->id,
                'title' => $order->title,
                'status' => $order->status,
                'status_text' => $order->status_text ?? $this->statusText($order),
            ])
            ->values();

        return $this->successResponse($orders);
    }

    /**
     * Show a single order in the PDF-compatible response shape.
     */
    public function showOrder(Request $request, int $id): JsonResponse
    {
        $order = ServiceOrder::query()
            ->where('user_id', $request->user()->id)
            ->find($id);

        if (! $order) {
            return $this->errorResponse('الطلب غير موجود', 404);
        }

        return $this->successResponse([
            'id' => $order->id,
            'title' => $order->title,
            'status' => $order->status,
            'status_text' => $this->detailStatusText($order),
            'agent_name' => $order->agent_name,
            'location' => $order->location ?? $order->address,
            'report_url' => $order->report_url,
            'timeline' => $this->buildTimeline($order),
        ]);
    }

    protected function serializeContractUser(User $user, ?Customer $customer): array
    {
        return [
            'id' => $user->id,
            'full_name' => $user->name,
            'phone' => $customer?->phone,
            'email' => $user->email,
        ];
    }

    protected function normalizeSource(string $source): string
    {
        return match ($source) {
            'social_media' => 'facebook',
            'friends' => 'friend',
            'ads' => 'google_ad',
            default => $source,
        };
    }

    protected function statusText(ServiceOrder $order): string
    {
        if ($order->status_text) {
            return $order->status_text;
        }

        return match ($order->status) {
            'completed' => 'مكتمل',
            'processing' => 'قيد التنفيذ',
            'rejected' => 'مرفوض',
            default => 'قيد الانتظار',
        };
    }

    protected function detailStatusText(ServiceOrder $order): string
    {
        if ($order->order_type === 'inspection') {
            return match ($order->status) {
                'completed' => 'تم الانتهاء من المعاينة',
                'processing' => 'قيد المعاينة الميدانية',
                'rejected' => 'تم رفض الطلب',
                default => 'قيد الانتظار',
            };
        }

        return match ($order->status) {
            'completed' => 'تمت الاستشارة',
            'processing' => 'قيد مراجعة الاستشارة',
            'rejected' => 'تم إغلاق الطلب',
            default => 'بانتظار التعيين',
        };
    }

    protected function buildTimeline(ServiceOrder $order): array
    {
        $finalLabel = $order->order_type === 'inspection'
            ? 'تم إصدار التقرير النهائي'
            : 'تمت معالجة الاستشارة';

        return [
            [
                'status' => 'pending',
                'label' => 'تم استلام الطلب',
                'is_completed' => true,
                'date' => $order->submitted_at?->toDateString(),
            ],
            [
                'status' => 'processing',
                'label' => $order->order_type === 'inspection' ? 'قيد المعاينة الميدانية' : 'قيد مراجعة الاستشارة',
                'is_completed' => in_array($order->status, ['processing', 'completed'], true),
                'date' => $order->processed_at?->toDateString(),
            ],
            [
                'status' => 'completed',
                'label' => $finalLabel,
                'is_completed' => $order->status === 'completed',
                'date' => $order->completed_at?->toDateString(),
            ],
        ];
    }
}
