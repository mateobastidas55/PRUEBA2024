<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\GamesLottery;
use App\Models\Lottery;
use App\Models\Rol;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
use App\OpenApi\SecuritySchemes\auth\loginSecurityScheme;
use App\OpenApi\Responses\Admin\IndexAdminControllerResponse;

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
        try {
            $users = User::get()->toArray();

            foreach ($users as $user) {
                $res[] = [
                    "id" => $user['id'],
                    "name" => $user['name'],
                    "email" => $user['email'],
                    "birthDate" => $user['birt_day'],
                    "status" => 1,
                    "phone" => $user['phone'],
                    "notifyBy" => $user['id_notification_method_favorite'],
                    "role" => Rol::where('id', $user['id_rol'])->select('id', 'rol_name As name')->get()->first(),
                    "createdAt" => $user['created_at'],
                    "updatedAt" => $user['updated_at']
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
