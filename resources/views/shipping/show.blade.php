@extends('includes.layout')

@section('content')
<div class="container mt-3">
    <div class="card">
        <div class="card-header text-center">
            <h2>Shipping Order Invoice</h2>
            <p class="text-muted">Order #{{ $shippingOrder->id }}</p>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5>Customer Details</h5>
                    <p><strong>Name:</strong> {{ $shippingOrder->name }}</p>
                    <p><strong>Email:</strong> {{ $shippingOrder->email }}</p>
                    <p><strong>Phone:</strong> {{ $shippingOrder->phone_number ?? 'N/A' }}</p>
                </div>
                <div class="col-md-6 text-end">
                    <h5>Order Details</h5>
                    <p><strong>Status:</strong> {{ ucfirst($shippingOrder->status) }}</p>
                    <p><strong>Delivery Time:</strong> {{ \Carbon\Carbon::parse($shippingOrder->delivery_time)->format('d M Y, h:i A') }}</p>
                    <p><strong>Pickup Time:</strong> {{ \Carbon\Carbon::parse($shippingOrder->pickup_time)->format('d M Y, h:i A') }}</p>
                </div>
            </div>

            <hr>

            <div class="row mb-4">
                <div class="col-md-6">
                    <h5>Pickup Details</h5>
                    <p><strong>City:</strong> {{ $shippingOrder->pickup_city }}</p>
                    <p><strong>Address:</strong> {{ $shippingOrder->pickup_address }}</p>
                </div>
                <div class="col-md-6">
                    <h5>Delivery Details</h5>
                    <p><strong>City:</strong> {{ $shippingOrder->delivery_city }}</p>
                    <p><strong>Address:</strong> {{ $shippingOrder->delivery_address }}</p>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-6">
                    <h5>Package Details</h5>
                    <p><strong>Size:</strong> {{ ucfirst($shippingOrder->package_size) ?? 'N/A' }}</p>
                    <p><strong>Weight:</strong> {{ $shippingOrder->package_weight }} {{ $shippingOrder->weight_metric }}</p>
                    <p><strong>Number of Items:</strong> {{ $shippingOrder->number_of_items ?? 'N/A' }}</p>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button onclick="window.print()" class="btn btn-success">
                Print Invoice
            </button>
        </div>
    </div>
</div>
@endsection
