<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Banner;
use App\Models\Game;
use App\Models\MatchDetail;
use App\Models\Partner;
use App\Models\Squad;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $articles = Article::all()->take(5);
        $banners = Banner::all();
        $partners = Partner::all();
        $match_details = MatchDetail::all();
        $games = Game::all();
        $squads = Squad::leftJoin('games', 'squads.game_id', '=', 'games.id')
            ->select('games.name as game_name', 'squads.name as name', 'squads.image as image', 'squads.country as country')->get();
        return view('home', compact('banners', 'partners', 'match_details', 'games', 'squads', 'articles'));
    }

    public function searchResult(Request $request)
    {
        $articles = Article::all()->take(5);
        $game = Game::where('slug', $request->search)->first();
        $match_details = MatchDetail::where('game_id', $game->id)->get();
        $banners = Banner::all();
        $partners = Partner::all();
        $games = Game::all();
        $squads = Squad::leftJoin('games', 'squads.game_id', '=', 'games.id')
            ->select('games.name as game_name', 'squads.name as name', 'squads.image as image', 'squads.country as country')->get();
        return view('home', compact('banners', 'partners', 'match_details', 'games', 'squads', 'articles'));
    }
}
