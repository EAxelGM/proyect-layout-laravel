<?php
namespace App\Traits;

trait ApiResponse{
  public function successResponse($data = null, $message = '', $code = 200){
    return response()->json([
      'message' => $message,
      'data' => $data,
      'code' => $code
    ], $code);
}

public function errorResponse($message = '', $code = 500, $data = null){
    return response()->json([
      'message' => $message,
      'data' => $data,
      'code' => $code
    ], $code);
} 
}