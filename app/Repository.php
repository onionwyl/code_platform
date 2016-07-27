<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repository extends Model
{
    protected $table = "repository";
    protected $primaryKey = "repoid";
}
