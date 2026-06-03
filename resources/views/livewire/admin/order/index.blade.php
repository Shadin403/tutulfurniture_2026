<div>
    @section('title', 'Manage Orders')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12">
                <div class="bg-light rounded h-100 p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h6 class="mb-0">Orders List</h6>
                        <a href="{{ route('admin.orders.create') }}" class="btn btn-primary btn-sm">Create New Order</a>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Customer</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                <tr>
                                    <th scope="row">{{ $order->id }}</th>
                                    <td>{{ $order->name }}<br><small>{{ $order->phone }}</small></td>
                                    <td>${{ number_format($order->total, 2) }}</td>
                                    <td><span class="badge bg-{{ $order->status == 'delivered' ? 'success' : ($order->status == 'canceled' ? 'danger' : 'primary') }}">{{ ucfirst($order->status) }}</span></td>
                                    <td>{{ $order->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-sm btn-info">Edit</a>
                                        <button wire:click="deleteOrder({{ $order->id }})" wire:confirm="Are you sure you want to delete this order?" class="btn btn-sm btn-danger">Delete</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
