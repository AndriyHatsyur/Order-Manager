<?php

namespace App\Http\Controllers;

use App\Reason;
use App\Role;
use App\Status;
use Illuminate\Http\Request;
use App\Order;
use App\User;
use App\Group;
use App\Location;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class OrderController extends Controller
{
    /**
     * @return array
     */
    public function index()
    {
        $orders = Order::where('parent_id', NULL)->whereHas('status' ,function ($query) {
            $query->where('code', '<', 400);
        })->get();

        $data = $this->data($orders);
      
        return $data;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function create(Request $request)
    {
        if ($request->group == 'Transfer')
        {
            $statusId = Status::where('code', 300)->first()->id;
        }
        else
        {
            $statusId = Status::where('code', 100)->first()->id;
        }

        $order = Auth::user()->orders()->create([
               'teil'        => $request->teil,
               'parent_id'   => $request->parent,
               'group_id'    => Group::where('name', $request->group)->first()->id,
               'zonder'      => $request->zonder,
               'status_id'   => $statusId,
               'reason_id'   => Reason::where('name', $request->reason)->first()->id,
               'location_id' => Location::where('name', $request->location)->first()->id,
               'transport'   => $request->transport,

           ]);

        $this->setParentStatus($order, 275);

   }

   public function setTerm(Request $request)
   {
       $date = Carbon::now();
       $term = $date->addHours($request->term);

       $order = Order::find($request->id);

       if ($order->status->code < 300){

           $order->term = $term;
           if ($order->status->code == 100)
           {
               $order->status_id = Status::where('code', 200)->first()->id;
           }

           $order->save();
       }

       return Order::find($request->id)->load('status');

   }

    /**
     * @param Request $request
     * @return mixed
     */
   public function cancel(Request $request)
   {
       $order = Order::find($request->id);

       if ($this->hasChildren($order))
       {
           $order = $order->load('children');

           return $order->children;
       }


       $order->status_id = Status::where('code', 500)->first()->id;

       $order->save();

   }

    /**
     * @param Request $request
     * @return string
     */
   public function success(Request $request)
   {
       $order = Order::find($request->id);


       if ($this->hasChildren($order))
       {
           $order = $order->load('children');

           return $order->children;
       }


       if ($order->transport == true && $order->status->code <= 200)
       {
           $order->status_id = Status::where('code', 300)->first()->id;
           $order->group_id = Group::where('name', 'Transfer')->first()->id;
       }
       else
       {
           $order->status_id = Status::where('code', 400)->first()->id;
       }

       $order->save();

       if ($order->parent_id != null)
       {
           $hasParent = $this->hasChildren($order->parent);

           if ($hasParent != true )
           {
               $this->setParentStatus($order, 200);

           }
       }

   }


    /***
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function zonder(Request $request)
    {
        $order = Order::find($request->id);

        $order->zonder = !$order->zonder;

        $order->save();

    }

    /**
     * @return array
     */
    public function userOrders()
    {
        $orders = Auth::user()->orders()->orderBy('id', 'desc')->take(100)->get()->load('children', 'user', 'group', 'status', 'location', 'reason');

        return $orders;
    }


    /**
     * @param \Illuminate\Support\Collection $orders
     * @param array $data
     * @return array
     */
    private function data(\Illuminate\Support\Collection $orders, &$data = [], &$counter = 1): array
    {
        foreach ($orders as $order) {

            $order->count = $counter;

            $order->load('status', 'group', 'user', 'location', 'reason');

            if ($order->status->code < 400 )
            {
                $data[] = $order;
                $counter++;
                $this->data($order->children, $data, $counter);
            }

        }

        return $data;
    }

    /**
     * @param Order $order
     * @return bool
     */
    private function hasChildren(Order $order)
    {

        foreach ($order->children as $children)
        {
            if ($children->status->code < 400 )
                return true;
        }

        return false;
    }

    /**
     * @param Order $order
     * @param int $statusCode
     * @return bool
     */
    private function setParentStatus(Order $order, $statusCode)
    {
        if ($order->parent_id != null)
        {
            $parent = $order->parent;
            $parent->status_id = Status::where('code', $statusCode)->first()->id;
            $parent->save();

            return true;
        }

        return false;
    }
}
