<?php

namespace App\Http\Controllers;

use App\HistoryOrder;
use Illuminate\Http\Request;

/**
 * Class HistoryOrderController
 * @package App\Http\Controllers
 */
class HistoryOrderController extends Controller
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function getHistory(Request $request)
    {
        return HistoryOrder::whereHas('order', function($query) use ($request){
            $query->where('teil', $request->teil);
        })->orderBy('id', 'desc')->take(100)->get()->load('user', 'order.group', 'order.location', 'order.reason','status');
    }
}
