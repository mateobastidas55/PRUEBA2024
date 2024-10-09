<?php

namespace App\Http\Controllers\V1\Lotteries;

use App\Http\Controllers\Controller;
use App\OpenApi\RequestBodies\buyLottery\buyLotteryRequestBody;
use App\OpenApi\Responses\Lottery\buyLotteriesResponse;
use App\Repositories\Interfaces\LotteriesInterfaces\BuyLotteriesInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
use App\OpenApi\SecuritySchemes\auth\loginSecurityScheme;

#[OpenApi\PathItem]
class BuyLotteriesController extends Controller
{
    private $buyLotteriesInterface;
    public function __construct(BuyLotteriesInterface $buyLotteriesInterface = null)
    {
        $this->buyLotteriesInterface = $buyLotteriesInterface;
    }

    /**
     * Endpoint que realiza la compra de la lotería
     */
    #[OpenApi\Operation(id: 'IndexBuyLotteriesMethodResponse', tags: ['comprarLoteria'], security: loginSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: buyLotteryRequestBody::class)]
    #[OpenApi\Response(factory: buyLotteriesResponse::class, statusCode: Response::HTTP_CREATED)]

    public function index()
    {
        try {
            $collection = $this->buyLotteriesInterface->index();
            return response()->json($collection, Response::HTTP_OK);
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
    public function store(Request $request, string $id)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        try {
            $collection = $this->buyLotteriesInterface->show($id);
            return response()->json($collection, Response::HTTP_OK);
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $collection = $this->buyLotteriesInterface->update($id, $request->all());
            return response()->json($collection, Response::HTTP_OK);
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
