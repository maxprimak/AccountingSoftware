@extends('layouts.master')
@section('before-css')
<link rel="stylesheet" href="{{asset('assets/styles/vendor/smart.wizard/smart_wizard.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/styles/vendor/smart.wizard/smart_wizard_theme_arrows.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/styles/vendor/smart.wizard/smart_wizard_theme_circles.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/styles/vendor/smart.wizard/smart_wizard_theme_dots.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/styles/vendor/pickadate/classic.css')}}">
<link rel="stylesheet" href="{{asset('assets/styles/vendor/pickadate/classic.date.css')}}">
<link rel="stylesheet" href="{{asset('assets/styles/vendor/toastr.css')}}">
@endsection

@section('main-content')
            <div>
                <h1>Welcome!</h1>
            </div>
            <div>
                <h4>This quick registration to will help you to set Relist in a few steps</h4>
            </div>
            <div>
                <h6>You can skip this action by clicking<button type="button" onclick="window.location.assign('/dashboard')" class="btn btn-link">here</button>, but we highly recommend you not to do it</h6>
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
                            <li><a href="#step-1">Step 1<br /><small>Tell us about yourself</small></a></li>
                            <li><a href="#step-2">Step 2<br /><small>Tell us about your company</small></a></li>
                        </ul>

                        <div>
                            <div id="step-1" class="nav-link">
                                <h3 class="border-bottom border-gray pb-2">Tell us about yourself</h3>
                                <form id="reg_steps_submit" action="/reg_steps/submit" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="firstName1">Full name</label>
                                        <input type="text" class="form-control" name="name_user" id="name_user" placeholder="Enter your full name">
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label for="lastName1">Phone</label>
                                        <input type="text" class="form-control" name="phone_user" id="phone_user" placeholder="Enter your phone">
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label for="exampleInputEmail1">Address</label>
                                        <input type="text" class="form-control" name="address_user" id="address_user" placeholder="Enter your address">
                                    </div>

                                </div>
                            </div>
                            <div id="step-2" class="nav-link">
                                <h3 class="border-bottom border-gray pb-2">Tell us about your company</h3>
                                <div class="row">
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="firstName1">Company name</label>
                                        <input type="text" class="form-control" name="name_company" id="name_company" placeholder="Enter your company name">
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label for="lastName1">Company address</label>
                                        <input type="text" class="form-control" name="address_company" id="address_company" placeholder="Enter your company address">
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label for="exampleInputEmail1">Company phone number</label>
                                        <input type="email" class="form-control" name="phone_company" id="phone_company" placeholder="Enter company phone number">
                                    </div>

                                    <div class="col-md-12 table-responsive">
                                    <br>
                                    <center><h4>Company Offices/Branches</h4></center>
                                        <table class="table table-hover mb-3">
                                            <thead class="bg-gray-300">
                                                <tr>
                                                    <th>Branch name</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody-branches">
                                                <tr>
                                                    <td><input type="text" class="form-control col-md-4" name="name_branch[]" placeholder="Enter branch name" value="Main Branch" /></td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <button id="add-new-branch" type="button" class="btn btn-primary float-right mb-4">Add New Branch</button>
                                        <br>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


@endsection

@section('page-js')
<script>
//add/delete new branch
var newBranch = '<tr>'+
                '<td><input type="text" name="name_branch[]" class="form-control col-md-4" placeholder="Enter branch name" value="Secondary Branch" /></td>'+
                '<td><button onclick="$(this).parent().parent().remove();" class="btn btn-outline-secondary float-right">Delete</button></td>'+
                '</tr>';
$('#add-new-branch').click(function(){
    $('#tbody-branches').append(newBranch);
    $('#select-employee').append($('<option>', {value:'Secondary Branch', text:'Secondary Branch'}));
});
</script>
 <script src="{{asset('assets/js/vendor/jquery.smartWizard.min.js')}}"></script>
 <script src="{{asset('assets/js/vendor/toastr.min.js')}}"></script>
<script src="{{asset('assets/js/toastr.script.js')}}"></script>

@endsection

@section('bottom-js')

 <script src="{{asset('assets/js/smart.wizard.script.js')}}"></script>
 <script src="{{asset('assets/js/form.basic.script.js')}}"></script>

@endsection

