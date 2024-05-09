<?php

namespace App\Http\Controllers;

use App\Enums\HttpStatus;
use App\Http\Requests\TariffComparisonRequest;
use App\Response\ApiResponse;
use App\Services\TariffComparisonService;
use Dingo\Api\Exception\ResourceException;
use Exception;
use Illuminate\Http\JsonResponse;
use InvalidArgumentException;

class TariffComparisonController extends Controller
{
    public function __construct(private readonly TariffComparisonService $comparisonService) {}

    /**
     * @OA\Post(
     *   path="/api/compare-tariffs",
     *   summary="Compare Annual Tariffs based on given consumption",
     *   tags={"compare-tariffs"},
     *   operationId="tariffComparison",
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
    public function tariffComparison(TariffComparisonRequest $request): JsonResponse
    {
        $consumption = $request->input('consumption');

        try {
            return ApiResponse::responseCreated($this->comparisonService->calculateAnnualCosts($consumption));
        } catch (ResourceException $e) {
            return ApiResponse::response(HttpStatus::CANT_COMPLETE_REQUEST, $e->getMessage());
        } catch (InvalidArgumentException $e) {
            return ApiResponse::response(HttpStatus::CANT_COMPLETE_VALIDATION, $e->getMessage());
        } catch (Exception $e) {
            return ApiResponse::response($e->getCode(), $e->getMessage());
        }
    }

}
