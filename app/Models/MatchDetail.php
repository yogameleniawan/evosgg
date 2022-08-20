<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchDetail extends Model
{
    use HasFactory;
    protected $table = 'match_details';
    protected $fillable = ['id', 'game_id', 'season', 'date', 'time', 'first_team_logo', 'first_team_score', 'second_team_logo', 'second_team_score', 'stage'];
}
