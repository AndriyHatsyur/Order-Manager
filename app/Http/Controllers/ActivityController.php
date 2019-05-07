<?php

namespace App\Http\Controllers;

use App\Order;
use App\Task;
use App\TaskStatus;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index(){

        return Task::whereHas('status' ,function ($query) {
            $query->where('code', '<', 300);
        })->get();
    }

    public function create(Request $request){

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'task_status_id' => TaskStatus::where('code', 100)->first()->id,
            'order_id' => Order::find($request->id)->id
        ]);
    }
}
