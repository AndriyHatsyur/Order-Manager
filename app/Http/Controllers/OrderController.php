<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\User;
use App\Group;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    
    public function index()
    {
        $orders = Order::where('parent_id', NULL)->get();
       
        $data = $this->data($orders);
      
        return $data; 
    }
    
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

   public function destroy(Request $request)
    {
        Order::destroy($request->id);

        return redirect('orders');
    }

    public function zonder(Request $request)
    {
        $order = Order::find($request->id);

        $order->zonder = !$order->zonder;

        $order->save();

        return redirect('orders');
    }

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

    private function data($orders, &$data = []): array
    {
        foreach ($orders as $value) {

            $data[] = $value->load('group', 'user', 'children');
        
            $this->data($value->children, $data);
        }

        return $data;
    }
}
