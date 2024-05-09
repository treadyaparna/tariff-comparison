<?php

namespace App\Http\Resources;

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
     *         description="The annual electricity consumption in kWh",
     *         example=1000
     *     ),
     *     @OA\Property(
     *         property="tariffs",
     *         type="array",
     *         @OA\Items(
     *             type="object",
     *             @OA\Property(property="tariffName", type="string", example="basic electricity tariff"),
     *             @OA\Property(property="annualCosts", type="integer", example=830)
     *         )
     *     )
     * )
     */
}
