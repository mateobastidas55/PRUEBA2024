<?php

namespace App\Http\Controllers\V1\Lotteries;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\LotteriesInterfaces\BuyLotteriesInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BuyLotteriesController extends Controller
{
    private $buyLotteriesInterface;
    public function __construct(BuyLotteriesInterface $buyLotteriesInterface = null)
    {
        $this->buyLotteriesInterface = $buyLotteriesInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(string $id)
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
    public function update(Request $request, string $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
