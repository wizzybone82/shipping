<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShippingOrder;
use Illuminate\Http\Request;
use App\Models\User;

class ShippingOrderController extends Controller
{
    // Create a new shipping order
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

        // Create the shipping order and associate it with the selected customer
        $shippingOrder = ShippingOrder::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'package_size' => $validated['package_size'] ?? null,
            'package_weight' => $validated['package_weight'],
            'weight_metric' => $validated['weight_metric'] ?? null,
            'number_of_items' => $validated['number_of_items'],
            'delivery_time' => $validated['delivery_time'],
            'pickup_time' => $validated['pickup_time'],
            'pickup_city' => $validated['pickup_city'],
            'pickup_address' => $validated['pickup_address'],
            'delivery_city' => $validated['delivery_city'],
            'delivery_address' => $validated['delivery_address'],
            'phone_number' => $validated['phone_number'],
            'mobile_key' => $validated['mobile_key'],
            'customer_id' => $validated['customer_id'], // Use the provided customer_id
            'status' => $validated['status'], // Default status
        ]);

        // Return the response with the created order
        return response()->json([
            'message' => 'Shipping order created successfully',
            'order' => $shippingOrder,
        ], 201);
    }

    // Edit a shipping order (only status can be updated by admin)
    public function edit($id, Request $request)
    {
        $shippingOrder = ShippingOrder::findOrFail($id);

        // Validate the new status if provided
        $validated = $request->validate([
            'status' => 'required|in:pending,inprogress,delivered,cancelled',
        ]);

        // Only the admin can change the status or any other editable field
        $shippingOrder->update([
            'status' => $validated['status'],
            'updated_by' => 'admin', // Mark that the admin updated the order
        ]);

        return redirect()->route('admin.shipping-orders.index')->with('success', 'Shipping order status updated successfully');
    }

    // Cancel a shipping order (admin can cancel any order)
    public function cancel($id)
    {
        $shippingOrder = ShippingOrder::findOrFail($id);

        // Only admin can cancel the order
        $shippingOrder->update([
            'status' => 'cancelled',
            'updated_by' => 'admin', // Mark the cancel as admin action
        ]);

        return redirect()->route('admin.shipping-orders.index')->with('success', 'Shipping order cancelled successfully');
    }

    // List all shipping orders (admin can see all orders)
    public function index()
    {
        $shippingOrders = ShippingOrder::orderByDesc('created_at')->get(); // Get all orders, sorted by most recent

        return view('admin.shipping-orders.index', compact('shippingOrders'));
    }

    // View a specific shipping order
    public function show($id)
    {
        $shippingOrder = ShippingOrder::findOrFail($id);

        return view('admin.shipping-orders.show', compact('shippingOrder'));
    }
}
