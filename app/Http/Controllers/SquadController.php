<?php

namespace App\Http\Controllers;

use App\Models\Squad;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SquadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Squad::leftJoin('games', 'squads.game_id', '=', 'games.id')
                ->select('squads.id as id', 'squads.name as name', 'squads.country as country', 'squads.image as image', 'games.name as game_name', 'squads.game_id as game_id');
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
                ->addColumn('image', function ($data) {
                    $image = url($data->image);
                    $btn = "<td><a href='$image' target='_blank'>View Image</a></td>";
                    return $btn;
                })
                ->rawColumns(['action', 'image'])

                ->make(true);
        }
        return view('admin.squad.index');
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
        $table = new Squad();
        $table->name = $request->name;
        $table->country = $request->country;
        $table->game_id = $request->game_id;
        if ($request->file('image')) {
            $image = $request->image;
            $file_name =  time() . "." . $image->getClientOriginalExtension();
            $path = public_path('assets/images/teams/');
            $image->move($path, $file_name);
            $image_data = 'assets/images/teams/' . $file_name;
            $table->image = $image_data;
        }
        $table->save();
        return response()->json(['data' => $table], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Squad  $Squad
     * @return \Illuminate\Http\Response
     */
    public function show(Squad $Squad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Squad  $Squad
     * @return \Illuminate\Http\Response
     */
    public function edit(Squad $Squad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Squad  $Squad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $table = Squad::find($request->id);
        $table->name = $request->name;
        $table->country = $request->country;
        $table->game_id = $request->game_id;
        if ($request->file('image')) {
            $image = $request->image;
            $file_name =  time() . "." . $image->getClientOriginalExtension();
            $path = public_path('assets/images/teams/');
            $image->move($path, $file_name);
            $image_data = 'assets/images/teams/' . $file_name;
            $table->image = $image_data;
        }
        $table->save();
        return response()->json(['data' => $table], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Squad  $Squad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $table = Squad::find($request->id)->delete();
        return response()->json(['data' => $table], 200);
    }
}
