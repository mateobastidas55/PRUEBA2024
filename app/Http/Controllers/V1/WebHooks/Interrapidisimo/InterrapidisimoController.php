<?php

namespace App\Http\Controllers\V1\WebHooks\Interrapidisimo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class InterrapidisimoController extends Controller
{
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
    public function store(Request $request)
    {
        try {
            // Convertir los datos a JSON
            $jsonData = json_encode($request->all(), JSON_PRETTY_PRINT);
            $random = rand();
            // Guardar el archivo en el almacenamiento
            Storage::put('BodiesInterrapidisimo/' . $random . '.json', $jsonData);


            return response()->json(
                [
                    'success' => true,
                    'message' => 'The request was processed satisfactorily.'
                ],
                Response::HTTP_CREATED
            );
        } catch (\Throwable $e) {
            return response()->json([], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
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
