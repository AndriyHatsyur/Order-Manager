<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    /**
     * @return User[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        $users = User::all();

        return $users;
    }

    /**
     * @param Request $request
     */
    public function create(Request $request)
    {

        if ($request->user()->cannot('create', new User())) {
            abort(403);
        }

        User::create([
            't_number' => $request->t_number,
            'password' => Hash::make('password')
        ]);
    }

    /**
     * @param Request $request
     */
    public function destroy(Request $request)
    {

        if ($request->user()->cannot('delete', new User())) {
            abort(403);
        }
        
        User::destroy($request->id);
    }

    public function update(Request $request)
    {

    }
}
