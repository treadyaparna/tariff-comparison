<?php
/**
 * User: Aparna Saha
 * Email: tready.aparna@gmail.com
 */

namespace App\Response;

use App\Enums\HttpStatus;
use Illuminate\Http\JsonResponse;

class ApiResponse
{
    /**
     * @param integer $code
     * @param string|null $message
     * @return JsonResponse
     */
    public static final function response(int $code, string $message = null): JsonResponse
    {
        return response()->json(array(
            'code' => $code,
            'message' => $message ?? HttpStatus::MESSAGES[$code]
        ), $code);
    }

    /**
     * @param string|null $message
     * @return JsonResponse
     */
    public static final function responseOK(string $message = null): JsonResponse
    {
        return self::response(
            code: HttpStatus::HTTP_OK,
            message: empty($message) ? 'OK' : $message
        );
    }

    /**
     * @param $data
     * @return JsonResponse
     */
    public static final function responseCreated($data): JsonResponse
    {
        return response()->json($data);
    }
}
