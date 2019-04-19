<?php

namespace App\Http\Controllers;

use App\Role;
use App\Status;
use Illuminate\Http\Request;
use App\Order;
use App\User;
use App\Group;
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

           Auth::user()->orders()->create([
               'teil'        => $request->teil,
               'parent_id'   => $request->parent,
               'group_id'    => $request->group,
               'zonder'      => $request->zonder,
               'status_id'   => Status::where('code', 100)->first()->id,
               'reason_id'   => $request->reason,
               'location_id' => $request->location

           ]);



       //return redirect('/app/orders');
   }

   public function setTerm(Request $request)
   {
       $date = Carbon::now();
       $term = $date->addHours($request->term);

       $order = Order::find($request->id);

       $order->term = $term;
       $order->status_id = Status::where('code', 200)->first()->id;

       $order->save();

   }

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

       return "ok";

   }

   public function success(Request $request)
   {
       $order = Order::find($request->id);

       if ($this->hasChildren($order))
       {
           $order = $order->load('children');

           return $order->children;
       }


       $order->status_id = Status::where('code', 400)->first()->id;

       $order->save();

       return "ok";
   }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
   public function destroy(Request $request)
    {
        Order::destroy($request->id);

        return redirect('orders');
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

        return redirect('orders');
    }

    /**
     * @return array
     */
    public function myOrders()
    {
        $orders = Auth::user()->orders()->where('parent_id', NULL)->get()->load('children', 'user', 'group');

        $data = $this->data($orders);

        return $data;
    }

    public function groupOrders()
    {
        $orders = Auth::user()->group->orders()->where('parent_id', NULL)->get()->load('children', 'user', 'group');

        $data = $this->data($orders);

        return $data;
    }

    /**
     * @param \Illuminate\Support\Collection $orders
     * @param array $data
     * @return array
     */
    private function data(\Illuminate\Support\Collection $orders, &$data = [], &$num = 1): array
    {
        foreach ($orders as $order) {

            $order->num = $num;

            $order->load('status', 'group', 'user', 'children', 'location', 'reason');

            if ($order->status->code < 400 )
            {
                $data[] = $order;
                $num++;
            }



            $this->data($order->children, $data, $num);
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

        if (isset($children))
            $this->hasChildren($children);

        return false;
    }
}
