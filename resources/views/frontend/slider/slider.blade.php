<div id="demo" class="carousel mt-0 slide off-slide" data-ride="carousel">

    <ul class="carousel-indicators">
        @php $i = 0;  @endphp
        @foreach ($sliders as $item)
            @php $i++; @endphp
            <li data-target="#demo" data-slide-to="{{ $i }}" class="{{ $i == '0' ? 'active' : '' }}"></li>
        @endforeach
    </ul>

    <div class="carousel-inner">

        @php $i = 1; @endphp

        @foreach ($sliders as $item )

        @php
            $truncated = Illuminate\Support\Str::limit($item->description, 250);
        @endphp

        <div class="carousel-item {{ $i == '1' ? 'active' : '' }}">
            @php $i++; @endphp
            <div class="offer-img" style="background-image:url('{{ asset('uploads/slider/'.$item->image)}}');">
            <div class="off-text">
                <div class="real-text">
                <h1 class="animated slideInDown">{{ $item->heading }}</h1>
                <p class="animated slideInLeft">{{ $truncated }}...</p>
                <a href="{{ url('ad/'.$item->link) }}">
                    {{ $item->link_name }}
                </a>
                </div>
            </div>
            </div>
        </div>

        @endforeach

    </div>

    <a class="carousel-control-prev" href="#demo" data-slide="prev">
        <span class="carousel-control-prev-icon"><i class="fa fa-chevron-left" aria-hidden="true"></i></span>
    </a>
    <a class="carousel-control-next" href="#demo" data-slide="next">
        <span class="carousel-control-next-icon"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>
    </a>

</div>



