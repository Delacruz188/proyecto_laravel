<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class Materiaprima extends Model
{
  protected $table = "Materiaprima";

  protected $primaryKey = 'idmateriaprima';

  public $timestamps = false;
}