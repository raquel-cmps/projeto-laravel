<?php

namespace App\Models;
//importanado classes
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';

    protected $fillable = ['title', 'description', 'status'];//colunas da tabela

    protected $title;
    protected $description;
    protected $status;
}
