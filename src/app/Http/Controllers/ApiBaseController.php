<?php
/**
 * Created for tariff_comparison.
 * User: Aparna Saha
 * Email: tready.aparna@gmail.com
 */

namespace App\Http\Controllers;


use Illuminate\Support\Collection;
use Illuminate\Http\JsonResponse;

/**
 * @OA\OpenApi(
 *     @OA\Info(
 *         version="1.0.0",
 *         title="Tariff Comparison APIs",
 *         description="Tariff Comparison APIs",
 *         termsOfService="http://swagger.io/terms/",
 *         @OA\Contact(
 *             email="tready.aparna@gmail.com"
 *         ),
 *         @OA\License(
 *             name="Apache 2.0",
 *             url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *         )
 *     ),
 *     @OA\Server(
 *         description="Tariff Comparison OpenApi Host",
 *         url=L5_SWAGGER_CONST_HOST
 *     ),
 * )
 */
class ApiBaseController extends Controller
{
    /**
     * Standard response with data
     *
     * @param array|Collection $data
     * @return JsonResponse
     */
    public function response(array|Collection $data): JsonResponse
    {
        if ($data instanceof Collection) {
            $data = $data->toArray();
        }
        return response()->json(['data' => $data]);
    }
}
