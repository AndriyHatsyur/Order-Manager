<?php

namespace App\Http\Controllers\Admin;

use App\Group;
use App\Location;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;

/**
 * Class AdminUserController
 * @package App\Http\Controllers\Admin
 */
class AdminUserController extends Controller
{
    /**
     * @return User[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        $users = User::all()->load('group', 'location', 'roles');

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
            'password' => Hash::make('password'),
            'group_id' => Group::where('name', $request->group)->first()->id,
            'location_id' => Location::where('name', $request->location)->first()->id

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

        $user = User::find($request->id);
        $user->group_id = Group::where('name', $request->group)->first()->id;
        $user->location_id = Location::where('name', $request->location)->first()->id;
        $user->roles->is_admin =  (int)$request->is_admin;
        $user->roles->save();
        $user->save();

    }
}
