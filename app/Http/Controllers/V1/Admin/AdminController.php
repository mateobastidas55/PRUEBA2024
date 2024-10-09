<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\GamesLottery;
use App\Models\Lottery;
use App\OpenApi\Responses\Admin\IndexAdminControllerResponse;
use App\OpenApi\SecuritySchemes\auth\loginSecurityScheme;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

#[OpenApi\PathItem]
class AdminController extends Controller
{
    /**
 * Endpoint que proporciona una lista de todos los sorteos.
 * Devuelve información sobre cada sorteo.
 */

 #[OpenApi\Operation(id: 'IndexAdminControllerResponse', tags: ['Consultar Sorteos'], security: loginSecurityScheme::class)]
 #[OpenApi\Response(factory: IndexAdminControllerResponse::class, statusCode: Response::HTTP_CREATED)]
 public function index()
    {
        try {
            $gamesLotteries = GamesLottery::all()->toArray();
            $loteries = new Lottery();
            foreach ($gamesLotteries as $gameLottery) {
                $price = $loteries::where('id', $gameLottery['id_lottery'])->get()->first()->toArray();
                $res[] = [
                    "id" => str_pad($gameLottery['id'], 5, '0', STR_PAD_LEFT),
                    "loteryId" => $gameLottery['id_lottery'],
                    "gameDate" => $gameLottery['game_date'],
                    "totalPrize" => $price['price'],
                    "status" => 'Pendiente',
                    "winner" => $gameLottery['winner'],
                    "createdAt" => $gameLottery['created_at'],
                    "updatedAt" => $gameLottery['updated_at'],
                ];
            }
            return response()->json(['data' => $res], Response::HTTP_OK);
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
