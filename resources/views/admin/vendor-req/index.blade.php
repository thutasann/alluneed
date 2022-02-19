@extends('layouts.admin')

@section('title')
	Vendor Requests
@endsection

@section('content')
    <div class="container-fluid mt-5">

        <div class="card mb-4 shadow-sm bg-gray-100 border-left-primary">
            <div class="card-body d-sm-flex align-items-center justify-content-between">
                <h6>
                    <a href="{{ url('/') }}">Dashboard</a>
                    <span><i class="fas fa-angle-right mx-1"></i></span>
                    <span>Vendor Requests</span>
                </h6>
            </div>
        </div>

        @if (session('status-remove'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('status-remove')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <section class="section">
            <div class="section__container">
                @foreach($req_all as $i)
                    <a href="{{ url('vendor-request-confirm/'.$i->id) }}" style="text-decoration: none;">
                        <div class="notification-list">

                            <div class="notification-list__image">
                                @if($i->users->Image)
                                    <img class="img-fluid rounded" src="{{ asset('uploads/profile/'.$i->users->Image) }}" alt="{{ $i->users->name }}">
                                @else
                                    <img class="img-fluid p-1" src="{{ asset('assets/img/user.jpg')}}" alt="{{ $i->users->name }}">
                                @endif
                            </div>

                            <div class="notification-list__info">

                                <h5 style="{{ $i->status == '0' ? 'font-weight: 700;' : 'font-weight: 400;' }}">
                                    Vendor <span class="text-primary">"{{ $i->vendor_name }}"</span> Request from {{ $i->users->name }}.
                                </h5>

                                <span class="hour">
                                    {{ $i->created_at->diffForHumans() }}
                                </span>

                                <span class="date">
                                    {{ date('F j, Y h:i A',strtotime($i->created_at)) }}
                                </span>

                                <div class="delete">
                                    <a href="{{ url('reqv-remove/'.$i->id) }}" title="Remove this Request">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>

                            </div>



                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    </div>
@endsection
