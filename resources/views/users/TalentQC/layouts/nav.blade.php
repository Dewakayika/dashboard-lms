<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid pt-2 px-3">
        <nav aria-label="breadcrumb">
            <h5 class="font-weight-bold mb-0 text-black ">Good to see you, <span class="font-weight-bolder">{{ $userData->name }}!</span></h5>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4 d-flex justify-content-end" id="navbar">
            <div class="ms-md-3 pe-md-3 d-flex align-items-center">
            </div>
            <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-flex align-items-center">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <a class="nav-link text-body font-weight-bold px-0" href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class="fa fa-user me-sm-1"></i>
                        <span class="d-sm-inline d-none">{{ __('Logout') }}</span>
                    </a>
                </form>
            </li>
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                    <i class="sidenav-toggler-line"></i>
                    <i class="sidenav-toggler-line"></i>
                    <i class="sidenav-toggler-line"></i>
                </div>
                </a>
            </li>
            <li class="nav-item px-3 d-flex align-items-center">
                <a href="javascript:;" class="nav-link text-body p-0">
                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                </a>
            </li>
            <li class="nav-item dropdown pe-2 d-flex align-items-center">
                <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-bell"
                    @if ($notification->isNotEmpty() && $notification->sortByDesc('created_at')->first()->created_at->diffInMinutes() <= 10)
                        style="color: #ff0000;"
                    @endif
                ></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                    @if ($notification->isEmpty())
                        <li class="mb-2">
                            <div class="text-center">
                                <img src="{{ asset('/assets/img/ilustration/NoMessages.svg')}}" class="avatar avatar-xl me-3">
                                <p class="px-7">No new notifications</p>
                            </div>
                        </li>
                    @else
                    @foreach ($notification->sortByDesc('created_at')->take(10) as $notif)
                        <li class="mb-2">
                            <a class="dropdown-item border-radius-md" href="javascript:;">
                                <div class="d-flex py-1">
                                    <div class="my-auto">
                                        @if ($notif->notif_type == 'general')
                                            <img src="{{ asset('/assets/img/General.png')}}" class="avatar avatar-sm me-3">
                                        @elseif($notif->notif_type == 'urgent')
                                            <img src="{{ asset('/assets/img/Urgent.png')}}" class="avatar avatar-sm me-3">
                                        @endif
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="text-sm font-weight-normal mb-1">
                                            <span class="font-weight-bold">{{$notif->subject}}</span>
                                        </h6>
                                        <p class="text-xs text-secondary mb-0">
                                            <i class="fa fa-clock me-1"></i>
                                            {{$notif->created_at->diffForHumans()}}
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endforeach
                    @endif
                </ul>
            </li>
            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->
