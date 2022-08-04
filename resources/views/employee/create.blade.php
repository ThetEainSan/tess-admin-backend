@extends('layouts.master')
@section('title', 'Create Employee')

@section('styles')
    {{-- <link href="{{ asset('assets/vendors/select2/select2.css') }}" rel="stylesheet"> --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endsection

@section('content')
    <!-- Content Wrapper START -->
    <div class="main-content">
        <div class="page-header">
            <div class="header-sub-title">
                <nav class="breadcrumb breadcrumb-dash">
                    <a href="{{ route('admins') }}" class="breadcrumb-item h6"><i
                            class="anticon anticon-team m-r-5"></i>Employees</a>
                    <span class="breadcrumb-item active h6">Create</span>
                </nav>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h3>Create new Admin</h3>
                <div class="m-t-25">
                    <form method="post" action="{{ route('employees.store') }}" enctype="multipart/form-data">
                         @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name"
                                    required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="phone">Phone</label>
                                <input type="number" class="form-control" id="phone" name="phone" placeholder="Phone"
                                    required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="phone">Position</label>
                                <select class="form-control" name="type" id="type" required>
                                    <option value="manager">Manager</option>
                                    <option value="barista">Barista</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Email" name="email"
                                    required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Password" name="password"
                                    required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="nrc_no">No</label>
                                <div class="m-b-15">
                                    <select class="form-control" name="nrc_no" id="nrc_no" required>
                                        @for ($i = 1; $i <= 14; $i++)
                                            <option value="{{ $i }}">{{ $i }} /</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="nrc_location">Location</label>
                                <div class="m-b-15">
                                    <select class="form-control" name="nrc_location" id="nrc_location" required>
                                        @foreach ($nrc_numbers as $nrc_number)
                                            <option value="{{ $nrc_number->id }}">{{ $nrc_number->prefix_en }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                @php
                                    $nrc_types = ['N', 'E', 'P', 'A', 'F', 'TH', 'G'];
                                @endphp
                                <label for="inputState">Type</label>
                                <select id="inputState" class="form-control" name="nrc_type">
                                    @foreach ($nrc_types as $nrc_type)
                                        <option value="({{ $nrc_type }})">({{ $nrc_type }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="nrc_number">Number</label>
                                <input type="number" class="form-control" id="nrc_number" placeholder="NRC Number"
                                    name="nrc_number" required>
                            </div>                           
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="inputCity">Address</label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="Address" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputState">State</label>
                                <select class="form-control" name="state" id="state" required>
                                    <option value="option_select" disabled selected>Select State</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->code }}">{{ $state->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="township" class="h5">City/Township</label>
                                    <div class="m-b-15">
                                        <select class="form-control" name="city" id="city" required>
                                        </select>
                                    </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <label for="image" class="h5">Upload Profile Image:</label>
                                <div class="col-mr-3"></div>
                                <input id="logo-file" type="file" name="avatar" onchange="loadFile(event)"
                                    style="width:100px" />
                                <img id="output" class=" cursor-pointer" onclick="changePhoto()"
                                    onmouseover="this.style.cursor ='pointer' " />
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <button class="btn btn-danger m-r-5" type="reset">Reset</button>
                                <button class="btn btn-primary" type="submit">
                                    Confirm
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Content Wrapper END -->
@endsection

@section('scripts')
    {{-- <script src="{{ asset('assets/vendors/select2/select2.min.js') }}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
    <script>
        //image preview
        var output = document.getElementById('output');
        var loadFile = function(event) {
            var reader = new FileReader();
            reader.onload = function() {
                document.getElementById('logo-file').setAttribute("style", "display:none")
                output.src = reader.result;
                output.setAttribute("style", "width:160px; height:100px");
            };
            reader.readAsDataURL(event.target.files[0]);
        };

        var changePhoto = function() {
            document.getElementById('logo-file').click()
        }
    </script>
    <script>
        // accessing townships and cities js
        $('#state').on('change', function() {
            // console.log(this.value);
            var state_id = this.value;
            $.ajax({
                url: "{{ route('getTownships') }}",
                type: "GET",
                data: {
                    "state_id": state_id,
                },
                cache: false,

                success: function(result) {
                    if (result) {
                        $("#city").empty();
                        $.each(result, function(key, value) {
                            $("#city").append('<option value="' + value.name + '">' + value.name +
                                '</option>');
                            //console.log(key, value);
                        });
                    } else {
                        $("#city").empty();
                    }
                }
            });
        });
    </script>
@endsection
