<?php

namespace App\Http\Controllers;

use App\Enums\HttpStatus;
use App\Http\Requests\CompareTariffRequest;
use App\Response\ApiResponse;
use App\Services\ComparisonService;
use Carbon\Carbon;
use Dingo\Api\Exception\ResourceException;
use Dingo\Api\Exception\ValidationHttpException;
use Exception;
use Illuminate\Http\JsonResponse;
use InvalidArgumentException;

class ComparisonController extends Controller
{
    public function __construct(private ComparisonService $comparisonService) {}

    /**
     * @OA\Post(
     *   path="/api/tariff-comparison",
     *   summary="Compare tariffs",
     *   tags={"tariff-comparison"},
     *   operationId="compareTariff",
     *   @OA\RequestBody(
     *     @OA\JsonContent(
     *       ref="#/components/schemas/TariffComparison",
     *       example={
     *         "consumption": 1000
     *       }
     *     )
     *   ),
     *   @OA\Response(
     *     response=201,
     *     description="Successful operation",
     *     @OA\JsonContent(ref="#/components/schemas/TariffComparison")
     *   ),
     *   @OA\Response(
     *     response=500,
     *     description="Internal server error",
     *     @OA\JsonContent(
     *       @OA\Property(property="message", type="string"),
     *       @OA\Property(property="errors", type="object")
     *     )
     *   ),
     * )
     */
    public function compareTariff(CompareTariffRequest $request): JsonResponse
    {
        $consumption = $request->input('consumption');

        try {
           // return $this->comparisonService->compareTariff($consumption);
           // return ApiResponse::response(HttpStatus::HTTP_OK, $this->comparisonService->getTariffs());
            return ApiResponse::responseCreated($this->comparisonService->getTariffs());
           // return ApiResponse::responseCreated($this->comparisonService->getTariffTypes());
        } catch (ResourceException $e) {
            return ApiResponse::response(HttpStatus::CANT_COMPLETE_REQUEST, $e->getMessage());
        } catch (InvalidArgumentException $e) {
            return ApiResponse::response(HttpStatus::CANT_COMPLETE_VALIDATION, $e->getMessage());
        } catch (Exception $e) {
            return ApiResponse::response($e->getCode(), $e->getMessage());
        }
    }

}
