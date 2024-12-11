@extends('includes.layout')
@section('content')

<div class="container mt-3">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2>Shipping Orders</h2>
                <a href="{{ route('shipping-orders.create') }}" class="btn btn-primary">Create Order</a>
            </div>
            <div class="table-responseive">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th class="text-nowrap">Name</th>
                            <th class="text-nowrap">Email</th>
                            <th class="text-nowrap">Package Size</th>
                            <th class="text-nowrap">Weight</th>
                            <th class="text-nowrap">Delivery Time</th>
                            <th class="text-nowrap">Pickup City</th>
                            <th class="text-nowrap">Delivery City</th>
                            <th class="text-nowrap">Status</th>
                            <th class="text-nowrap">Actions</th>
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
                                <div class="dropdown">
                                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="actionDropdown{{ $order->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                        Actions
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="actionDropdown{{ $order->id }}">
                                        <li>
                                            <a href="{{ route('shipping-orders.show', $order->id) }}" class="dropdown-item">Show</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('shipping-orders.edit', $order->id) }}" class="dropdown-item">Edit</a>
                                        </li>
                                        <li>
                                            <form action="{{ route('shipping-orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this order?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger">Delete</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center">No orders found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="">
                {{ $shippingOrders->links() }}
            </div>
        </div>
    </div>

</div>

@endsection