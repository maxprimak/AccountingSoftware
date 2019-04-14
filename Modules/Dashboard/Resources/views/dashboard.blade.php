@extends('layouts.master')
@section('main-content')
            @if(!auth()->user()->hasVerifiedEmail())
            <div class="alert alert-danger">
                {{'Please verify your email adress. We have sent email to '. auth()->user()->email . '. If you do not see mail in inbox, check your spam folder. '}}
                <a href="{{ route('verification.resend') }}">Send email again</a><br>
                @if (session('resent'))
                            {{ __('A fresh verification link has been sent to your email address.') }}
                @endif
            </div>
            @endif
           <div class="breadcrumb">
            <br>
            <br>
                <h1>Generate Invoices</h1>
            </div>

            <div class="separator-breadcrumb border-top"></div>

            <div class="row">

                <div class="col-lg-3 col-md-6 col-sm-6" style="cursor: pointer;">
                <a href="{{route('rechnung_hand_dif.all')}}" style="display: block;">
                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                        <div class="card-body text-center">
                            <i class="i-Gear"></i>
                            <div class="content">
                                <p class="text-muted mt-2 mb-0">Rechnung Handy Diff.</p>
                            </div>
                        </div>
                    </div>
                </a>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6" style="cursor: pointer">
                <a href="{{route('kaufvertrag.all')}}" style="display: block;">
                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                        <div class="card-body text-center">
                            <i class="i-Financial"></i>
                            <div class="content">
                                <p class="text-muted mt-2 mb-0">Kaufvertrag</p>
                            </div>
                        </div>
                    </div>
                </a>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6" style="cursor: pointer">
                <a href="{{route('kostenvoranschlag.all')}}" style="display: block;">
                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                        <div class="card-body text-center">
                            <i class="i-Money-2"></i>
                            <div class="content">
                                <p class="text-muted mt-2 mb-0">Kostenvoranschlag</p>
                            </div>
                        </div>
                    </div>
                </a>
                </div>
            </div>
@endsection

@section('page-js')
     <script src="{{asset('assets/js/vendor/echarts.min.js')}}"></script>
     <script src="{{asset('assets/js/es5/echart.options.min.js')}}"></script>
     <script src="{{asset('assets/js/es5/dashboard.v1.script.js')}}"></script>
@endsection