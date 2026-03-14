<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProjectApiController extends Controller
{
    use ApiResponseTrait;

    public function index(Request $request): JsonResponse
    {
        $perPage = (int) $request->get('per_page', 10);

        $query = Project::query()->with('images');

        if (! $request->boolean('include_inactive')) {
            $query->where('is_active', true);
        }

        $projects = $query->latest()->paginate($perPage);

        return $this->successResponse($projects, 'Projects retrieved successfully.');
    }

    public function show(Project $project): JsonResponse
    {
        return $this->successResponse(
            $project->load('images', 'mainImage'),
            'Project retrieved successfully.'
        );
    }
}
