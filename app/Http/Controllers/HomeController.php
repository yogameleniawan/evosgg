<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Game;
use App\Models\MatchDetail;
use App\Models\Partner;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        $partners = Partner::all();
        $match_ml = Game::where('name', 'MOBILE LEGENDS')->first();
        $match_details = MatchDetail::where('game_id', $match_ml->id)->get();
        return view('home', compact('banners', 'partners', 'match_details'));
    }
}
