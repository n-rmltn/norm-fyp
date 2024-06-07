<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderCreateRequest;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Carbon\Carbon;

class OrderController extends Controller
{
    // Shows spec list
    public function order(Request $request)
    {
        $query = Order::query();

        if (!auth()->user()->is_admin) {
            $query->where('users_id', auth()->id());
        }

        // Paginate the results
        $order = $query->paginate(10);

        // Return the view with the orders
        return view('orders', compact('order'));
    }

    public function searchOrder(Request $request)
    {
        $searchQuery = trim($request->input('search'));
        $status = $request->input('status');

        $query = Order::query();
        $query->join('product', 'order.product_id', '=', 'product.id');
        $query->join('users', 'order.users_id', '=', 'users.id');

        if ($searchQuery) {
            $query->where(function ($q) use ($searchQuery) {
                $q->where('product.product_name', 'like', "%{$searchQuery}%")
                    ->orWhere('users.name', 'like', "%{$searchQuery}%");
            });
        }

        if ($status) {
            $query->where('order_status', $status);
        }

        $order = $query->get();

        return view('ajax.orders_search_results', compact('order'));
    }

    public function accept($id)
    {
        $order = Order::findOrFail($id);

        $order->order_status = 'accepted';
        $order->save();

        return redirect()->back()->with('status', 'Order accepted successfully.');
    }

    public function reject($id)
    {
        $order = Order::findOrFail($id);

        $order->order_status = 'rejected';
        $order->save();

        return redirect()->back()->with('status', 'Order rejected successfully.');
    }

    public function cancel($id)
    {
        $order = Order::findOrFail($id);

        if ($order->order_status === 'Pending') {
            $order->order_status = 'Cancelled';
            $order->save();

            return redirect()->back()->with('status', 'Order cancelled successfully.');
        } else {
            return redirect()->back()->with('error', 'Unable to cancel order. Order status is not pending.');
        }
    }

    public function createOrderForm($id)
    {
        $product = Product::findOrFail($id);
        $partials = ['order.partials.create-order-form'];

        return view('edit', [
            'partials' => $partials,
            'product' => $product,
        ]);

    }
    public function create(OrderCreateRequest $request)
    {
        $validatedData = $request->validated();

        $order = new Order();
        $order->product_id = $validatedData['product_id'];
        $order->users_id = auth()->id();
        $order->order_quantity = $validatedData['order_quantity'];
        $order->order_status = 'Pending';

        $order->created_at = $validatedData['created_at'] ?? Carbon::now();

        $order->save();

        return Redirect::route('orders')->with('status', 'order-created');
    }

}
