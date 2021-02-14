@extends('layouts.frontend')

@section('title')
    Login
@endsection

@section('content')

<div class="view full-page-intro">

    <div class='rgba-black-light d-flex justify-content-center align-items-center'>

        <div class="container mt-5">
            <div class="row animated fadeIn">

                <div class="col-md-6 mb-4 white-text text-center text-md-left">

                    <h3 class="display-4 font-weight-bold">New to AllUNeed?</h3>

                    <hr class="hr-light">

                    <p class="animated slideInLeft">
                    <strong>Easy & simple way to create account in AllUNeed.</strong>
                    </p>

                    <p class="mb-4 d-md-block animated slideInDown">
                    <strong>8,00,000+ Vendors and Customers from all around the wrold come AllUNeed to sell and order products and build
                    strong partnership between them.
                    </strong>
                    </p>

                    <a href="{{url('register')}}" class="btn blue-gradient rounded animated slideInRight">Register Here &nbsp;
                        <i class="fas fa-user-circle"></i>
                    </a>

                </div>

                <div class="col-md-6 mb-4">
                    <div class="card shadow">

                        <h5 class="card-header bg-gradient-primary white-text text-center py-4 mb-4">
                            Sign In
                        </h5>

                        <div class="card-body px-lg-5 pt-3">

                            @if (session('status-password'))
                                <div class="alert alert-info alert-dismissible fade show" role="alert">
                                    {{session('status-password')}}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if (session('pls-login'))
                                <div class="alert alert-info alert-dismissible fade show" role="alert">
                                    {{session('pls-login')}}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if (session('pls-login-wish'))
                                <div class="alert alert-info alert-dismissible fade show" role="alert">
                                    {{session('pls-login')}}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <form class="text-center form-text-color" action="{{ route('login') }}" method="POST">
                                {{ csrf_field() }}
                                
                                <div class="form-row">
                                    <div class="col">
                                        <div class="md-form form-group{{ $errors->has('email') ? ' has-error' : '' }} input-with-pre-icon">
                                            <i class="fas fa-envelope input-prefix"></i>
                                            <input id="email" type="email" class="form-control validate" name="email" value="{{ old('email') }}" required autofocus>
                                            @if ($errors->has('email'))
                                                <span class="help-block text-danger">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                            <label for="email">E-mail</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col">
                                        <div class="md-form form-group{{ $errors->has('password') ? ' has-error' : '' }} input-with-pre-icon">
                                            <i class="fas fa-lock input-prefix"></i>
                                            <input id="password" type="password" class="form-control validate" name="password" required>

                                            @if ($errors->has('password'))
                                                <span class="help-block text-danger">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                            <label for="Password">Password</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col">
                                        <div class="d-flex justify-content-around">
                                            <div>
                                                <div class="form-check">
                                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="Remember">Remember me</label>
                                                </div>
                                            </div>
                                            <div>
                                                <a href="{{ route('password.request') }}" class="">Forgot your password?</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button class="btn blue-gradient btn-block waves-effect btn-rounded z-depth-1a my-4" type="submit">
                                    Sign in
                                </button>


                                <p class="mt-4 dark-grey-text text-right d-flex justify-content-center mb-3 pt-2"> or Sign In with:</p>

                                <div class="row my-3 d-flex justify-content-center">
                                    <button type="button" class="btn btn-white waves-effect rounded mr-md-3 z-depth-1a"><i class="fab fa-facebook-f blue-text text-center"></i></button>
                                    <button type="button" class="btn btn-white waves-effect rounded mr-md-3 z-depth-1a"><i class="fab fa-twitter blue-text"></i></button>
                                    <button type="button" class="btn btn-white waves-effect rounded z-depth-1a"><i class="fab fa-google-plus-g blue-text"></i></button>
                                </div>
                            </form>

                        </div>

                    </div>
                </div>
                
            </div>
        </div>

    </div>

</div>

@endsection

