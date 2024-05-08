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
     * @param string|null $msg
     * @return JsonResponse
     */
    public static final function response(int $code, string $msg = null): JsonResponse
    {
        return response()->json(array(
            'code' => $code,
            'message' => $msg ?? HttpStatus::MESSAGES[$code]
        ), $code);
    }

    /**
     * @param string|null $msg
     * @return JsonResponse
     */
    public static final function responseOK(string $msg = null): JsonResponse
    {
        return self::response(
            code: HttpStatus::HTTP_OK,
            msg: empty($msg) ? 'OK' : $msg
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
