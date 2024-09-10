<?php

namespace App\Http\Controllers\V1\Users;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\UserInterfaces\UserInterface;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UsersController extends Controller
{

    private $usersInterface;

    public function __construct(UserInterface $usersInterface)
    {
        $this->usersInterface = $usersInterface;
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
     * 
     */
    public function store(Request $request)
    {
        try {
            return response()->json($this->usersInterface->store($request->all()), Response::HTTP_CREATED);
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return response()->json([
                    'success' => false,
                    'message' => 'El correo electrónico ya está registrado.'
                ], Response::HTTP_BAD_REQUEST);
            }
        } catch (\Throwable $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine()
                ],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
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
