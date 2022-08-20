<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Squad extends Model
{
    use HasFactory;
    protected $table = 'squads';
    protected $fillable = ['id', 'game_id', 'name', 'country'];
}
