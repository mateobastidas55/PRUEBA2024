<?php

namespace App\Http\Controllers\V1\Users;

use App\Http\Controllers\Controller;
use App\OpenApi\RequestBodies\user\StoreUserRequestBody;
use App\OpenApi\Responses\user\ResponseStoreUserResponse;
use App\OpenApi\SecuritySchemes\auth\loginSecurityScheme;
use App\Repositories\Interfaces\UserInterfaces\UserInterface;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;


#[OpenApi\PathItem]
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
        return response()->json(
            [
                'success' => false,
                'messague' => 'Not Found.'
            ],
            Response::HTTP_NOT_FOUND
        );
    }

    /**
     * Create new user.
     *
     * Creates new user or returns already existing user by email.
     */
    // #[OpenApi\Operation(id: 'StoreUserRequest', tags: ['apiResource'], security: loginSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: StoreUserRequestBody::class)]
    #[OpenApi\Response(factory: ResponseStoreUserResponse::class, statusCode: Response::HTTP_CREATED)]
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
            return response()->json(
                [
                    'success' => false,
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine()
                ],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
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
        return response()->json(
            [
                'success' => false,
                'messague' => 'Not Found.'
            ],
            Response::HTTP_NOT_FOUND
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return response()->json(
            [
                'success' => false,
                'messague' => 'Not Found.'
            ],
            Response::HTTP_NOT_FOUND
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return response()->json(
            [
                'success' => false,
                'messague' => 'Not Found.'
            ],
            Response::HTTP_NOT_FOUND
        );
    }
}
