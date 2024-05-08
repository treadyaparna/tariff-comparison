<?php

namespace App\Http\Resources;


use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class TariffComparisonResource
 * @author Aparna Saha <tready.aparna@gmail.com>
 * @package App\Http\Resources\TariffComparisonResource
 * @OA\Schema(schema="TariffComparison", type="object")
 */
class TariffComparisonResource extends JsonResource
{
    /**
     * @OA\Schema(
     *     schema="TariffComparison",
     *     type="object",
     *     @OA\Property(
     *         property="consumption",
     *         type="integer",
     *         description="The consumption value",
     *         example=1000
     *     ),
     *     @OA\Property(
     *         property="tariffs",
     *         type="array",
     *         @OA\Items(
     *             type="object",
     *             @OA\Property(property="name", type="string", example="basic electricity tariff"),
     *             @OA\Property(property="annualCosts", type="integer", example=830)
     *         )
     *     )
     * )
     */
}
