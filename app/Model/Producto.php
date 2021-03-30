<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
  protected $table = "Productos";

  protected $primaryKey = 'idproducto';

  public $timestamps = false;
}