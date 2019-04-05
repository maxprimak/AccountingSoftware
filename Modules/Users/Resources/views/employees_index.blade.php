@extends('layouts.master')
<head>
  <link rel="stylesheet" href="assets/styles/css/themes/lite-purple.min.css">
  <link rel="stylesheet" href="assets/styles/vendor/perfect-scrollbar.css">
</head>


@section('main-content')
    <h2>List of employees</h2>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                <button type="button" data-trigger="hover" class="float-right btn btn-success m-1"  data-toggle="tooltip" data-placement="bottom" title="Add new employees">Add Employee</button>
                    <div class="card-title mb-3">Form Inputs</div>
                    <form id="signupForm" method="POST" action="/employees">
                      @csrf
                        <div class="row">
                          <div class="col-md-1 form-group mb-1">
                            <label for="id">ID</label>
                            <p>123</p>
                          </div>
                          <div class="col-md-2 form-group mb-3">
                              <label for="firstName1">Username</label>
                              <input disabled type="text" class="form-control" id="firstName1" name="username" value="{{$username}}">
                          </div>

                            <div class="col-md-2 form-group mb-3">
                                <label for="firstName1">Full name</label>
                                <input type="text" class="form-control" id="firstName1" placeholder="Enter your first name">
                            </div>

                            <div class="col-md-2 form-group mb-3">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                                <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                            </div>

                            <div class="col-md-2 form-group mb-3">
                                <label for="lastName1">	Phone</label>
                                <input type="text" class="form-control" id="lastName1" placeholder="Enter your last name">
                            </div>

                            <div class="col-md-2 form-group mb-3">
                                <label for="picker1">Role</label>
                                <select class="form-control">
                                    <option>Option 1</option>
                                    <option>Option 1</option>
                                    <option>Option 1</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
     </div>
  </script>
  <script src="{{asset('assets/js/vendor/echarts.min.js')}}"></script>
  <script src="{{asset('assets/js/es5/echart.options.min.js')}}"></script>
  <script src="{{asset('assets/js/es5/dashboard.v1.script.js')}}"></script>
  <script src="assets/js/vendor/jquery-3.3.1.min.js"></script>
  <script src="assets/js/vendor/bootstrap.bundle.min.js"></script>
  <script src="assets/js/vendor/perfect-scrollbar.min.js"></script>

  <script src="assets/js/es5/script.min.js"></script>
  <script src="assets/js/es5/sidebar.large.script.min.js"></script>

@endsection
