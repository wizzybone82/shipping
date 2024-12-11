@extends('includes.layout')
@section('content')
<div class="section">
    <h1 class="mt-4">Welcome to the Shipping Dashboard</h1>
    <p>This is your admin panel where you can manage your application. Add, edit, or delete content easily using the features available on the sidebar.</p>
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Users</h5>
                    <p class="card-text">Manage your application users.</p>
                    <a href="/users" class="btn btn-primary">View Details</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Orders</h5>
                    <p class="card-text">Check Orders performance and statistics.</p>
                    <a href="/shipping-orders" class="btn btn-primary">View Reports</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection