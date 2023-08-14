<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecursoModel extends Model
{
    use HasFactory;
    protected $table='tb_recursos';
    protected $primaryKey = 'idRecurso';
}
