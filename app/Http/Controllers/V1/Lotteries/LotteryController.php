<?php

namespace App\Http\Controllers\V1\Lotteries;

use App\Http\Controllers\Controller;
use App\Http\Resources\LotteryResource;
use App\OpenApi\Responses\Lottery\LotteryResponse;
use App\Repositories\Interfaces\LotteriesInterfaces\LotteryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
use App\OpenApi\SecuritySchemes\auth\loginSecurityScheme;


#[OpenApi\PathItem]
class LotteryController extends Controller
{
    private $lotteryInterface;
    public function __construct(LotteryInterface $lotteryInterface)
    {
        $this->lotteryInterface = $lotteryInterface;
    }


    /**
 * Endpoint que proporciona una lista de las loterías disponibles.
 * Devuelve información sobre cada lotería, como su nombre, descripción, y estado actual.
 */

    #[OpenApi\Operation(id: 'IndexLotteriesResponse', tags: ['Consultar Loterías'], security: loginSecurityScheme::class)]
    #[OpenApi\Response(factory: LotteryResponse::class, statusCode: Response::HTTP_CREATED)]
    public function index()
    {
        try {
            $collection = $this->lotteryInterface->index();
            return response()->json(LotteryResource::collection($collection), Response::HTTP_OK);
        } catch (\Throwable $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => $e->getMessage(),
                    'line' => $e->getLine(),
                    'file' => $e->getFile()
                ],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
