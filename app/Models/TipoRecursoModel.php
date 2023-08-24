<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoRecursoModel extends Model
{
    use HasFactory;
    protected $table='tb_tipo_recursos';
    protected $primaryKey = 'idTipoRecurso';
}
