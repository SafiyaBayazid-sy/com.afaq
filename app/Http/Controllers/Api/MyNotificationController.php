<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MyNotificationController extends Controller
{
    use ApiResponseTrait;

    /**
     * List notifications for the authenticated customer.
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = (int) $request->get('per_page', 15);

        $notifications = Notification::query()
            ->where('user_id', $request->user()->id)
            ->latest()
            ->paginate($perPage);

        $notifications->setCollection(
            $notifications->getCollection()->map(fn (Notification $notification) => $this->serializeNotification($notification))
        );

        return $this->successResponse($notifications, 'Notifications retrieved successfully.');
    }

    /**
     * Mark one notification as read for the authenticated customer.
     */
    public function markAsRead(Request $request, Notification $notification): JsonResponse
    {
        if ($notification->user_id !== $request->user()->id) {
            return $this->errorResponse('Not allowed.', 403);
        }

        $notification->update(['is_read' => true]);

        return $this->successResponse($this->serializeNotification($notification), 'Notification marked as read.');
    }

    protected function serializeNotification(Notification $notification): array
    {
        return [
            'id' => $notification->id,
            'type' => $notification->type,
            'title' => $notification->title,
            'message' => $notification->message,
            'is_read' => (bool) $notification->is_read,
            'created_at' => $notification->created_at?->toDateTimeString(),
            'updated_at' => $notification->updated_at?->toDateTimeString(),
        ];
    }
}
