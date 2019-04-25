@php
use Modules\Users\Entities\People;
use Modules\Users\Entities\Users;
use Modules\Users\Entities\Role;
use Modules\Login\Entities\Login;
@endphp

@extends('layouts.master')
<head>
  <link rel="stylesheet" href="assets/styles/css/themes/lite-purple.min.css">
  <link rel="stylesheet" href="assets/styles/vendor/perfect-scrollbar.css">
</head>

@section('main-content')

   <div class="breadcrumb">
              <h2>List of employees</h2>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                <button type="button" data-trigger="hover" class="float-right btn btn-success m-1" data-toggle="modal" data-target="#addEmployeeModal" title="Add new employees">Add Employee</button>
                    <div class="card-title mb-3">Form Inputs</div>
                    <form id="signupForm" method="POST" action="/employees/edit">
                      @csrf
                      {{ method_field('PATCH') }}
                      @foreach ($users as $user)
                        @php
                          $person = People::where('id',$user->person_id)->first();
                          $role = Role::where('id',$user->role_id)->first();
                          $login = Login::where('id',$user->login_id)->first();
                        @endphp
                            <div class="row">
                              <div class="col-md-1 form-group mb-1">
                                <label for="id">ID</label>
                                <p>{{$login->id}}</p>
                              </div>
                              <div class="col-md-2 form-group mb-3">
                                  <label for="firstName1">Username</label>
                                  <input disabled type="text" class="form-control" id="firstName1" name="username" value="{{$login->username}}">
                              </div>
                                <div class="col-md-2 form-group mb-3">
                                    <label for="firstName1">Full name</label>
                                    <input type="text" class="form-control" id="firstName1" placeholder="Enter your first name" name="full_name" value="{{$person->name}}">
                                </div>

                                <div class="col-md-2 form-group mb-3">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="email" value="{{$login->email}}">
                                     {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>  --}}
                                </div>
                                <div class="col-md-2 form-group mb-3">
                                    <label for="lastName1">	Phone</label>
                                    <input type="text" class="form-control" id="lastName1" placeholder="Enter your last name" name="phone" value="{{$person->phone}}">
                                </div>

                                <div class="col-md-2 form-group mb-3">
                                    <label for="picker1">Role</label>
                                    <select class="form-control">
                                        <option selected disabled hidden name="role">{{$role->name}}</option>
                                        @if(auth()->user()->username != $login->username)
                                          @foreach ($roles as $role_all)
                                            <option>{{$role_all->name}}</option>
                                          @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                      @endforeach
                      <div class="col-md-12">
                          <button class="btn btn-primary">Submit</button>
                      </div>
                      </form>


                        <!-- modal Add new employee -->
                        <div class="modal fade" id="addEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add new employee</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                              <form id="form-addEmployee" action="/employees/addEmployee" method="POST">
                              {{ csrf_field() }}
                              {{ method_field('PATCH') }}
                                  <center><strong><img width="170" class="rounded-circle" src="/assets/images/faces/00.jpg"></strong></center><br>
                                <div class="form-group">
                                  <label for="handy_bezeichnung">Login *:</label>
                                  <input required type="text" class="form-control" id="handy_bezeichnung" placeholder="Enter your username" name="new_login">
                                </div>
                                <div class="form-group">
                                  <label for="handy_bezeichnung">E-mail *:</label>
                                  <input required type="text"  class="form-control" id="handy_bezeichnung" placeholder="Enter @e-mail" name="new_email">
                                </div>
                                <div class="form-group">
                                  <label for="handy_bezeichnung">Password *:</label>
                                  <input required type="password" class="form-control" id="handy_bezeichnung" placeholder="Enter password" name="new_password">
                                </div>
                                <div class="form-group">
                                  <label for="handy_bezeichnung">Role *:</label>
                                  <select class="form-control" name="new_role">
                                    @foreach ($roles as $role_all)
                                      <option value="{{$role_all->id}}">{{$role_all->name}}</option>
                                    @endforeach
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label for="handy_bezeichnung">Full Name:</label>
                                  <input type="text" class="form-control" id="handy_bezeichnung" placeholder="Enter your full name" name="new_full_name">
                                </div>
                                <div class="form-group">
                                  <label for="handy_bezeichnung">Phone:</label>
                                  <input type="text" class="form-control" id="handy_bezeichnung" placeholder="+4367755533300" name="new_phone">
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-outline-secondary m-1">Cancel</button>
                                  <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                              </form>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- end modal kostenvorschlag-->
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
