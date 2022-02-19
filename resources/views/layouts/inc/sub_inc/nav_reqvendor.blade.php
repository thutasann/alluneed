<li class="nav-item dropdown no-arrow mx-1">

    <a class="nav-link dropdown-toggle" tittle="Vendor Request" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-envelope fa-fw"></i>
        @php
            $unread_noti = App\Models\Models\Request_vendor::where('status','0')->where('confirm', '0')->get();
        @endphp
        <span class="badge badge-danger badge-counter">
            @if(count($unread_noti) > 9)
                9+
            @else
                {{ count($unread_noti) }}
            @endif
        </span>
    </a>

    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">

        <h6 class="dropdown-header">
            Vendor Requests
        </h6>

        @php
            use App\Models\Models\Request_vendor;
            $req_all = Request_vendor::where('status',  '!=', '2')->where('confirm', '0')->orderByRaw('created_at DESC')->get();
        @endphp

        @foreach($req_all as $i)
            <a class="dropdown-item d-flex align-items-center" href="{{ url('vendor-request-confirm/'.$i->id) }}">
                <div class="dropdown-list-image mr-3">
                    @if($i->users->Image)
                        <img class="rounded-circle" src="{{ asset('uploads/profile/'.$i->users->Image) }}" alt="{{ $i->users->name }}">
                    @else
                        <img class="rounded-circle" src="{{ asset('assets/img/user.jpg')}}" alt="{{ $i->users->name }}">
                    @endif
                    <div class="status-indicator bg-success"></div>
                </div>
                <div class="{{ $i->status == '0' ? 'font-weight-bold' : '' }}">
                    <div>Vendor Rquest from <span class="text-primary">'{{ $i->vendor_name }}'</span></div>
                    <div class="small text-gray-500">{{ $i->users->name }} ·
                    {{ $i->created_at->diffForHumans() }}</div>
                </div>
            </a>
        @endforeach

        <a class="dropdown-item text-center text-gray-700 py-3" href="{{ url('/vendor-requests') }}" style="background-color: #efefef;">
            View All Vendor Requests
        </a>

    </div>

</li>
