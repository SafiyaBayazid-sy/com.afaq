<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $userId = $this->route('customer') ? $this->route('customer') : null;

        return [
            // User fields
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($userId, 'id')
            ],
            'password' => $this->isMethod('post') ? ['required', 'string', 'min:8'] : ['sometimes', 'string', 'min:8'],
            'is_active' => ['sometimes', 'boolean'],

            // Customer fields
            'budget' => ['nullable', 'numeric', 'min:0', 'max:999999999999.99'],
            'phone' => [
                'required',
                'string',
                'max:20',
                Rule::unique('customers')->ignore($userId, 'user_id')
            ],
            'source' => ['nullable', Rule::in([
                'facebook', 'google_ad', 'snapchat',
                'tiktok', 'friend', 'google_search', 'other'
            ])],
            'preferred_property_type' => ['nullable', 'string', 'max:50'],
            'notes' => ['nullable', 'string'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            // User fields in Arabic
            'name.required' => 'حقل الاسم مطلوب.',
            'name.string' => 'الاسم يجب أن يكون نصاً.',
            'name.max' => 'الاسم لا يجب أن يتجاوز 255 حرفاً.',
            
            'email.required' => 'حقل البريد الإلكتروني مطلوب.',
            'email.email' => 'يجب إدخال بريد إلكتروني صالح.',
            'email.unique' => 'البريد الإلكتروني مسجل مسبقاً.',
            'email.max' => 'البريد الإلكتروني لا يجب أن يتجاوز 255 حرفاً.',
            
            'password.required' => 'كلمة المرور مطلوبة للعملاء الجدد.',
            'password.min' => 'كلمة المرور يجب أن تكون على الأقل 8 أحرف.',
            'password.string' => 'كلمة المرور يجب أن تكون نصاً.',
            
            'is_active.boolean' => 'حقل التفعيل يجب أن يكون صحيحاً أو خطأ.',

            // Customer fields in Arabic
            'budget.numeric' => 'الميزانية يجب أن تكون رقماً صحيحاً.',
            'budget.min' => 'الميزانية يجب أن تكون 0 على الأقل.',
            'budget.max' => 'الميزانية كبيرة جداً.',
            
            'phone.required' => 'رقم الهاتف مطلوب.',
            'phone.unique' => 'رقم الهاتف مسجل مسبقاً.',
            'phone.max' => 'رقم الهاتف لا يجب أن يتجاوز 20 رقماً.',
            
            'source.in' => 'الرجاء اختيار مصدر صحيح. المصادر المسموحة: فيسبوك، إعلان جوجل، سناب شات، تيك توك، صديق، بحث جوجل، آخر',
            
            'preferred_property_type.string' => 'نوع العقار المفضل يجب أن يكون نصاً.',
            'preferred_property_type.max' => 'نوع العقار المفضل لا يجب أن يتجاوز 50 حرفاً.',
            
            'notes.string' => 'الملاحظات يجب أن تكون نصاً.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'name' => 'الاسم',
            'email' => 'البريد الإلكتروني',
            'password' => 'كلمة المرور',
            'is_active' => 'حالة التفعيل',
            'budget' => 'الميزانية',
            'phone' => 'رقم الهاتف',
            'source' => 'المصدر',
            'preferred_property_type' => 'نوع العقار المفضل',
            'notes' => 'الملاحظات',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        if ($this->has('is_active') && is_string($this->is_active)) {
            $this->merge([
                'is_active' => $this->is_active === 'true' || $this->is_active === '1',
            ]);
        }
        
        // تنظيف رقم الهاتف إذا لزم الأمر (إزالة المسافات)
        if ($this->has('phone')) {
            $this->merge([
                'phone' => preg_replace('/\s+/', '', $this->phone),
            ]);
        }
    }
}