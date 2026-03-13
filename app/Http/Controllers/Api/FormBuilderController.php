<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\FormBuilder\FormBuilderService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class FormBuilderController extends Controller
{
    use ApiResponseTrait;

    public function show(string $slug, FormBuilderService $formBuilderService): JsonResponse
    {
        $template = $formBuilderService->getPublishedTemplateBySlug($slug);

        if (! $template) {
            return $this->errorResponse('Form not found or inactive.', 404);
        }

        return $this->successResponse(
            $formBuilderService->serializeTemplate($template),
            'Form retrieved successfully.'
        );
    }

    public function submit(Request $request, string $slug, FormBuilderService $formBuilderService): JsonResponse
    {
        $template = $formBuilderService->getPublishedTemplateBySlug($slug);

        if (! $template) {
            return $this->errorResponse('Form not found or inactive.', 404);
        }

        try {
            $submission = $formBuilderService->submit(
                $template,
                $request->all(),
                auth('sanctum')->user() ?? $request->user()
            );

            return $this->successResponse([
                'submission_id' => $submission->id,
                'form_template_id' => $submission->form_template_id,
                'customer_id' => $submission->customer_id,
                'submitted_at' => $submission->submitted_at?->toDateTimeString(),
            ], $template->success_message ?: 'Form submitted successfully.', 201);
        } catch (ValidationException $exception) {
            return $this->errorResponse(
                'Validation failed.',
                422,
                $exception->errors()
            );
        } catch (\Throwable $exception) {
            report($exception);

            return $this->errorResponse('Unable to submit this form right now.', 500);
        }
    }
}

