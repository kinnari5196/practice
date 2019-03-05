<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Steps extends Model
{
    protected $table="steps";
    protected $primaryKey="step_id";
    protected $fillable=['steps_desc','level_id','disease_id','id'];
}
