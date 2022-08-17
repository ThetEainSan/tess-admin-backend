@extends('layouts.master')
@section('title','Employee Profile')
@section('styles')
    <link href="{{ asset('vendors/select2/select2.css') }}" rel="stylesheet">
@endsection

@section('content')

        <!-- Content Wrapper START -->
        <div class="main-content">
            <div class="page-header">
                <div class="header-sub-title">
                    <nav class="breadcrumb breadcrumb-dash">
                        <a href="{{ route('employees') }}" class="breadcrumb-item h6"><i
                                class="anticon anticon-team m-r-5"></i>Employees</a>
                        <span class="breadcrumb-item active h6">Profile</span>
                    </nav>
                </div>
            </div>
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-9">
                                <div class="d-md-flex align-items-center">
                                    <div class="text-center text-sm-left ">
                                        <div class="avatar avatar-image" style="width: 150px; height:150px">
                                            <img src="{{ asset('img/employee/'. $employee->avatar) }}" alt="employee"
                                                style="object-fit: cover;">
                                        </div>
                                    </div>
                                    <div class="text-center text-sm-left m-v-15 p-l-30">
                                        <h2 class="m-b-5">{{ $employee->name }}</h2>
                                        @if ($employee->type == 'manager')
                                            <h6 class="text-primary">({{ $employee->type }})</h6>
                                        @else
                                            <h6 class="text-info">({{ $employee->type }})</h6>
                                        @endif
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ route('employees.edit', ['id' => $employee->id]) }}">
                                    <button class="btn btn-default btn-lg btn-success">
                                        Edit
                                    </button>
                                </a>
                                <a href="{{ route('employees.delete', ['id' => $employee->id]) }}">
                                    <button class="btn btn-default btn-lg btn-danger">
                                        Delete
                                    </button>
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h5>Details</h5>

                                <div class="row">
                                    <div class="col">
                                        <ul class="list-unstyled m-t-10">
                                            <li class="row">
                                                <p class="col-sm-4 col-4 font-weight-semibold text-dark m-b-5">
                                                    <i class="m-r-10 text-primary anticon anticon-mail"></i>
                                                    <span>Email: </span>
                                                </p>
                                                <p class="col font-weight-semibold"> {{ $employee->email }}</p>
                                            </li>
                                            <li class="row">
                                                <p class="col-sm-4 col-4 font-weight-semibold text-dark m-b-5">
                                                    <i class="m-r-10 text-primary anticon anticon-phone"></i>
                                                    <span>Phone: </span>
                                                </p>
                                                <p class="col font-weight-semibold"> {{ $employee->phone }}</p>
                                            </li>
                                            <li class="row">
                                                <p class="col-sm-4 col-5 font-weight-semibold text-dark m-b-5">
                                                    <i class="m-r-10 text-primary anticon anticon-idcard"></i>
                                                    <span>NRC: </span>
                                                </p>
                                                <p class="col font-weight-semibold">{{ $employee->nrc_no }} /
                                                    {{ $employee->nrc_type }} / {{ $employee->nrc_number }}</p>
                                            </li>
                                            <li class="row">
                                                <p class="col-sm-4 col-4 font-weight-semibold text-dark m-b-5">
                                                    <i class="m-r-10 text-primary anticon anticon-environment"></i>
                                                    <span>Address: </span>
                                                </p>
                                                <p class="col font-weight-semibold"> {{ $employee->address }}</p>
                                            <li class="row">
                                                <p class="col-sm-4 col-4 font-weight-semibold text-dark m-b-5">
                                                    <i class="m-r-10 text-primary anticon anticon-environment"></i>
                                                    <span>City: </span>
                                                </p>
                                                <p class="col font-weight-semibold"> {{ $employee->city }}</p>
                                            <li class="row">
                                                <p class="col-sm-4 col-4 font-weight-semibold text-dark m-b-5">
                                                    <i class="m-r-10 text-primary anticon anticon-environment"></i>
                                                    <span>State: </span>
                                                </p>
                                                <p class="col font-weight-semibold"> {{ $employee->state }}</p>                                           
                                            </li>
                                            </li>
                                            </li>
                                        </ul>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

@endsection

@section('scripts')
    <!-- Core JS -->
    <script src="{{ asset('js/app.min.js') }}"></script>
@endsection