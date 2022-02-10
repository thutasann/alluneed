<li class="nav-item dropdown no-arrow mx-1">
    
    <a class="nav-link dropdown-toggle" tittle="Vendor Request" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-envelope fa-fw"></i>
        <span class="badge badge-danger badge-counter">
            9+
        </span>
    </a>

    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">

        <h6 class="dropdown-header">
            Vendor Requests
        </h6>

        @for ($i = 0; $i < 5; $i++)
            <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="{{ asset('assets/img/user.jpg')}}" alt="Vendor">
                    <div class="status-indicator bg-success"></div>
                </div>
                <div class="font-weight-bold">
                    <div>Vendor Rquest from <span class="text-primary">Win Mobile</span></div>
                    <div class="small text-gray-500">Win mobile · 
                    12/12/2020</div>
                </div>
            </a>
        @endfor


        <a class="dropdown-item text-center text-gray-700 py-3" href="{{ url('/vendor-requests') }}" style="background-color: #efefef;">
            View All Vendor Requests
        </a>

    </div>

</li>