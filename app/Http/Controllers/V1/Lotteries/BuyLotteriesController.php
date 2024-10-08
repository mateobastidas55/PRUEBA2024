<?php

namespace App\Http\Controllers\V1\Lotteries;

use App\Http\Controllers\Controller;
use App\OpenApi\RequestBodies\buyLottery\buyLotteryRequestBody;
use App\OpenApi\Responses\Lottery\buyLotteriesResponse;
use App\OpenApi\Responses\Lottery\indexGanadoresPorLoteriaResponse;
use App\OpenApi\Responses\Lottery\showLotteriesPorLoteResponse;
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
     * Números ganadores de las Loterias.
     * Devuelve información detallada del número ganador y los premios obtenidos por cada lotería.
     */
    #[OpenApi\Operation(id: 'indexGanadoresPorLoteriaResponse', tags: ['Ganadores por Loteria'], security: loginSecurityScheme::class)]
    #[OpenApi\Response(factory: indexGanadoresPorLoteriaResponse::class, statusCode: Response::HTTP_CREATED)]
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

    /**
     * El endpoint devuelve información de boletos por Loteria.
     * Devuelve varios paquetes de boletos con sus precios según la cantidad de boletos seleccionada.
     */
    #[OpenApi\Operation(id: 'showLotteriesPorLoteResponse', tags: ['Consultar paquetes de boletos por Loteria'], security: loginSecurityScheme::class)]
    #[OpenApi\Response(factory: showLotteriesPorLoteResponse::class, statusCode: Response::HTTP_CREATED)]
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
     * Endpoint que procesa la compra de boletos de lotería.
     * Permite al usuario adquirir paquetes de boletos seleccionados.
     * {buy_lottery} = id de la lotería
     */
    #[OpenApi\Operation(id: 'updateBuyLotteriesMethodResponse', tags: ['Realizar compra'], security: loginSecurityScheme::class)]
    #[OpenApi\Response(factory: buyLotteriesResponse::class, statusCode: Response::HTTP_CREATED)]
    #[OpenApi\RequestBody(factory: buyLotteryRequestBody::class)]
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
