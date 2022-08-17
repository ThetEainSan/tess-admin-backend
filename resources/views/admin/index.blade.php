@extends('layouts.master')
@section('title','Admins')
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
                <h4 class="mr-auto">Admin List</h4>
                <a class="btn  btn-rounded btn-primary text-right ml-auto" href="{{ route('admins.create') }}" role="button">
                    <i class="anticon anticon-plus-circle mr-2" style="font-size:19px;"></i>Create New Admin</a>
            </div>           
            <div class="m-t-25">
                <table id="data-table" class="table">
                    <thead class="text-center">
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 0;
                        @endphp
                        @foreach($admins as $admin)
                        @php
                            ++$i;
                        @endphp
                        <tr class="text-center">
                            <td>{{ $i }}.</td>
                            <td>
                                <div class="avatar avatar-image" style="width: 30px; height:30px">
                                    <img src="{{ asset('img/admin/'. $admin->avatar) }}" alt="admin"
                                        style="object-fit: cover;">
                                </div>
                                {{ $admin->name }}
                            </td>
                            <td>{{ $admin->email }}</td>
                            <td>{{ $admin->phone }}</td>
                            <td>
                                {{-- <div>
                                    <button class="btn btn-info btn-sm">Edit</button>
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </div> --}}
                                <div class="btn-group">
                                    <a class="btn btn-primary mr-2" href="{{ route('admins.details', ['id' => $admin->id]) }}" role="button">
                                        <i class="anticon anticon-info-circle mr-2"></i>View</a>
                                    <a class="btn btn-info" href="{{ route('admins.edit', ['id' => $admin->id]) }}" role="button">
                                        <i class="anticon anticon-edit mr-2"></i>Edit</a>
                                    <a class="btn btn-danger ml-2" href="{{ route('admins.delete', ['id' => $admin->id]) }}" role="button">
                                        <i class="anticon anticon-delete mr-2"></i></i>Delete</a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="text-center">
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
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