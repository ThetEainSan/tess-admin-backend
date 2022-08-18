@extends('layouts.master')
@section('title', 'Report Details')
@section('styles')
    <link href="{{ asset('assets/vendors/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <!-- Content Wrapper START -->
    <div class="main-content">
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <span class="alert-icon">
                    <i class="anticon anticon-check-o"></i>
                </span>
                {{ session()->get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                <div class="d-flex align-items-center justify-content-start">
                    <span class="alert-icon">
                        <i class="anticon anticon-close-o"></i>
                    </span>
                    {{ session()->get('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <h4 class="mr-auto">Report Details</h4>
                    <a class="btn btn-rounded btn-success text-right ml-auto" href="{{ route('reports.exportDetails',['id' => $bill_id]) }}" role="button">
                    <i class="anticon anticon-download mr-2" style="font-size:19px;"></i>Download Report</a>
                </div>
                <div class="m-t-25">
                    <table id="" class="table">
                        <thead class="text-center">
                            <tr>
                                <th>No.</th>
                                <th>Inventory</th>
                                <th>Unit Price</th>
                                <th>Quantity</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($sales as $sale)
                                @php
                                    ++$i;
                                @endphp
                                <tr class="text-center">
                                    <td>{{ $i }}.</td>
                                    <td>
                                        @php
                                            $inventory = App\Models\Inventory::find($sale->inventory_id);
                                        @endphp
                                        @if ($inventory->FOD == 'foods')
                                            <div class="avatar avatar-image" style="width: 30px; height:30px">
                                                <img src="{{ asset('img/food/' . $inventory->image) }}" alt="admin"
                                                    style="object-fit: cover;">
                                            </div>
                                        @else
                                            <div class="avatar avatar-image" style="width: 30px; height:30px">
                                                <img src="{{ asset('img/drink/' . $inventory->image) }}" alt="admin"
                                                    style="object-fit: cover;">
                                            </div>
                                        @endif
                                        {{ $inventory->name }}
                                    </td>
                                    <td>{{ $inventory->price }} MMK</td>
                                    <td>
                                        {{ $sale->quantity }}
                                    </td>
                                    <td>{{ $sale->price }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="text-right">
                            <tr>                               
                                <th colspan="4">Discount</th>
                                <th class="text-center">5 %</th>
                            </tr>
                            <tr>                               
                                <th colspan="4">Total</th>
                                <th class="text-center">{{ $total_price }}</th>
                            </tr>
                        </tfoot>
                    </table>
                    @php
                        $employee = App\Models\Employee::find($sale->employee_id);
                    @endphp
                    <h4>Action by - {{ $employee->name }}</h4>
                </div>
            </div>
        </div>
    </div>
    <!-- Content Wrapper END -->
@endsection

@section('scripts')
    <!-- page js -->
    <script src="{{ asset('assets/vendors/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/datatables.js') }}"></script>
@endsection
