@vite('resources/css/sidebar/admin-sidebar.css')
@vite('resources/js/sidebar/admin-sidebar.js')
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

<div class="sidebar">
    <div class="sidebar-header">
        <div class="profile-pic">
            <img src="images/kurir.png" alt="">
        </div>
        <div class="profile-desc">
            <h3>{{ $adminData->name }}</h3>
            <p>{{ $adminData->email }}</p>
        </div>
    </div>
    <div class="nav">
        <div class="menu">
            <div class="title"></div>
            <ul>
                <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin#index') }}">
                        <i class="icon bx bxs-home"></i>
                        <span class="text">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="icon bx bxs-user"></i>
                        <span class="text">Users</span>
                        <i class='arrow bx bx-chevron-down'></i>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="#">
                                <span class="text">All Users</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="text">Talent</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="text">Intern</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>

</div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>