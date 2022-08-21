<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileCoontroller extends Controller
{
    public function index()
    {
        return view('admin.profile.index');
    }

    public function update(Request $request)
    {
        $table = User::find(Auth::user()->id);
        $table->email = $request->email;
        $table->password = $request->password ? Hash::make($request->password) : $table->password;
        $table->save();
        return response()->json(['data' => $table], 200);
    }
}
