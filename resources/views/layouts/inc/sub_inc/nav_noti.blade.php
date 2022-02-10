<li class="nav-item dropdown no-arrow mx-1">

    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-bell fa-fw"></i>
        <span class="badge badge-danger badge-counter">
            9+
        </span>
    </a>

    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">

        <h3 class="dropdown-header">
            Notifications
        </h3>

        {{-- new_user --}}

        @for ($i = 0; $i < 5; $i++)
            <a href="" class="dropdown-item d-flex align-items-center" >

                <div class="mr-3">
                    <div class="icon-circle ">
                        <i class='fas-fa-uer-plus text-white'>
                        </i>
                    </div>
                </div>

                <div>
                    <div class="small text-gray-700 mb-1">
                        <span class="mr-5">12/12/2020</span>
                    </div>
                    
                    <span>
                        Blah blah
                    </span>
                </div>
            </a>
        @endfor
        

        <a class="dropdown-item text-center text-gray-700 py-3" href="{{ url('/notifications') }}" style="background-color: #efefef;">
            View All Notifications
        </a> 
    </div>

</li>

