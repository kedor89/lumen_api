<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 *
 */
class EmployeeControler
{

    /**
     * Get employee data from database by id
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $results = Employee::find($id);
        return response()->json($results);
    }


    /**
     * Create employee / add employee to database
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'last_name' => 'required',
            'city' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => 0,
                'message' => $validator->errors(),
            ], 400);
        }

        try {
            $employee = new Employee([
                'name' => $request->get('name'),
                'last_name' => $request->get('last_name'),
                'city' => $request->get('city'),
                'phone' => $request->get('phone')
            ]);

            $employee->save();
            return response()->json([
                'success' => 1,
                'message' => 'Employee added',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => 0,
                'message' => 'Failed to add employee',
            ], 400);
        }

    }

    /**
     * Get employee data from database by id
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $employee = Employee::find($id);
        if ($employee === null) {
            return response()->json([
                'success' => 0,
                'message' => 'No employee with provided id'
            ]);
        }

        try {
            $employee = Employee::find($id);
            $employee->delete();

            return response()->json([
                'success' => 1,
                'message' => 'Employee deleted',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => 0,
                'message' => 'Failed to delete selected employee',
            ]);
        }
    }

    /**
     * Update employee in database
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'last_name' => 'required',
            'city' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => 0,
                'message' => $validator->errors(),
            ], 400);
        }

        $employee = Employee::find($id);
        if ($employee === null) {
            return response()->json([
                'success' => 0,
                'message' => 'No employee with provided id'
            ]);
        }

        try {
            Employee::find($id)->update($request->all());

            return response()->json([
                'success' => 1,
                'message' => 'Employee updated',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => 0,
                'message' => 'Failed to update employee',
            ]);
        }
    }
}
