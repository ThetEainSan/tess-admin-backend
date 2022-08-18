 <!-- Content Wrapper START -->
 @extends('layouts.master')
 @section('title', 'Dashboard')
 @section('content')

     <div class="main-content">
         <div class="row">
             <div class="col-lg-12">
                 <div class="row">
                     <div class="col-md-6">
                         <div class="card">
                             <div class="card-body">
                                 <div class="d-flex justify-content-between align-items-center">
                                     <div>
                                         <p class="m-b-0 text-muted">Admin</p>
                                         <h2 class="m-b-0">
                                             @php
                                                 $adminCount = App\Models\User::all()->count();
                                             @endphp
                                             {{ $adminCount }}
                                         </h2>
                                     </div>
                                     <span class="badge badge-pill badge-cyan font-size-30">
                                         <i class="anticon anticon-team"></i>
                                     </span>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="col-md-6">
                         <div class="card">
                             <div class="card-body">
                                 <div class="d-flex justify-content-between align-items-center">
                                     <div>
                                         <p class="m-b-0 text-muted">Employee</p>
                                         <h2 class="m-b-0">
                                             @php
                                                 $employeeCount = App\Models\Employee::all()->count();
                                             @endphp
                                             {{ $employeeCount }}
                                         </h2>
                                     </div>
                                     <span class="badge badge-pill badge-cyan font-size-30">
                                         <i class="anticon anticon-team"></i>
                                     </span>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="row">
                     <div class="col-md-6">
                         <div class="card">
                             <div class="card-body">
                                 <div class="d-flex justify-content-between align-items-center">
                                     <div>
                                         <p class="m-b-0 text-muted">Orders</p>
                                         <h2 class="m-b-0">
                                             @php
                                                 $orderCount = App\Models\Bill::all()->count();
                                             @endphp
                                             {{ $orderCount }}
                                         </h2>
                                     </div>
                                     <span class="badge badge-pill badge-cyan font-size-30">
                                         <i class="anticon anticon-dot-chart"></i>
                                     </span>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="col-md-6">
                         <div class="card">
                             <div class="card-body">
                                 <div class="d-flex justify-content-between align-items-center">
                                     <div>
                                         <p class="m-b-0 text-muted">Sales</p>
                                         <h2 class="m-b-0">
                                             @php
                                                 $sale = App\Models\Bill::sum('total_price');
                                             @endphp
                                             {{ $sale }} MMK
                                         </h2>
                                     </div>
                                     <span class="badge badge-pill badge-cyan font-size-30">
                                         <i class="anticon anticon-dollar"></i>
                                     </span>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>

         <div class="row">
             <div class="col-lg-8">
                 <div class="card">
                     <div class="card-body">
                         <div class="d-flex justify-content-between align-items-center">
                             <h5>Recent Orders</h5>
                             <div>
                                 <a href="{{ route('reports') }}" class="btn btn-sm btn-default">View All</a>
                             </div>
                         </div>
                         <div class="m-t-30">
                             <div class="table-responsive">
                                 @php
                                     $orders = App\Models\Bill::all()->take(3);
                                 @endphp
                                 <table class="table table-hover">
                                     <thead>
                                         <tr>
                                             <th>No.</th>
                                             <th>Bill_id</th>
                                             <th>Total Price</th>
                                             <th>Action</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         @php
                                             $i = 0;
                                         @endphp
                                         @foreach ($orders as $order)
                                             @php
                                                 $i++;
                                             @endphp
                                             <tr>
                                                 <td>{{ $i }}</td>
                                                 <td>{{ $order->bill_id }}</td>
                                                 <td>{{ $order->total_price }}</td>
                                                 <td>
                                                     <div class="btn-group">
                                                         <a class="btn btn-primary mr-2"
                                                             href="{{ route('reports.details', ['id' => $order->id]) }}"
                                                             role="button">
                                                             <i class="anticon anticon-info-circle mr-2"></i>View
                                                         </a>
                                                     </div>
                                                 </td>
                                             </tr>
                                         @endforeach
                                     </tbody>
                                 </table>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="col-lg-4">
                 <div class="card">
                     <div class="card-body">
                         <div class="d-flex justify-content-between align-items-center">
                             <h5>Top Products</h5>
                             {{-- <div>
                             <a href="javascript:void(0);" class="btn btn-sm btn-default">View All</a>
                         </div> --}}
                         </div>
                         <div class="m-t-30">
                             <ul class="list-group list-group-flush">
                                 @php
                                     $products = App\Models\Inventory::inRandomOrder()
                                         ->distinct()
                                         ->limit(4)
                                         ->get();
                                 @endphp
                                 @foreach ($products as $product)
                                     <li class="list-group-item p-h-0">
                                         <div class="d-flex align-items-center justify-content-between">
                                             <div class="d-flex">
                                                 <div class="avatar avatar-image m-r-15">
                                                     @if ($product->FOD == 'foods')
                                                         <img src="{{ asset('img/food/' . $product->image) }}"
                                                             alt="">
                                                     @else
                                                         <img src="{{ asset('img/drink/' . $product->image) }}"
                                                             alt="">
                                                     @endif
                                                 </div>
                                                 <div>
                                                     <h6 class="m-b-0">
                                                         <a href="javascript:void(0);" class="text-dark"> {{ $product->name }}</a>
                                                     </h6>
                                                     <span class="text-muted font-size-13">{{ $product->price }} MMK</span>
                                                 </div>
                                             </div>
                                             <span class="badge badge-pill badge-cyan font-size-12">
                                                 <span class="font-weight-semibold m-l-5">{{ $product->quantity }}</span>
                                             </span>
                                         </div>
                                     </li>
                                 @endforeach
                             </ul>
                         </div>
                     </div>
                 </div>
             </div>
         </div>

     </div>
     <!-- Content Wrapper END -->
 @endsection
