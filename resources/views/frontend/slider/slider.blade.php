<div id="demo" class="carousel mt-0 slide off-slide" data-ride="carousel">
    
    <ul class="carousel-indicators">
        @for ($i = 0; $i <5 ; $i++)
            <li data-target="#demo" data-slide-to="{{ $i }}" class="{{ $i == '0' ? 'active' : '' }}"></li>
        @endfor
    </ul>

    <div class="carousel-inner">

        @for ($i = 0; $i < 5; $i++)

        <div class="carousel-item {{ $i == '1' ? 'active' : '' }}">
            <div class="offer-img" style="background-image:url('{{ asset('uploads/slider/1629021683.jpg')}}');">
                <div class="off-text">
                    <div class="real-text">
                        <h1 class="animated slideInDown">Slider 1</h1>
                        <p class="animated slideInLeft">Lorem espum...</p>
                        <a href="#">
                            See more
                        </a>
                    </div>
                </div>
            </div>
        </div>

        @endfor


        
    </div>

    <a class="carousel-control-prev" href="#demo" data-slide="prev">
        <span class="carousel-control-prev-icon"><i class="fa fa-chevron-left" aria-hidden="true"></i></span>
    </a>
    <a class="carousel-control-next" href="#demo" data-slide="next">
        <span class="carousel-control-next-icon"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>
    </a>

</div>