<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Game::all();
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
                    $image = url($data->logo);
                    $btn = "<td><a href='$image' target='_blank'>View Image</a></td>";
                    return $btn;
                })
                ->rawColumns(['action', 'image'])

                ->make(true);
        }
        return view('admin.Game.index');
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
        $table = new Game();
        $table->name = $request->name;
        if ($request->file('logo')) {
            $image = $request->logo;
            $file_name =  time() . "." . $image->getClientOriginalExtension();
            $path = public_path('assets/images/game-logos/');
            $image->move($path, $file_name);
            $image_data = 'assets/images/game-logos/' . $file_name;
            $table->logo = $image_data;
        }
        $table->save();
        return response()->json(['data' => $table], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Game  $Game
     * @return \Illuminate\Http\Response
     */
    public function show(Game $Game)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Game  $Game
     * @return \Illuminate\Http\Response
     */
    public function edit(Game $Game)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Game  $Game
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $table = Game::find($request->id);
        $table->name = $request->name;
        if ($request->file('logo')) {
            $image = $request->logo;
            $file_name =  time() . "." . $image->getClientOriginalExtension();
            $path = public_path('assets/images/game-logos/');
            $image->move($path, $file_name);
            $image_data = 'assets/images/game-logos/' . $file_name;
            $table->logo = $image_data;
        }
        $table->save();
        return response()->json(['data' => $table], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Game  $Game
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $table = Game::find($request->id)->delete();
        return response()->json(['data' => $table], 200);
    }
}
