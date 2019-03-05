<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    protected $table = 'disease';
    protected $primaryKey = 'disease_id';

    protected $fillable = ['disease_name'];
}
