<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CustomerRequest;
use App\Services\Api\CustomerService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    use ApiResponseTrait;

    protected CustomerService $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    /**
     * Display a listing of customers.
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $perPage = $request->get('per_page', 10);
            $customers = $this->customerService->getAllCustomers($perPage);
            
            return $this->successResponse($customers, 'Customers retrieved successfully');
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to retrieve customers: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Store a newly created customer.
     */
    public function register(CustomerRequest $request): JsonResponse
    {
        try {
            $customer = $this->customerService->createCustomer($request->validated());
            
            return $this->successResponse($customer, 'Customer created successfully', 201);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to create customer: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Display the specified customer.
     */
    public function show(int $id): JsonResponse
    {
        try {
            $customer = $this->customerService->getCustomerById($id);
            
            return $this->successResponse($customer, 'Customer retrieved successfully');
        } catch (\Exception $e) {
            return $this->errorResponse('Customer not found', 404);
        }
    }

    /**
     * Update the specified customer.
     */
    public function update(CustomerRequest $request, int $id): JsonResponse
    {
        try {
            $customer = $this->customerService->updateCustomer($id, $request->validated());
            
            return $this->successResponse($customer, 'Customer updated successfully');
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to update customer: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified customer.
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $this->customerService->deleteCustomer($id);
            
            return $this->successResponse(null, 'Customer deleted successfully');
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to delete customer: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Search customers.
     */
    public function search(Request $request): JsonResponse
    {
        $request->validate([
            'keyword' => 'required|string|min:2',
            'per_page' => 'nullable|integer|min:1|max:100'
        ]);

        try {
            $perPage = $request->get('per_page', 10);
            $customers = $this->customerService->searchCustomers($request->keyword, $perPage);
            
            return $this->successResponse($customers, 'Search results retrieved successfully');
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to search customers: ' . $e->getMessage(), 500);
        }
    }
}