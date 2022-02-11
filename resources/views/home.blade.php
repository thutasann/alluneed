@extends('layouts.frontend')

@section('title')
    Home
@endsection

@section('content')

<div class="realoutercontainer">
    <div class="outercontainer">
        <div class="outercontainer2">
          <div class="outercontainer3">
            <div class="outercontainer4">

              <h1>You are Loginned</h1>
              @if (session('status'))
                <p class="animated slideInDown">
                    {{ session('status') }}
                </p>
              @endif

            </div>
            <div class="redirecting animated slideInLeft">
              <p>Redirecting to Home Page in <span class="redirecting-time" id="redirect-time">8</span> seconds</p>
            </div>
          </div>
        </div>
    </div>

    <div class="common-rectangleGrid original">
        <!-- Background -->
        <div class="backgroundContainer">
          <div class="grid">
            <div class="background"></div>
          </div>
        </div>
        <!-- rectangles -->
        <div class="rectangleContainer">
          <div class="grid">
            <div class="rectangle"></div>
            <div class="rectangle"></div>
            <div class="rectangle"></div>
            <div class="rectangle"></div>
            <div class="rectangle"></div>
            <div class="rectangle"></div>
            <div class="rectangle"></div>
          </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script>
        // page timer
        var timeLimit = 7;
        var timer = setInterval(function(){
        time = document.getElementById('redirect-time');
        time.innerHTML = timeLimit;
        timeLimit--;
        if(timeLimit==-1){
            redirectToOrigin();
        }
        },1000)


        function redirectToOrigin(){
        clearInterval(timer);
        window.location.assign("/");
        }

    </script>
@endsection

