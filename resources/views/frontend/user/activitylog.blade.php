@extends('layouts.frontend')

@include('layouts.inc.encrypt')


@section('title')
    Activity Log
@endsection

@section('content')

<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">

            <div class="page-header mb-4 mt-4 ml-3">
                <h4 class="page-title font-weight-bolder">
                    <span class="page-title-icon bg-gradient-primary text-white mr-2">
                    <i class="fa fa-bar-chart" aria-hidden="true"></i>
                    </span> Acticity Log
                </h4>
            </div>

            <div class="row">

                <div class="col-lg-3 act-tab">
                    <div class="sidebar">
                        <div class="widget">
                            <ul class='act-tab'>
                                <li class='waves-effect py-3 px-3 my-2'>
                                    <a href="{{ URL::current() }}" class="text-muted font-weight-bolder">
                                        <i class="fas fa-history"></i>&nbsp; All Browsing History
                                    </a>
                                </li>
                                <li class='waves-effect py-3 px-3 my-2'>
                                    <a href='{{ URL::current()."?Trash=removed-activities" }}' class="text-muted font-weight-bolder">
                                        <i class="fas fa-trash-alt"></i>&nbsp; Trash ( {{count($trashcount)}} )
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="widget widget-tag-cloud">
                            <h3 class="widget-title">Activity Tags</h3>
                            <div class="tagcloud">
                                <a href='{{ URL::current()."?activitytag=prod_search" }}'>Search</a>
                                <a href='{{ URL::current()."?activitytag=prod_detail" }}'>Product Detail</a>
                                <a href='{{ URL::current()."?activitytag=prod_like" }}'>Product Like</a>
                                <a href='{{ URL::current()."?activitytag=prod_review" }}'>Product Review</a>
                                <a href='{{ URL::current()."?activitytag=profile_view" }}'>Profile View</a>
                                <a href='{{ URL::current()."?activitytag=vendor_view" }}'>Vendor View</a>
                                <a href='{{ URL::current()."?activitytag=profile_update" }}'>Profile Update</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-9 act-list">

                    <div class="alert bg-secondary text-right">
                        <a href="" class="text-primary font-weight-bolder">Clear All Browsing Data</a>
                    </div>

                    @if (session('actdel'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{session('actdel')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if (session('actres'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{session('actres')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="row">

                        @foreach($activities as $i)

                            @php $encid = Crypt::encrypt($i->id); @endphp
                            @php $slname   = preg_replace('/[^a-z0-9]+/i', '.', trim(strtolower(Auth::user()->name))); @endphp

                            @php
                                $vendor_id = $i->vendor_id;
                                $vendor = App\Models\Request_vendor::where('user_id', $vendor_id)->get(); // For displaying vendor name
                            @endphp

                            <div class="col-lg-6 mb-4">

                                @if($i->type == 'view detail')
                                    <div class="card shadow mb-4">
                                        <div class="card-header bg-secondary py-3">
                                            <h6 class="m-0 font-weight-bold float-left text-primary">
                                                <i class="fas fa-history"></i> View Product Detail &nbsp;({{$i->created_at->diffForHumans()}})
                                            </h6>
                                            @if(isset($_GET["Trash"]))
                                                <a href='{{ URL::current()."?actres=$encid" }}'>
                                                    <h6 class="text-success float-right" title="Restore">
                                                        <i class="fas fa-undo-alt"></i>
                                                    </h6>
                                                </a>
                                            @else
                                                <a href='{{ URL::current()."?actdel=$encid" }}'>
                                                    <h6 class="text-danger float-right" title="Move to Trash">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </h6>
                                                </a>
                                            @endif
                                        </div>

                                        <div class="card-body">
                                            <div class="act-dtl mb-2">
                                                <a href="{{url('collection/'.$i->products->subcategory->category->group->url.'/'.$i->products->subcategory->category->url.'/'.$i->products->subcategory->url.'/'.$i->products->url.'/'.Crypt::encrypt($i->products->id)) }}">
                                                    <img class="img-fluid w-50 float-left" src="{{ asset('uploads/products/prod/'.$i->products->prod_image)}}">
                                                </a>
                                                <p>You viewd the Detail of <strong>{{$i->products->name}}</strong></p>
                                                <a href="{{url('collection/'.$i->products->subcategory->category->group->url.'/'.$i->products->subcategory->category->url.'/'.$i->products->subcategory->url.'/'.$i->products->url.'/'.Crypt::encrypt($i->products->id)) }}" class="font-weight-bold">
                                                    View Detail &rarr;
                                                </a>
                                            </div>
                                            <small class="text-muted"><i>{{date('F j, Y, g:i a',strtotime($i->created_at))}}</i></small>
                                        </div>
                                    </div>
                                @endif

                                @if($i->type == 'search')
                                    <div class="card search shadow mb-4">

                                        <div class="card-header bg-secondary py-3">
                                            <h6 class="m-0 font-weight-bold float-left text-primary">
                                                <i class="fas fa-history"></i> Product Search&nbsp;({{$i->created_at->diffForHumans()}})
                                            </h6>
                                            @if(isset($_GET["Trash"]))
                                                <a href='{{ URL::current()."?actres=$encid" }}'>
                                                    <h6 class="text-success float-right" title="Restore">
                                                        <i class="fas fa-undo-alt"></i>
                                                    </h6>
                                                </a>
                                            @else
                                                <a href='{{ URL::current()."?actdel=$encid" }}'>
                                                    <h6 class="text-danger float-right" title="Move to Trash">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </h6>
                                                </a>
                                            @endif
                                        </div>

                                        <div class="card-body">
                                            <div class="act-dtl">
                                                <p>You Searched <strong>{{$i->description}}</strong></p>
                                                <small class="text-muted"><i>{{date('F j, Y, g:i a',strtotime($i->created_at))}}</i></small>
                                            </div>
                                        </div>

                                    </div>
                                @endif

                                @if($i->type == 'profile update')
                                    <div class="card profile shadow mb-4">

                                        <div class="card-header bg-secondary py-3">
                                                <h6 class="m-0 font-weight-bold float-left text-primary">
                                                    <i class="fas fa-history"></i> Profile Update&nbsp;({{$i->created_at->diffForHumans()}})
                                                </h6>
                                                @if(isset($_GET["Trash"]))
                                                    <a href='{{ URL::current()."?actres=$encid" }}'>
                                                        <h6 class="text-success float-right" title="Restore">
                                                            <i class="fas fa-undo-alt"></i>
                                                        </h6>
                                                    </a>
                                                @else
                                                    <a href='{{ URL::current()."?actdel=$encid" }}'>
                                                        <h6 class="text-danger float-right" title="Move to Trash">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </h6>
                                                    </a>
                                                @endif
                                        </div>

                                        <div class="card-body">
                                            <div class="act-dtl mb-2">

                                                @if($i->users->Image)
                                                    <img class="img-fluid w-25 float-left" src="{{ asset('uploads/profile/'.$i->users->Image)}}" alt="{{ $i->users->name }}" title="{{ $i->users->name }}">
                                                @else
                                                    <img class="img-fluid float-left" src="{{ asset('assets/img/user.jpg')}}"  alt="{{ $i->users->name }}" title="{{ $i->users->name }}" width="90px">
                                                @endif
                                                <p>You updated your profile <strong>{{$i->users->name}}</strong></p>
                                                <a href="{{ url('me/'.$slname) }}" class="font-weight-bold">View profile &rarr;</a>

                                            </div>
                                            <small class="text-muted"><i>{{date('F j, Y, g:i a',strtotime($i->created_at))}}</i></small>
                                        </div>

                                    </div>
                                @endif

                                @if($i->type == 'profile view')
                                    <div class="card profile shadow mb-4">

                                        <div class="card-header bg-secondary py-3">
                                            <h6 class="m-0 font-weight-bold float-left text-primary">
                                                <i class="fas fa-history"></i> Profile View&nbsp;({{$i->created_at->diffForHumans()}})
                                            </h6>
                                            @if(isset($_GET["Trash"]))
                                                <a href='{{ URL::current()."?actres=$encid" }}'>
                                                    <h6 class="text-success float-right" title="Restore">
                                                        <i class="fas fa-undo-alt"></i>
                                                    </h6>
                                                </a>
                                            @else
                                                <a href='{{ URL::current()."?actdel=$encid" }}'>
                                                    <h6 class="text-danger float-right" title="Move to Trash">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </h6>
                                                </a>
                                            @endif
                                        </div>

                                        <div class="card-body">
                                            <div class="act-dtl mb-2">

                                                @if($i->users->Image)
                                                    <img class="img-fluid w-25 float-left" src="{{ asset('uploads/profile/'.$i->users->Image)}}" alt="{{ $i->users->name }}" title="{{ $i->users->name }}">
                                                @else
                                                    <img class="img-fluid float-left" src="{{ asset('assets/img/user.jpg')}}"  alt="{{ $i->users->name }}" title="{{ $i->users->name }}" width="90px">
                                                @endif

                                                <p>You viewed your profile <strong>{{$i->users->name}}</strong></p>
                                                <a href="{{ url('me/'.$slname) }}" class="font-weight-bold">View profile &rarr;</a>

                                            </div>
                                            <small class="text-muted"><i>{{date('F j, Y, g:i a',strtotime($i->created_at))}}</i></small>
                                        </div>

                                    </div>
                                @endif

                                @if($i->type == 'vendor view')
                                    <div class="card profile shadow mb-4">

                                        <div class="card-header bg-secondary py-3">
                                            <h6 class="m-0 font-weight-bold float-left text-primary">
                                                <i class="fas fa-history"></i> Vendor View&nbsp;({{$i->created_at->diffForHumans()}})
                                            </h6>
                                            @if(isset($_GET["Trash"]))
                                                <a href='{{ URL::current()."?actres=$encid" }}'>
                                                    <h6 class="text-success float-right" title="Restore">
                                                        <i class="fas fa-undo-alt"></i>
                                                    </h6>
                                                </a>
                                            @else
                                                <a href='{{ URL::current()."?actdel=$encid" }}'>
                                                    <h6 class="text-danger float-right" title="Move to Trash">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </h6>
                                                </a>
                                            @endif
                                        </div>

                                        @foreach($vendor as $v)

                                            @php
                                                $slname   = preg_replace('/[^a-z0-9]+/i', '_', trim(strtolower($v->vendor_name)));
                                                $encrypted = encrypt_decrypt('encrypt', $v->user_id);
                                            @endphp

                                            <div class="card-body">
                                                <div class="act-dtl mb-2">

                                                    @if($v->users->Image)
                                                        <img class="img-fluid w-25 float-left" src="{{ asset('uploads/profile/'.$v->users->Image)}}" alt="{{ $v->users->name }}" title="{{ $v->users->name }}">
                                                    @else
                                                        <img class="img-fluid float-left" src="{{ asset('assets/img/user.jpg')}}"  alt="{{ $v->users->name }}" title="{{ $v->users->name }}" width="90px">
                                                    @endif

                                                    <p>You viewed Vendor Profile <br/>
                                                        <strong>"{{$v->vendor_name}}"</strong>
                                                    </p>
                                                    <a href="{{ url('vendor/'.$slname.'/'.$encrypted) }}" class="font-weight-bold">View profile &rarr;</a>

                                                </div>
                                                <small class="text-muted"><i>{{date('F j, Y, g:i a',strtotime($i->created_at))}}</i></small>
                                            </div>

                                        @endforeach

                                    </div>
                                @endif

                                @if($i->type == 'product like')
                                    <div class="card shadow mb-4">

                                        <div class="card-header bg-secondary py-3">
                                            <h6 class="m-0 font-weight-bold float-left text-primary">
                                                <i class="fas fa-history"></i> Product Like&nbsp;({{$i->created_at->diffForHumans()}})
                                            </h6>
                                            @if(isset($_GET["Trash"]))
                                                <a href='{{ URL::current()."?actres=$encid" }}'>
                                                    <h6 class="text-success float-right" title="Restore">
                                                        <i class="fas fa-undo-alt"></i>
                                                    </h6>
                                                </a>
                                            @else
                                                <a href='{{ URL::current()."?actdel=$encid" }}'>
                                                    <h6 class="text-danger float-right" title="Move to Trash">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </h6>
                                                </a>
                                            @endif
                                        </div>

                                        <div class="card-body">
                                            <div class="act-dtl mb-2">
                                                <a href="{{url('collection/'.$i->products->subcategory->category->group->url.'/'.$i->products->subcategory->category->url.'/'.$i->products->subcategory->url.'/'.$i->products->url.'/'.Crypt::encrypt($i->products->id)) }}">
                                                    <img class="img-fluid w-50 float-left" src="{{ asset('uploads/products/prod/'.$i->products->prod_image)}}">
                                                </a>
                                                <p>You liked the product <strong>{{$i->products->name}}</strong></p>
                                                <a href="{{url('collection/'.$i->products->subcategory->category->group->url.'/'.$i->products->subcategory->category->url.'/'.$i->products->subcategory->url.'/'.$i->products->url.'/'.Crypt::encrypt($i->products->id)) }}" class="font-weight-bold">
                                                    View Detail &rarr;
                                                </a>
                                            </div>
                                            <small class="text-muted"><i>{{date('F j, Y, g:i a',strtotime($i->created_at))}}</i></small>
                                        </div>

                                    </div>
                                @endif

                                @if($i->type == 'review')
                                    <div class="card shadow mb-4">

                                        <div class="card-header bg-secondary py-3">
                                            <h6 class="m-0 font-weight-bold float-left text-primary">
                                                <i class="fas fa-history"></i> Product Review&nbsp;({{$i->created_at->diffForHumans()}})
                                            </h6>
                                            @if(isset($_GET["Trash"]))
                                                <a href='{{ URL::current()."?actres=$encid" }}'>
                                                    <h6 class="text-success float-right" title="Restore">
                                                        <i class="fas fa-undo-alt"></i>
                                                    </h6>
                                                </a>
                                            @else
                                                <a href='{{ URL::current()."?actdel=$encid" }}'>
                                                    <h6 class="text-danger float-right" title="Move to Trash">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </h6>
                                                </a>
                                            @endif
                                        </div>

                                        <div class="card-body">
                                            <div class="act-dtl mb-2">
                                                <a href="{{url('collection/'.$i->products->subcategory->category->group->url.'/'.$i->products->subcategory->category->url.'/'.$i->products->subcategory->url.'/'.$i->products->url.'/'.Crypt::encrypt($i->products->id)) }}">
                                                    <img class="img-fluid w-50 float-left" src="{{ asset('uploads/products/prod/'.$i->products->prod_image)}}">
                                                </a>
                                                <p>You Reviewd the product <strong>{{$i->products->name}}</strong></p>
                                                <a href="{{url('collection/'.$i->products->subcategory->category->group->url.'/'.$i->products->subcategory->category->url.'/'.$i->products->subcategory->url.'/'.$i->products->url.'/'.Crypt::encrypt($i->products->id)) }}" class="font-weight-bold">
                                                    View Detail &rarr;
                                                </a>
                                            </div>
                                            <small class="text-muted"><i>{{date('F j, Y, g:i a',strtotime($i->created_at))}}</i></small>
                                        </div>

                                    </div>
                                @endif

                            </div>

                        @endforeach

                        @if(!isset($_GET["activitytag"]) && !isset($_GET["Trash"]))
                            <div class="my-3">
                                {{ $activities->links("pagination::bootstrap-4") }}
                            </div>
                        @endif

                    </div>

                </div>

            </div>

        </div>
    </div>
</div>

@endsection
