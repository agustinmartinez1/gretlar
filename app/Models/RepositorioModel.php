<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepositorioModel extends Model
{
    use HasFactory;
    protected $table='tb_repositorio';
    protected $primaryKey = 'idRepositorio';
}
