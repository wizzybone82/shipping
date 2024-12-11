@extends('includes.layout')
@section('content')

<div class="container mt-3">
    @if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
            <li class="list-item">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="card">
        <div class="card-header">
            Shipping Order Form
        </div>
        <div class="card-body">
            <form action="{{route('shipping-orders.store') }}" method="POST">
                @csrf
                
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $shippingOrder->name ?? '') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $shippingOrder->email ?? '') }}" required>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-3">
                            <label for="package_size" class="form-label">Package Size</label>
                            <select id="package_size" name="package_size" class="form-select">
                                <option value="">Select Size</option>
                                <option value="small" {{ old('package_size', $shippingOrder->package_size ?? '') == 'small' ? 'selected' : '' }}>Small</option>
                                <option value="medium" {{ old('package_size', $shippingOrder->package_size ?? '') == 'medium' ? 'selected' : '' }}>Medium</option>
                                <option value="large" {{ old('package_size', $shippingOrder->package_size ?? '') == 'large' ? 'selected' : '' }}>Large</option>
                                <option value="extra_large" {{ old('package_size', $shippingOrder->package_size ?? '') == 'extra_large' ? 'selected' : '' }}>Extra Large</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="package_weight" class="form-label">Package Weight</label>
                            <input type="number" id="package_weight" name="package_weight" class="form-control" value="{{ old('package_weight', $shippingOrder->package_weight ?? '') }}" required>
                        </div>

                        <div class="col-md-3">
                            <label for="weight_metric" class="form-label">Weight Metric</label>
                            <select id="weight_metric" name="weight_metric" class="form-select">
                                <option value="">Select Metric</option>
                                <option value="gram" {{ old('weight_metric', $shippingOrder->weight_metric ?? '') == 'gram' ? 'selected' : '' }}>Gram</option>
                                <option value="kg" {{ old('weight_metric', $shippingOrder->weight_metric ?? '') == 'kg' ? 'selected' : '' }}>Kilogram</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="number_of_items" class="form-label">Number of Items</label>
                            <input type="number" id="number_of_items" name="number_of_items" class="form-control" value="{{ old('number_of_items', $shippingOrder->number_of_items ?? '') }}">
                        </div>

                    </div>


                    <div class="col-md-6">
                            <label for="pickup_time" class="form-label">Pickup Time</label>
                            <input type="datetime-local" id="pickup_time" name="pickup_time" class="form-control" value="{{ old('pickup_time', $shippingOrder->pickup_time ?? '') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="delivery_time" class="form-label">Delivery Time</label>
                        <input type="datetime-local" id="delivery_time" name="delivery_time" class="form-control" value="{{ old('delivery_time', $shippingOrder->delivery_time ?? '') }}" required>
                    </div>



                    <div class="col-md-6">
                        <label for="pickup_city" class="form-label">Pickup City</label>
                        <input type="text" id="pickup_city" name="pickup_city" class="form-control" value="{{ old('pickup_city', $shippingOrder->pickup_city ?? '') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="pickup_address" class="form-label">Pickup Address</label>
                        <input type="text" id="pickup_address" name="pickup_address" class="form-control" value="{{ old('pickup_address', $shippingOrder->pickup_address ?? '') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="delivery_city" class="form-label">Delivery City</label>
                        <input type="text" id="delivery_city" name="delivery_city" class="form-control" value="{{ old('delivery_city', $shippingOrder->delivery_city ?? '') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="delivery_address" class="form-label">Delivery Address</label>
                        <input type="text" id="delivery_address" name="delivery_address" class="form-control" value="{{ old('delivery_address', $shippingOrder->delivery_address ?? '') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="customer_id" class="form-label">Customer ID</label>
                        <select class="form-select" name="customer_id">
                            @foreach($users as $u)
                            <option value="{{$u->id}}">{{$u->name}}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="status" class="form-label">Status</label>
                        <select id="status" name="status" class="form-select" required>
                            <option value="">Select Status</option>
                            <option value="pending" {{ old('status', $shippingOrder->status ?? '') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="in progress" {{ old('status', $shippingOrder->status ?? '') == 'in progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="shipped" {{ old('status', $shippingOrder->status ?? '') == 'in progress' ? 'selected' : '' }}>Shipped</option>
                            <option value="on route" {{ old('status', $shippingOrder->status ?? '') == 'in progress' ? 'selected' : '' }}>On Route</option>
                            <option value="delivered" {{ old('status', $shippingOrder->status ?? '') == 'delivered' ? 'selected' : '' }}>Delivered</option>
                            <option value="cancelled" {{ old('status', $shippingOrder->status ?? '') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="mobile_key" class="form-label">Mobile Key</label>
                        <input type="text" id="mobile_key" name="mobile_key" class="form-control" value="{{ old('mobile_key', $shippingOrder->mobile_key ?? '') }}">
                    </div>
                    <div class="col-md-6">
                        <label for="phone_number" class="form-label">Phone Number</label>
                        <input type="text" id="phone_number" name="phone_number" class="form-control" value="{{ old('phone_number', $shippingOrder->phone_number ?? '') }}">
                    </div>


                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">{{ isset($shippingOrder) ? 'Update' : 'Create' }} Shipping Order</button>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection