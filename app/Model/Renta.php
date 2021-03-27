<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class Renta extends Model
{
  protected $table = "Renta";

  protected $primaryKey = 'idrenta';

  public $timestamps = false;
}