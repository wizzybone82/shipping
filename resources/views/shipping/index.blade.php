@extends('includes.layout')
@section('content')

<div class="container mt-3">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2>Shipping Orders</h2>
                <a href="{{ route('shipping-orders.create') }}" class="btn btn-primary">Create Order</a>
            </div>

            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Package Size</th>
                        <th>Weight</th>
                        <th>Delivery Time</th>
                        <th>Pickup City</th>
                        <th>Delivery City</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($shippingOrders as $order)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $order->name }}</td>
                        <td>{{ $order->email }}</td>
                        <td>{{ ucfirst($order->package_size) }}</td>
                        <td>{{ $order->package_weight }} {{ $order->weight_metric }}</td>
                        <td>{{ $order->delivery_time }}</td>
                        <td>{{ $order->pickup_city }}</td>
                        <td>{{ $order->delivery_city }}</td>
                        <td><span class="badge bg-{{ $order->status == 'pending' ? 'warning' : ($order->status == 'in progress' ? 'primary' : ($order->status == 'delivered' || $order->status == 'on route' || $order->status == 'shipped' ? 'success' : 'danger')) }}">{{ ucfirst($order->status) }}</span></td>
                        <td>
                            <a href="{{ route('shipping-orders.show', $order->id) }}" class="btn btn-primary btn-sm">Show</a>
                            <a href="{{ route('shipping-orders.edit', $order->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('shipping-orders.destroy', $order->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this order?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="text-center">No orders found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="">
                    {{ $shippingOrders->links() }}
            </div>
        </div>
    </div>

</div>

@endsection