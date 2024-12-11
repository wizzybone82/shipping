@include('includes.header') <!-- Include the common header file -->

<div class="d-flex" id="wrapper">
    <!-- Sidebar -->
    <div class="bg-dark text-white border-right" id="sidebar-wrapper" style="min-width: 250px;">
        <div class="sidebar-heading text-center py-4 fs-4 fw-bold border-bottom">Shipping Dashboard</div>
        <button class="btn btn-danger btn-sm d-md-none ms-auto m-3" id="close-sidebar">&times;</button>
        <div class="list-group list-group-flush">
            <a href="/" class="list-group-item list-group-item-action bg-dark text-white">Dashboard</a>
            <!-- <a href="{{route('shipping-orders.create')}}" class="list-group-item list-group-item-action bg-dark text-white">Create Shipping Order</a> -->
            <a href="{{route('shipping-orders.index')}}" class="list-group-item list-group-item-action bg-dark text-white">Shipping Orders</a>
            <a href="{{route('users.index')}}" class="list-group-item list-group-item-action bg-dark text-white">Customers</a>
            
        </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper" class="flex-grow-1 d-flex flex-column">
        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
            <div class="container-fluid">
                <button class="btn btn-primary" id="menu-toggle">Toggle Menu</button>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Notifications</a>
                        </li>
                  

                        <li class="nav-item">
                            <a class="nav-link" href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        </li>

                        <form id="logout-form" action="{{ route('admin.destroy', [Auth::guard('admin')->id()])}}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container-fluid">
            @include('includes._messages')
            @yield('content')
           
        </div>
    </div>
    <!-- /#page-content-wrapper -->
</div>





@include('includes.footer') <!-- Include the common footer file -->


