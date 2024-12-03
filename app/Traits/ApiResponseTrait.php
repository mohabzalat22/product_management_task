<?php

namespace App\Traits;

trait ApiResponseTrait {
    /**
     * Standarized success response instead of ApiResource
     * @param String message
     * @param Array data
     * @param  Integer status_code
     * @return Array ['success'=>true,'message','data'] with status_code
     * 
     */
    protected function successResponse($message='', $data = [], $status_code=200){
        return response()->json(
            [
                'success' => true,
                'message' => $message,
                'data' => $data,
            ],
            $status_code
        );
    }

    /**
     * Standarized error response instead of ApiResource
     * @param String message
     * @param Array data
     * @param  Integer status_code
     * @return Array ['success'=>false,'message','data'] with status_code
     * 
     */
    protected function errorResponse($message='', $data = [], $status_code=400){
        return response()->json(
            [
                'success' => false,
                'message' => $message,
                'data' => $data,
            ],
            $status_code
        );
    }
}