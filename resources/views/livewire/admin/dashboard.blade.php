<div>

    <!-- Sale & Revenue Start -->
    <div class="px-4 pt-4 container-fluid">
        <div class="row g-4">
            <div class="col-sm-6 col-xl-3">
                <div class="p-4 rounded bg-light d-flex align-items-center justify-content-between">
                    <i class="bi bi-layers-half fa-2x text-primary"></i>
                    <div class="ms-3">

                        <p class="mb-2">Total Product </p>
                        <h6 class="mb-0">{{ DB::table('products')->count() }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="p-4 rounded bg-light d-flex align-items-center justify-content-between">
                    <i class="text-black fa fa-users fa-3x"></i>
                    <div class="ms-3">
                        <p class="mb-2">Total Customer</p>
                        <h6 class="mb-0">{{ DB::table('users')->where('role', 'customer')->count() }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="p-4 rounded bg-light d-flex align-items-center justify-content-between">
                    <i class="fa fa-chart-line fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Total Order </p>
                        <h6 class="mb-0">{{ DB::table('orders')->count() }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="p-4 rounded bg-light d-flex align-items-center justify-content-between">
                    <i class="fa fa-chart-line fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Pandding Orders </p>
                        <h6 class="mb-0">{{ DB::table('orders')->where('status', 'ordered')->count() }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="p-4 rounded bg-light d-flex align-items-center justify-content-between">
                    <i class="fa fa-chart-line fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Cancel Orders </p>
                        <h6 class="mb-0">{{ DB::table('orders')->where('status', 'canceled')->count() }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="p-4 rounded bg-light d-flex align-items-center justify-content-between">
                    <i class="fa fa-chart-line fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Delivered Orders </p>
                        <h6 class="mb-0">{{ DB::table('orders')->where('status', 'delivered')->count() }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="p-4 rounded bg-light d-flex align-items-center justify-content-between">
                    <i class="fa fa-chart-pie fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Total Order Revenue</p>
                        <h6 class="mb-0">{{ DB::table('orders')->where('status', 'delivered')->sum('total') }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Body with Table -->
    <div class="p-0 card-body position-relative mt-5">
        <div class="table-responsive">
            <table class="table mb-0 align-middle table-hover table-bordered">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">#</th>
                        <th>Order-id</th>
                        <th>Customer-Name</th>
                        <th>Customer Phone </th>
                        <th>Customer Address</th>
                        <th>Total</th>
                        <th>Discount</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>

                @php
                    $Orders = App\Models\Order::latest()->take(3)->get();
                @endphp
                @forelse ($Orders as $index => $Order)
                    <tbody>
                        <tr wire:key="{{ $Order->id }}">
                            <td class="ps-4">
                                <p class="mb-0 text-sm">{{ $index + 1 }}</p>
                            </td>
                            <td class="ps-4">
                                @php
                                    $number = rand(1000, 9999);
                                @endphp
                                <p class="mb-0 text-sm">Order
                                    -{{ $Order->id }}</p>
                            </td>

                            <td>
                                <p class="mb-0 text-sm">{{ $Order->name }}</p>
                            </td>
                            <td>
                                <p class="mb-0 text-sm">{{ $Order->phone }}</p>
                            </td>
                            <td>
                                {{ $Order->address }} ,{{ $Order->locality }},{{ $Order->upazila }}
                                ,{{ $Order->district }},
                                {{ $Order->division }}
                            </td>
                            <td>
                                <p class="mb-0 text-sm">{{ $Order->total }}</p>
                            </td>
                            <td>
                                <p class="mb-0 text-sm">{{ $Order->discount }}</p>
                            </td>
                            <td>
                                <select wire:change="updateStatus({{ $Order->id }}, $event.target.value)"
                                    class="form-select text-white @if ($Order->status == 'ordered') bg-warning  @elseif($Order->status == 'shipped') bg-info @elseif($Order->status == 'delivered') bg-success @elseif($Order->status == 'canceled') bg-danger @endif">
                                    <option value="ordered" @selected($Order->status == 'ordered')>Ordered</option>
                                    <option value="shipped" @selected($Order->status == 'shipped')>Shipped</option>
                                    <option value="delivered" @selected($Order->status == 'delivered')>Delivered</option>
                                    <option value="canceled" @selected($Order->status == 'canceled')>Canceled</option>
                                </select>
                            </td>
                            <td class="text-end pe-4">
                                <a class="btn btn-link text-dark px-3 mb-0">
                                    <i class="bi bi-eye text-info"></i>
                                </a>



                                <a class="btn btn-link bg-danger text-white text-gradient px-3 mb-0">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No Orders found.</td>
                    </tr>
                @endforelse

            </table>



        </div>
    </div>

    <!-- Footer Start -->
    <div class="px-4 pt-4 container-fluid" style="margin-top: 700px">
        <div class="p-4 bg-light rounded-top">
            <div class="row">
                <div class="text-center col-12 col-sm-6 text-sm-start">
                    &copy; <a href="#">Tutul Furniture</a>, All Right Reserved.
                </div>
                <div class="text-center col-12 col-sm-6 text-sm-end">
                    <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                    Designed By <a href="http://dev-shadin.com">Dev Shadin</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->
</div>
