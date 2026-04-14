<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //asignando la tabla que le va pertenercer al modelo
    protected $table = 'tasks';

    // agregando las columnas de la tabla
    protected $fillable = [
        'title',
        'description',
        'status',
        'priority',
        'due_date',
        'user_id'
    ];
}
