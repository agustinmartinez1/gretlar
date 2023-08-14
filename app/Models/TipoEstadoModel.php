<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoEstadoModel extends Model
{
    use HasFactory;
    protected $table='tb_tipo_estados';
    protected $primaryKey = 'idTipoEstado';
}
