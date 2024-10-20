<?php

namespace App\Helpers;

class ResponseHelper
{
  public static function success($data, $message = 'Success', $code = 200)
  {
    return response()->json([
      'status' => 'success',
      'message' => $message,
      'data' => $data,
    ], $code);
  }

  public static function error($message = 'Something went wrong', $code = 400)
  {
    return response()->json([
      'status' => 'error',
      'message' => $message,
    ], $code);
  }

  public static function paginated($paginatedData, $message = 'Success', $code = 200)
  {
    $formattedData = [
      'items' => $paginatedData->items(),
      'pagination' => [
        'total' => $paginatedData->total(),
        'count' => $paginatedData->count(),
        'per_page' => $paginatedData->perPage(),
        'current_page' => $paginatedData->currentPage(),
        'total_pages' => $paginatedData->lastPage(),
        'next_page_url' => $paginatedData->nextPageUrl(),
        'prev_page_url' => $paginatedData->previousPageUrl(),
      ],
    ];

    return self::success($formattedData, $message, $code);
  }
}
