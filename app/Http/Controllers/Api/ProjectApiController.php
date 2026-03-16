<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProjectApiController extends Controller
{
    use ApiResponseTrait;

    /**
     * Browse customer-facing projects with search, filtering, sorting, and pagination.
     */
    public function index(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'per_page' => ['nullable', 'integer', 'min:1', 'max:50'],
            'search' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'project_status' => ['nullable', Rule::in(['on_hold', 'in_progress', 'completed'])],
            'project_type' => ['nullable', Rule::in(['renovation', 'construction'])],
            'property_type' => ['nullable', Rule::in(['villa', 'building', 'floor', 'apartment', 'land'])],
            'min_price' => ['nullable', 'numeric', 'min:0'],
            'max_price' => ['nullable', 'numeric', 'min:0'],
            'sort_by' => ['nullable', Rule::in(['created_at', 'name', 'price'])],
            'sort_direction' => ['nullable', Rule::in(['asc', 'desc'])],
            'include_inactive' => ['nullable', 'boolean'],
        ]);

        $perPage = (int) ($validated['per_page'] ?? 10);

        $query = Project::query()->with('images');

        if (! $request->boolean('include_inactive')) {
            $query->where('is_active', true);
        }

        if (! empty($validated['search'])) {
            $search = trim($validated['search']);

            $query->where(function ($projectQuery) use ($search): void {
                $projectQuery
                    ->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('city', 'like', "%{$search}%")
                    ->orWhere('state', 'like', "%{$search}%")
                    ->orWhere('country', 'like', "%{$search}%")
                    ->orWhere('street', 'like', "%{$search}%");
            });
        }

        if (! empty($validated['city'])) {
            $query->byCity($validated['city']);
        }

        if (! empty($validated['project_status'])) {
            $query->byStatus($validated['project_status']);
        }

        if (! empty($validated['project_type'])) {
            $query->byType($validated['project_type']);
        }

        if (! empty($validated['property_type'])) {
            $query->byPropertyType($validated['property_type']);
        }

        if (array_key_exists('min_price', $validated)) {
            $query->where('price', '>=', $validated['min_price']);
        }

        if (array_key_exists('max_price', $validated)) {
            $query->where('price', '<=', $validated['max_price']);
        }

        $sortBy = $validated['sort_by'] ?? 'created_at';
        $sortDirection = $validated['sort_direction'] ?? 'desc';

        $projects = $query
            ->orderBy($sortBy, $sortDirection)
            ->paginate($perPage)
            ->appends($request->query());

        $projects->setCollection(
            $projects->getCollection()->map(fn (Project $project) => $this->serializeProject($project))
        );

        return $this->successResponse($projects, 'Projects retrieved successfully.');
    }

    /**
     * Return the allowed filter values the mobile app can use for project discovery.
     */
    public function filters(): JsonResponse
    {
        return $this->successResponse([
            'project_statuses' => [
                ['value' => 'on_hold', 'label' => 'On Hold'],
                ['value' => 'in_progress', 'label' => 'In Progress'],
                ['value' => 'completed', 'label' => 'Completed'],
            ],
            'project_types' => [
                ['value' => 'renovation', 'label' => 'Renovation'],
                ['value' => 'construction', 'label' => 'Construction'],
            ],
            'property_types' => [
                ['value' => 'villa', 'label' => 'Villa'],
                ['value' => 'building', 'label' => 'Building'],
                ['value' => 'floor', 'label' => 'Floor'],
                ['value' => 'apartment', 'label' => 'Apartment'],
                ['value' => 'land', 'label' => 'Land'],
            ],
            'sort_options' => [
                ['value' => 'created_at', 'label' => 'Newest'],
                ['value' => 'name', 'label' => 'Name'],
                ['value' => 'price', 'label' => 'Price'],
            ],
        ], 'Project filters retrieved successfully.');
    }

    /**
     * Show a single project with its image gallery.
     */
    public function show(Project $project): JsonResponse
    {
        return $this->successResponse(
            $this->serializeProject($project->load('images', 'mainImage')),
            'Project retrieved successfully.'
        );
    }

    protected function serializeProject(Project $project): array
    {
        $project->loadMissing('images', 'mainImage');

        return [
            'id' => $project->id,
            'name' => $project->name,
            'description' => $project->description,
            'country' => $project->country,
            'state' => $project->state,
            'city' => $project->city,
            'street' => $project->street,
            'full_address' => $project->full_address,
            'price' => $project->price,
            'formatted_price' => $project->formatted_price,
            'project_status' => $project->project_status,
            'project_status_text' => $project->status_text,
            'project_type' => $project->project_type,
            'project_type_text' => $project->project_type_text,
            'property_type' => $project->property_type,
            'property_type_text' => $project->property_type_text,
            'map_location' => $project->map_location,
            'video_url' => $project->video_url,
            'is_active' => (bool) $project->is_active,
            'main_image' => $project->mainImage?->image_path,
            'images' => $project->images->map(fn ($image) => [
                'id' => $image->id,
                'image_path' => $image->image_path,
                'is_main' => (bool) $image->is_main,
            ])->values()->all(),
            'created_at' => $project->created_at?->toDateTimeString(),
            'updated_at' => $project->updated_at?->toDateTimeString(),
        ];
    }
}
