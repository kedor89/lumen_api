<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 *
 */
class CompanyControler
{

    /**
     * Get company data from database by id
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $results = Company::find($id);
        return response()->json($results);
    }


    /**
     * Create company / add company to database
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'nip' => 'required',
            'address' => 'required',
            'city' => 'required',
            'postal_code' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => 0,
                'message' => $validator->errors(),
            ], 400);
        }

        try {
            $company = new Company([
                'name' => $request->get('name'),
                'nip' => $request->get('nip'),
                'address' => $request->get('address'),
                'city' => $request->get('city'),
                'postal_code' => $request->get('postal_code')
            ]);

            $company->save();
            return response()->json([
                'success' => 1,
                'message' => 'Company added',
            ]);
        } catch (Exception $e) {
            echo $e->getMessage();
            return response()->json([
                'success' => 0,
                'message' => 'Failed to add company',
            ], 400);
        }

    }

    /**
     * Get Company data from database by id
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $company = Company::find($id);
        if ($company === null) {
            return response()->json([
                'success' => 0,
                'message' => 'No company with provided id'
            ]);
        }

        try {
            $company = Company::find($id);
            $company->delete();

            return response()->json([
                'success' => 1,
                'message' => 'Company deleted',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => 0,
                'message' => 'Failed to delete selected company',
            ]);
        }
    }

    /**
     * Update company in database
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'nip' => 'required',
            'address' => 'required',
            'city' => 'required',
            'postal_code' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => 0,
                'message' => $validator->errors(),
            ], 400);
        }

        $company = Company::find($id);
        if ($company === null) {
            return response()->json([
                'success' => 0,
                'message' => 'No company with provided id'
            ]);
        }

        try {
            Company::find($id)->update([
                'name' => $request->get('name'),
                'nip' => $request->get('nip'),
                'address' => $request->get('address'),
                'city' => $request->get('city'),
                'postal_code' => $request->get('postal_code')
            ]);


            return response()->json([
                'success' => 1,
                'message' => 'Company updated',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => 0,
                'message' => 'Failed to update company',
            ]);
        }
    }
}
