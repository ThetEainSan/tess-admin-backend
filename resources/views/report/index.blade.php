@extends('layouts.master')
@section('title','Reports')
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
                <h4 class="mr-auto">Report List</h4>
                {{-- <a class="btn btn-rounded btn-primary text-right ml-auto" href="" role="button">
                    <i class="anticon anticon-plus-circle mr-2" style="font-size:19px;"></i>Download Report</a> --}}
            </div>           
            <div class="m-t-25">
                <table id="data-table" class="table">
                    <thead class="text-center">
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
                        @foreach($reports as $report)
                        @php
                            ++$i;
                        @endphp
                        <tr class="text-center">
                            <td>{{ $i }}.</td>
                            <td>
                                {{ $report->bill_id }}
                            </td>
                            <td>{{ $report->total_price }} MMK</td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-primary mr-2" href="{{ route('reports.details', ['id' => $report->id]) }}" role="button">
                                        <i class="anticon anticon-info-circle mr-2"></i>View
                                    </a>
                                    <a class="btn btn-success mr-2" href="{{ route('reports.exportDetails',['id' => $report->id]) }}" role="button">
                                        <i class="anticon anticon-download mr-2"></i>Download
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="text-center">
                        <tr>
                            <th>No.</th>
                            <th>Bill_id</th>
                            <th>Total Price</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
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