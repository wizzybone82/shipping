<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShippingOrder;
use Illuminate\Http\Request;
use App\Models\User;

class ShippingOrderController extends Controller
{

    public function index()
    {
        $title = 'Orders';
        $shippingOrders = ShippingOrder::orderByDesc('created_at')->get(); // Get all orders, sorted by most recent

        return view('shipping.index', compact('shippingOrders','title'));
    }


    public function show($id)
    {
        $title = 'Order Detail';
        $shippingOrder = ShippingOrder::findOrFail($id);

        return view('shipping.show', compact('shippingOrder','title'));
    }


    public function create(){
        // $shippingOrder = ShippingOrder::findOrFail($id);
        $title = 'Create Order';
        $users = User::all();
        return view('shipping.create', compact('title','users'));
    }

    public function edit($id){
        $title = 'Edit Order';
        $users = User::all();
        $shippingOrder = ShippingOrder::findOrFail($id);
        return view('shipping.edit', compact('title','users','shippingOrder'));
    }
    public function store(Request $request)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'package_size' => 'nullable|in:small,large,extra_large,medium',
            'package_weight' => 'required|numeric',
            'weight_metric' => 'nullable|in:gram,kg',
            'number_of_items' => 'nullable|integer',
            'delivery_time' => 'required|date',
            'pickup_time' => 'required|date',
            'pickup_city' => 'required|string|max:255',
            'pickup_address' => 'required|string|max:255',
            'delivery_city' => 'required|string|max:255',
            'delivery_address' => 'required|string|max:255',
            'customer_id' => 'required|exists:users,id', // Ensure the provided customer_id exists in users table
            'status' => 'required',
            'phone_number' => 'nullable|string',
            'mobile_key' => 'nullable|string',
        ]);

        if ($request->order_id != NULL) {
            // Find the existing shipping order
            $shippingOrder = ShippingOrder::find($request->order_id);

            // Check if the shipping order exists
            if (!$shippingOrder) {
                return redirect()->route('shipping-orders.index')->with('error', 'Internal server error');
            }

            // Update the existing shipping order
            $shippingOrder->update($validated);

            return redirect()->route('shipping-orders.index')->with('success', 'Shipping order updated successfully');
        }

        // Create a new shipping order if no id is passed
        $shippingOrder = ShippingOrder::create($validated);

        return redirect()->route('shipping-orders.index')->with('success', 'Shipping order created successfully');
    }

   
    public function sendStatusUpdateNotification($id,$status, Request $request)
    {
        $shippingOrder = ShippingOrder::findOrFail($id);

       
        $shippingOrder->update([
            'status' => $status,
            'updated_by' => 'admin', 
        ]);

        return redirect()->route('shipping-orders.index')->with('success', 'Shipping order status updated successfully');
    }

    public function destroy($id){
        $shippingOrder = ShippingOrder::findOrFail($id);

        $shippingOrder->delete();

        return redirect()->route('shipping-orders.index')->with('success', 'Shipping order deleted successfully');
    }


}
