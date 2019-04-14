@extends('layouts.master')
@section('before-css')
<link rel="stylesheet" href="{{asset('assets/styles/vendor/smart.wizard/smart_wizard.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/styles/vendor/smart.wizard/smart_wizard_theme_arrows.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/styles/vendor/smart.wizard/smart_wizard_theme_circles.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/styles/vendor/smart.wizard/smart_wizard_theme_dots.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/styles/vendor/pickadate/classic.css')}}">
<link rel="stylesheet" href="{{asset('assets/styles/vendor/pickadate/classic.date.css')}}">
@endsection

@section('main-content')
            <div>
                <h1>Great!</h1>
            </div>
            <div>
                <h4>Let's move to employees creation</h4>
            </div>
            <div>
                <h6>You can skip this action by clicking<button onclick="window.location.assign('/dashboard')" type="button" class="btn btn-link">here</button>, but we highly recommend you not to do it</h6>
            </div>

            <div hidden class="row mb-3">
                <div class="col-12 col-lg-6 col-sm-12">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="theme_selector">Themes</label>
                        </div>
                        <select id="theme_selector" class="custom-select col-lg-6 col-sm-12">
                            <option value="arrows">arrows</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <!-- SmartWizard html -->
                    <div id="smartwizard" class="sw-main sw-theme-arrows">
                        <ul>                    
                            <li><a href="#step-3">Step 3<br /><small>Add employees to your company</small></a></li>
                        </ul>

                        <div>
                        <div id="step-3" class="nav-link">
                                <h3>Add Employees to Your Company</h3>
                                <h6 class="border-bottom border-gray pb-2">Just add the main info to create accounts and give tasks. Your employees can log in and edit accounts independently</h6>
                                <div class="col-md-12 table-responsive">
                                        <table class="table table-hover mb-3">
                                            <thead class="bg-gray-300">
                                                <tr>
                                                    <th width="15%">Name</th>
                                                    <th width="15%">Email</th>
                                                    <th width="15%">Username</th>
                                                    <th width="15%">Password</th>
                                                    <th width="15%">Role</th>
                                                    <th width="15%">Branch</th>
                                                    <th width="10%"></th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody-employee">
                                                <tr>
                                                    <td><input name="name[]" type="text" class="form-control" /></td>
                                                    <td><input name="email[]" type="text" class="form-control" /></td>
                                                    <td><input name="username[]" type="text" class="form-control" /></td>
                                                    <td><input name="password[]" type="text" class="form-control" /></td>
                                                    <td><select name="role[]" id="" class="form-control">
                                                        @foreach($roles as $role)
                                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                                        @endforeach
                                                    </select></td>
                                                    <td><select name="branch[]" id="select-employee" class="form-control">
                                                        @foreach($branches as $branch)
                                                            <option value="{{$branch->id}}">{{$branch->name}}</option>
                                                        @endforeach
                                                    </select></td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <button id="add-new-employee" type="button" class="btn btn-primary float-right mb-4">Add New Employee</button>
                                        <br>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


@endsection

@section('page-js')
<script>
//add/delete new branch
var newEmployee = '<tr>'+
                    '<td><input name="name[]" type="text" class="form-control" /></td>'+
                    '<td><input name="email[]" type="text" class="form-control" /></td>'+
                    '<td><input name="username[]" type="text" class="form-control" /></td>'+
                    '<td><input name="password[]" type="text" class="form-control" /></td>'+
                    '<td><select name="role[]" id="" class="form-control">'+
                        '@foreach($roles as $role)'+
                            '<option value="{{$role->id}}">{{$role->name}}</option>'+
                        '@endforeach'+
                    '</select></td>'+
                    '<td><select name="branch[]" id="" class="form-control">'+
                        '@foreach($branches as $branch)'+
                            '<option value="{{$branch->id}}">{{$branch->name}}</option>'+
                        '@endforeach'+
                    '</select></td>'+
                    '<td><button onclick="$(this).parent().parent().remove();" class="btn btn-outline-secondary float-right">Delete</button></td>'+
                '</tr>';
$('#add-new-employee').click(function(){
$('#tbody-employee').append(newEmployee);
});
</script>
 <script src="{{asset('assets/js/vendor/jquery.smartWizard.min.js')}}"></script>

@endsection

@section('bottom-js')

 <script src="{{asset('assets/js/smart.wizard.script.js')}}"></script>
 <script src="{{asset('assets/js/form.basic.script.js')}}"></script>

@endsection



