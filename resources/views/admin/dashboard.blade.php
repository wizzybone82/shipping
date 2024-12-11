@include('includes.header') <!-- Include the common header file -->

<div class="d-flex" id="wrapper">
    <!-- Sidebar -->
    <div class="bg-dark text-white border-right" id="sidebar-wrapper" style="min-width: 250px;">
        <div class="sidebar-heading text-center py-4 fs-4 fw-bold border-bottom">Admin Panel</div>
        <button class="btn btn-danger btn-sm d-md-none ms-auto m-3" id="close-sidebar">&times;</button>
        <div class="list-group list-group-flush">
            <a href="#" class="list-group-item list-group-item-action bg-dark text-white">Dashboard</a>
            <a href="#" class="list-group-item list-group-item-action bg-dark text-white">Create Shipping Order</a>
            <a href="#" class="list-group-item list-group-item-action bg-dark text-white">Shipping Orders</a>
            <a href="#" class="list-group-item list-group-item-action bg-dark text-white">Customers</a>
            
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

        <div class="container-fluid py-4">
            <h1 class="mt-4">Welcome to the Admin Dashboard</h1>
            <p>This is your admin panel where you can manage your application. Add, edit, or delete content easily using the features available on the sidebar.</p>
            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Users</h5>
                            <p class="card-text">Manage your application users.</p>
                            <a href="#" class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Reports</h5>
                            <p class="card-text">Check application performance and statistics.</p>
                            <a href="#" class="btn btn-primary">View Reports</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->
</div>





@include('includes.footer') <!-- Include the common footer file -->


