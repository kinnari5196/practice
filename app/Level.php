<?php

namespace App;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{

	 use Notifiable;


    protected $table = 'level';
    protected $primaryKey = 'level_id';

    protected $fillable = ['level_name'];
}
