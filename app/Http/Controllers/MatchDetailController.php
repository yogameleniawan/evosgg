<?php

namespace App\Http\Controllers;

use App\Models\MatchDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MatchDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = MatchDetail::leftJoin('games', 'match_details.game_id', '=', 'games.id')
                ->select('match_details.id as id', 'match_details.season as season', 'match_details.date as date', 'match_details.time as time', 'games.name as game_name', 'match_details.game_id as game_id', 'match_details.first_team_logo as first_team_logo', 'match_details.first_team_score as first_team_score', 'match_details.second_team_logo as second_team_logo', 'match_details.second_team_score as second_team_score', 'match_details.stage as stage',);
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $json = json_encode($data);
                    $btn = "<td>
                    <a class='btn btn-secondary' onclick='editModal($json)' data-bs-toggle='modal' data-bs-target='#exampleModalCenter'>Edit</a>
                    <a class='btn btn-danger' onclick='deleteModal($json)' data-bs-toggle='modal' data-bs-target='#exampleModalCenter'>Delete</a>
                    </td>";
                    return $btn;
                })
                ->addColumn('first_team_logo', function ($data) {
                    $image = url($data->first_team_logo);
                    $btn = "<td><img src='$image' style='width:100px'/></td>";
                    return $btn;
                })
                ->addColumn('second_team_logo', function ($data) {
                    $image = url($data->second_team_logo);
                    $btn = "<td><img src='$image' style='width:100px'/></td>";
                    return $btn;
                })
                ->rawColumns(['action', 'first_team_logo', 'second_team_logo'])

                ->make(true);
        }
        return view('admin.match.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // date("d M Y", strtotime($request->date))
        // date("h.i a", strtotime($request->time))
        $table = new MatchDetail();
        $table->season = $request->season;
        $table->date = $request->date;
        $table->time = $request->time;
        $table->game_id = $request->game_id;
        if ($request->file('first_team_logo')) {
            $image = $request->first_team_logo;
            $file_name =  time() . "." . $image->getClientOriginalExtension();
            $path = public_path('assets/images/match-home_teams/');
            $image->move($path, $file_name);
            $image_data = 'assets/images/match-home_teams/' . $file_name;
            $table->first_team_logo = $image_data;
        }
        if ($request->file('second_team_logo')) {
            $image = $request->second_team_logo;
            $file_name =  time() . "." . $image->getClientOriginalExtension();
            $path = public_path('assets/images/match-away_teams/');
            $image->move($path, $file_name);
            $image_data = 'assets/images/match-away_teams/' . $file_name;
            $table->second_team_logo = $image_data;
        }
        $table->first_team_score = $request->first_team_score;
        $table->second_team_score = $request->second_team_score;
        $table->stage = $request->stage;
        $table->save();
        return response()->json(['data' => $table], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MatchDetail  $MatchDetail
     * @return \Illuminate\Http\Response
     */
    public function show(MatchDetail $MatchDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MatchDetail  $MatchDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(MatchDetail $MatchDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MatchDetail  $MatchDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $table = MatchDetail::find($request->id);
        $table->season = $request->season;
        $table->date = $request->date;
        $table->time = $request->time;
        $table->game_id = $request->game_id;
        if ($request->file('first_team_logo')) {
            $image = $request->first_team_logo;
            $file_name =  time() . "." . $image->getClientOriginalExtension();
            $path = public_path('assets/images/match-home_teams/');
            $image->move($path, $file_name);
            $image_data = 'assets/images/match-home_teams/' . $file_name;
            $table->first_team_logo = $image_data;
        }
        if ($request->file('second_team_logo')) {
            $image = $request->second_team_logo;
            $file_name =  time() . "." . $image->getClientOriginalExtension();
            $path = public_path('assets/images/match-away_teams/');
            $image->move($path, $file_name);
            $image_data = 'assets/images/match-away_teams/' . $file_name;
            $table->second_team_logo = $image_data;
        }
        $table->first_team_score = $request->first_team_score;
        $table->second_team_score = $request->second_team_score;
        $table->stage = $request->stage;
        $table->save();
        return response()->json(['data' => $table], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MatchDetail  $MatchDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $table = MatchDetail::find($request->id)->delete();
        return response()->json(['data' => $table], 200);
    }
}
