<?php

namespace App\Http\Controllers\V1\Notification;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationMethodsResource;
use App\Repositories\Interfaces\NotificationMethodsInterfaces\NotificationMethodsInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
use App\OpenApi\Responses\Notifications\NotificationMethodResponse;
use App\OpenApi\SecuritySchemes\auth\loginSecurityScheme;

#[OpenApi\PathItem]
class NotificationMethodsController extends Controller
{
    private $notificationMethodsInterface;
    public function __construct(NotificationMethodsInterface $notificationMethodsInterface)
    {
        $this->notificationMethodsInterface = $notificationMethodsInterface;
    }
    /**
     * Endpoint que muestra los metodos de notificacion
     */
    #[OpenApi\Operation(id: 'IndexNotificationMethodResponse', tags: ['usuarios'], security: loginSecurityScheme::class)]
    #[OpenApi\Response(factory: NotificationMethodResponse::class, statusCode: Response::HTTP_CREATED)]
    public function index()
    {
        try {
            $collection = $this->notificationMethodsInterface->index();
            return response()->json(NotificationMethodsResource::collection($collection), Response::HTTP_OK);
        } catch (\Throwable $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => $e->getMessage(),
                    'line' => $e->getLine(),
                    'File' => $e->getFile()
                ]
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
