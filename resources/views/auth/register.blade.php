@extends('layouts.frontend')

@section('title')
    Register
@endsection

@section('content')

<div class="view full-page-intro">

    <div class='rgba-black-light d-flex justify-content-center align-items-center'>

        <div class='container mt-5'>
            <div class="row animated fadeIn">

                <div class="col-md-6 mb-4 white-text text-center text-md-left">

                    <h3 class="display-4 font-weight-bold">Already a user?</h3>

                    <hr class="hr-light">

                    <p class='animated slideInLeft'>
                        <strong>Need help? We are just a click away. <a href="">Contact Us</a></strong>
                    </p>

                    <p class="mb-4 d-md-block animated slideInDown">
                        <strong>8,00,000+  Vendors and Customers from all around the wrold come AllUNeed to sell and order products and build
                        strong partnership between them.
                        </strong>
                    </p>

                    <a href="{{url('login')}}" class="btn blue-gradient rounded animated slideInRight">Login &nbsp;
                        <i class="fas fa-sign-in-alt"></i>
                    </a>

                </div>

                <div class="col-md-6  mb-4">
                    <div class="card shadow-none border">

                        <h5 class="card-header bg-gradient-primary white-text d-flex justify-content-between py-4 mb-4">
                            <a class="navbar-brand" href="{{ url('/')}}" >
                                <img src="{{ asset('assets/img/logo.png')}}" width="100px">
                            </a>
                            <strong class="mt-2 pt-2">Create Account</strong>
                        </h5>

                        <div class="card-body">
                            <form class="text-center form-text-color" action="{{ route('register') }}" method="POST">
                                {{ csrf_field() }}

                                <!-- name / email -->
                                <div class="form-row">

                                    <div class="col">
                                        <div class="md-form form-group{{ $errors->has('name') ? ' has-error' : '' }} input-with-pre-icon">
                                            <i class="fas fa-user input-prefix"></i>
                                            <input id="name" type="text" class="form-control validate" name="name" value="{{ old('name') }}" required autofocus>
                                            <label for="name">Full Name</label>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="md-form form-group{{ $errors->has('email') ? ' has-error' : '' }} input-with-pre-icon">
                                            <i class="fas fa-envelope input-prefix"></i>
                                            <input id="email" type="email" class="form-control validate" name="email" value="{{ old('email') }}" required>
                                            <label for="email">Email</label>
                                        </div>
                                    </div>

                                </div>


                                @if ($errors->has('email'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ $errors->first('email') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                @if ($errors->has('name'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ $errors->first('name') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif


                                <!-- password -->
                                <div class='form-row'>
                                    <div class="col">
                                        <div class="md-form form-group{{ $errors->has('password') ? ' has-error' : '' }} input-with-pre-icon">
                                            <i class="fas fa-lock input-prefix"></i>
                                            <input id="password" type="password" class="form-control validate" name="password" required>
                                            <label for="password">Password (must be at least 8 characters)</label>
                                            <button id="eye-btn" type="button" class="fas fa-eye" onclick="myFunction_psw()"></button>
                                        </div>
                                    </div>
                                </div>

                                @if ($errors->has('password'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ $errors->first('password') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                <!-- confirm password -->
                                <div class="form-row">
                                    <div class="col">
                                        <div class="md-form input-with-pre-icon">
                                            <i class="fas fa-lock input-prefix"></i>
                                            <input id="password-confirm" type="password" class="form-control validate" name="password_confirmation" required>
                                            <label for="password-confirm">Confirm Password</label>
                                            <button id="eye-btn-con" type="button" class="fas fa-eye" onclick="myFunction_psw_con()"></button>
                                        </div>
                                    </div>
                                </div>

                                <!-- country -->
                                <div class="form-row">
                                    <div class="col">
                                        <div class="md-form input-with-pre-icon">
                                            <i class="fas fa-flag input-prefix"></i>
                                            <input type="search" name="country" id="form-autocomplete-country" class="form-control mdb-autocomplete validate" required>
                                            <label for="form-autocomplete" class="active">Your Country (Type '@')</label>
                                        </div>
                                    </div>
                                </div>

                                <button class="btn blue-gradient btn-block waves-effect btn-rounded z-depth-1a my-4" type="submit">
                                    Sign Up
                                </button>

                                <p class="mt-4 dark-grey-text text-right d-flex justify-content-center mb-3 pt-2"> or Sign up with:</p>

                                <div class="row my-3 d-flex justify-content-center">
                                    <button type="button" class="btn btn-white waves-effect rounded mr-md-3 z-depth-1a"><i class="fab fa-facebook-f blue-text text-center"></i></button>
                                    <button type="button" class="btn btn-white waves-effect rounded mr-md-3 z-depth-1a"><i class="fab fa-twitter blue-text"></i></button>
                                    <button type="button" class="btn btn-white waves-effect rounded z-depth-1a"><i class="fab fa-google-plus-g blue-text"></i></button>
                                </div>

                                <hr class="mt-4">

                                <p>By clicking <em>Sign up</em> you agree to our <a href="" target="_blank">terms of service</a>

                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>


</div>

<style>
    .first-nav,
    .sec-nav,
    #footer,
    .footer,
    .copyright{
        display:none;
    }
</style>


@endsection




