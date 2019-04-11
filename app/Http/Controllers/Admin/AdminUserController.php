<?php

namespace App\Http\Controllers\Admin;

use App\Role;
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

        $user = User::create([
            't_number' => $request->t_number,
            'password' => Hash::make('password')
        ]);

        Role::create(['user_id' => $user->id]);
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

    /**
     * @param Request $request
     */
    public function update(Request $request)
    {
        if ($request->user()->cannot('update', new User())) {
            abort(403);
        }

    }
}
