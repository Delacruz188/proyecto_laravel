<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
  protected $table = "Producto";

  protected $primaryKey = 'idproducto';

  public $timestamps = false;
}