<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tblestadosxtranportador
 * 
 * @property int $id
 * @property string|null $idadmon
 * @property string|null $dsnombre
 * @property int|null $idactivo
 * @property string|null $dscodigointerno
 * @property int|null $idtipo
 * @property string|null $dsd
 * @property string|null $idestado
 * @property string|null $codigowcw
 * @property string|null $idtransportador
 * @property int|null $idtipomensajeria
 * @property int|null $idnovedad
 *
 * @package App\Models
 */
class EstadosXtranportador extends Model
{
	protected $table = 'tblestadosxtranportador';
	public $timestamps = false;

	protected $casts = [
		'idactivo' => 'int',
		'idtipo' => 'int',
		'idtipomensajeria' => 'int',
		'idnovedad' => 'int'
	];

	protected $fillable = [
		'idadmon',
		'dsnombre',
		'idactivo',
		'dscodigointerno',
		'idtipo',
		'dsd',
		'idestado',
		'codigowcw',
		'idtransportador',
		'idtipomensajeria',
		'idnovedad'
	];
}
