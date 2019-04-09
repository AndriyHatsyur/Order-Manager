<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\User;
use App\Group;
use Illuminate\Support\Facades\Auth;
use mysql_xdevapi\Collection;

class OrderController extends Controller
{
    /**
     * @return array
     */
    public function index()
    {
        $orders = Order::where('parent_id', NULL)->get();
       
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
             'teil' => $request->teil,
             'parent_id' => $request->parent,
             'group_id' => $request->group,
             'zonder' => $request->zonder
           ]);

       return redirect('orders');
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
    private function data(\Illuminate\Support\Collection $orders, &$data = []): array
    {
        foreach ($orders as $order) {

            $data[] = $order->load('group', 'user', 'children');
        
            $this->data($order->children, $data);
        }

        return $data;
    }
}
