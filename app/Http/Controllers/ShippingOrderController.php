<?php

namespace App\Http\Controllers;

use App\Models\ShippingOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ShippingOrderController extends Controller
{
    /**
     * Create a new shipping order.
     */
    public function create(Request $request)
    {
        // Define the validation rules
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'package_size' => 'nullable|in:small,large,extra_large,medium',
            'package_weight' => 'nullable|numeric',
            'weight_metric' => 'nullable|in:gram,kg',
            'number_of_items' => 'nullable|integer',
            'delivery_time' => 'required|date',
            'pickup_time' => 'required|date',
            'pickup_city' => 'required|string|max:255',
            'pickup_address' => 'required|string|max:255',
            'delivery_city' => 'required|string|max:255',
            'delivery_address' => 'required|string|max:255',
            'phone_number' => 'nullable|string',
            'mobile_key' => 'nullable|string',
        ];
    
        // Validate the data
        $validator = Validator::make($request->all(), $rules);
    
        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }
    
        // If validation passes, create the shipping order
        $validated = $validator->validated();
    
        $shippingOrder = ShippingOrder::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'package_size' => $validated['package_size'] ?? null,
            'package_weight' => $validated['package_weight'] ?? null,
            'weight_metric' => $validated['weight_metric'] ?? null,
            'number_of_items' => $validated['number_of_items'] ?? null,
            'delivery_time' => $validated['delivery_time'],
            'pickup_time' => $validated['pickup_time'],
            'pickup_city' => $validated['pickup_city'],
            'pickup_address' => $validated['pickup_address'],
            'delivery_city' => $validated['delivery_city'],
            'delivery_address' => $validated['delivery_address'],
            'phone_number' => $validated['phone_number'],
            'mobile_key' => $validated['mobile_key'],
            'customer_id' => Auth::id(),
            'status' => 'pending',
        ]);
    
        // Return the response with the created order
        return response()->json([
            'message' => 'Shipping order created successfully',
            'order' => $shippingOrder,
        ], 201);
    }

    /**
     * Cancel a shipping order.
     */
    public function cancel($id)
    {
        $shippingOrder = ShippingOrder::where('status','pending')->where('id',$id)->first();

        

        if(!$shippingOrder){
            return response()->json(['message' => 'You do not have permission to cancel this order'], 403);
        }
        // Ensure the logged-in user is the owner of the shipping order
        if ($shippingOrder->customer_id !== Auth::id()) {
            return response()->json(['message' => 'You do not have permission to cancel this order'], 403);
        }

        // Update the order status to cancelled and set who canceled it
        $shippingOrder->update([
            'status' => 'cancelled',
            'canceled_by' => 'user',  // Indicate that the user canceled the order
        ]);

        return response()->json([
            'message' => 'Shipping order status updated to cancelled by user',
            'shipping_order' => $shippingOrder,
        ]);
    }

    /**
     * Get the list of shipping orders for the authenticated user.
     */
    public function index()
    {
        $shippingOrders = ShippingOrder::where('customer_id', Auth::id())
            ->orderBy('created_at', 'desc')  // Sort by creation date in descending order
            ->get();

        return response()->json($shippingOrders);
    }

    /**
     * Get the count of shipping orders based on their status.
     */
 

    public function show($id)
    {
        // Retrieve the shipping order by its ID
        $shippingOrder = ShippingOrder::find($id);

        // Check if the order exists
        if (!$shippingOrder) {
            return response()->json([
                'message' => 'Shipping order not found',
            ], 404);
        }

        // Return the order details as a JSON response
        return response()->json([
            'order' => $shippingOrder,
        ], 200);
    }

    public function countByStatus()
    {

        $pendingCount = ShippingOrder::where('customer_id', Auth::id())
            ->where('status', 'pending')
            ->count();

        $inProgressCount = ShippingOrder::where('customer_id', Auth::id())
            ->where('status', 'inprogress')
            ->count();

        $deliveredCount = ShippingOrder::where('customer_id', Auth::id())
            ->where('status', 'delivered')
            ->count();

        $cancelledCount = ShippingOrder::where('customer_id', Auth::id())
            ->where('status', 'cancelled')
            ->count();

        return response()->json([
            'pending' => $pendingCount,
            'inprogress' => $inProgressCount,
            'delivered' => $deliveredCount,
            'cancelled' => $cancelledCount,
        ]);
    }
}
