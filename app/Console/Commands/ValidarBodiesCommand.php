<?php

namespace App\Console\Commands;

use App\Models\EstadosGuia;
use App\Models\EstadosXtranportador;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ValidarBodiesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:validar-bodies-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'comando que valida todo lo que este dentro del directorio Bodies Interrapidisimo del Storage';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $bodies = Storage::allFiles('BodiesInterrapidisimo');
        if ($bodies == []) {
            exit('No hay peticiones');
        }
        $res = new EstadosGuia();

        foreach ($bodies as $body) {
            $data                        = json_decode(Storage::get($body), true);
            $idEstadoInterr              = $data['NotificacionEstados']['DetalleNotificacion']['CodigoEstado'];
            $descripcionMotivoDevolucion = $data['NotificacionEstados']['DetalleNotificacion']['DescripcionMotivoEst'];
            $codigoMotivoDevolucion      = $data['NotificacionEstados']['DetalleNotificacion']['CodigoMotivoEst'];
            $guia                        = (string)$data['NotificacionEstados']['DetalleNotificacion']['NumeroGuia'];
            if ($idEstadoInterr != 10 && $idEstadoInterr != 8) {
                // Storage::move($body, 'OtrosEstados/' . str_replace('BodiesInterrapidisimo/', '', $body));
                Storage::delete($body);
                continue;
            }
            if ($descripcionMotivoDevolucion == null && $codigoMotivoDevolucion == 0) {
                // Storage::move($body, 'SinDescripcion/' . str_replace('BodiesInterrapidisimo/', '', $body));
                Storage::delete($body);
                continue;
            }

            $dsestado = EstadosXtranportador::where('dscodigointerno', $idEstadoInterr)
                ->where('idtransportador', '1016')
                ->first()->dsnombre;

            $exists = $res::where('idtransportadora', '1016')
                ->where('dsestado', $dsestado);
            if ($exists->exists()) {
                $res::where('idtransportadora', '1016')
                    ->where('dsestado', $dsestado)
                    ->where('dsguia', $guia)
                    ->update([
                        'dsaclaracion' => $descripcionMotivoDevolucion
                    ]);
                Storage::delete($body);
                continue;
            }
            Storage::delete($body);
        }
    }
}
