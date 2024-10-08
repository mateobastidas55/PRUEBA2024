<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TblestadosGuia
 * 
 * @property int $id
 * @property string $dsguia
 * @property string $dsestado
 * @property string $dsdescripcion
 * @property string $dsaclaracion
 * @property string $dscomentario
 * @property string $dsfecha
 * @property string $dsfechaProduccion
 * @property string $dsfechaRecoleccion
 * @property string $dsfechaDespacho
 * @property string $dsfechaReparto
 * @property string $dsfechaEntrega
 * @property Carbon $dsfecharegistro
 * @property string $dsServicioUtilizado
 * @property string $dsNumeroCuenta
 * @property int $idnovedad
 * @property int $idexp
 * @property int|null $Cod_Novedad
 * @property string|null $Des_Novedad
 * @property string|null $Tipo_OrigenNovedad
 * @property int $idtransportadora
 * @property string $dstransportadora
 * @property int $idguia
 * @property int $idfecha
 * @property string $ServiceArea_ServiceAreaCode
 * @property string $ServiceArea_Description
 * @property string|null $dsnumParadas
 * @property string $dsUrlTrazabilidad
 * @property string|null $payload
 *
 * @package App\Models
 */
class EstadosGuia extends Model
{
	protected $table = 'tblestados_guias';
	public $timestamps = false;

	protected $casts = [
		'dsfecharegistro' => 'datetime',
		'idnovedad' => 'int',
		'idexp' => 'int',
		'Cod_Novedad' => 'int',
		'idtransportadora' => 'int',
		'idguia' => 'int',
		'idfecha' => 'int'
	];

	protected $fillable = [
		'dsguia',
		'dsestado',
		'dsdescripcion',
		'dsaclaracion',
		'dscomentario',
		'dsfecha',
		'dsfechaProduccion',
		'dsfechaRecoleccion',
		'dsfechaDespacho',
		'dsfechaReparto',
		'dsfechaEntrega',
		'dsfecharegistro',
		'dsServicioUtilizado',
		'dsNumeroCuenta',
		'idnovedad',
		'idexp',
		'Cod_Novedad',
		'Des_Novedad',
		'Tipo_OrigenNovedad',
		'idtransportadora',
		'dstransportadora',
		'idguia',
		'idfecha',
		'ServiceArea_ServiceAreaCode',
		'ServiceArea_Description',
		'dsnumParadas',
		'dsUrlTrazabilidad',
		'payload'
	];
}
