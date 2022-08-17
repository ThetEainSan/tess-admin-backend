@extends('layouts.master')
@section('title', 'Create Drink')

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
                    <a href="{{ route('drinks') }}" class="breadcrumb-item h6"><i
                            class="anticon anticon-shopping m-r-5"></i>Drinks</a>
                    <span class="breadcrumb-item active h6">Create</span>
                </nav>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h3>Create new Drink</h3>
                <div class="m-t-25">
                    <form method="post" action="{{ route('drinks.store') }}" enctype="multipart/form-data">
                         @csrf
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name"
                                    required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="price">Price</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" aria-label="Amount (to the nearest dollar)" name="price" id="price">
                                    <div class="input-group-append">
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>
                            </div> 
                            <div class="form-group col-md-4">
                                <label for="quantity">Quantity</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Quantity"
                                    required>
                            </div>                           
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="series">Series</label>
                                <input type="text" class="form-control" id="series" placeholder="Series" name="series"
                                    required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="type">Type</label>
                                <input type="text" class="form-control" id="type" placeholder="Type" name="type"
                                    required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="category">Category</label>
                                <input type="text" class="form-control" id="Category" placeholder="Cateogry" name="category"
                                    required>
                            </div>
                        </div>               
                        <div class="row">
                            <div class="col-md-8">
                                <label for="image" class="h5">Upload Image:</label>
                                <div class="col-mr-3"></div>
                                <input id="logo-file" type="file" name="image" onchange="loadFile(event)"
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
@endsection
