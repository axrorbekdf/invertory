<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="{{ asset('backend/img/logo/logo.png') }}" rel="icon">
  <title>Easy Learning Invertory - Dashboard</title>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
  <link href="{{ asset('backend/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('backend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('backend/css/ruang-admin.min.css') }}" rel="stylesheet">
</head>

<body id="page-top">
    <div id="app">
        <div id="wrapper">
            <!-- Sidebar -->
            <nav id="sidebar" v-show="$route.path === '/' || $route.path === '/register' || $route.path === '/forget' ? false : true" class="d-none">
              <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">

                <router-link class="sidebar-brand d-flex align-items-center justify-content-center" to="/home">
                  <div class="sidebar-brand-icon">
                    <img src="{{ asset('backend/img/logo/logo2.png') }}">
                  </div>
                  <div class="sidebar-brand-text mx-3">Easy Learning Invertory</div>
                </router-link>
                <hr class="sidebar-divider my-0">
                <li class="nav-item active">
                  <router-link class="nav-link" to="/home">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                  </router-link>
                </li>
                <li class="nav-item bg-info">
                  <router-link class="nav-link" to="/pos">
                      <i class="fas fa-fw fa-tachometer-alt" style="color:white;"></i>
                      <font color="#ffffff"><span>POS</span></font>
                  </router-link>
                </li>
                <hr class="sidebar-divider">
                <div class="sidebar-heading">
                  Features
                </div>
                <li class="nav-item">
                  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#employee"
                    aria-expanded="true" aria-controls="employee">
                    <i class="far fa-fw fa-window-maximize"></i>
                    <span>Employee</span>
                  </a>
                  <div id="employee" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                      <h6 class="collapse-header">Employee</h6>
                      <router-link to="/employees" class="collapse-item">All Employee</router-link>
                      <router-link to="/store-employee" class="collapse-item">Add Employee</router-link>
                    </div>
                  </div>
                </li>
                <li class="nav-item">
                  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#suppliers"
                    aria-expanded="true" aria-controls="suppliers">
                    <i class="far fa-fw fa-window-maximize"></i>
                    <span>Suppliers</span>
                  </a>
                  <div id="suppliers" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                      <h6 class="collapse-header">Suppliers</h6>
                      <router-link to="/suppliers" class="collapse-item">All Suppliers</router-link>
                      <router-link to="/store-supplier" class="collapse-item">Add Suppliers</router-link>
                    </div>
                  </div>
                </li>

                <li class="nav-item">
                  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#categories"
                    aria-expanded="true" aria-controls="categories">
                    <i class="far fa-fw fa-window-maximize"></i>
                    <span>Categories</span>
                  </a>
                  <div id="categories" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                      <h6 class="collapse-header">Categories</h6>
                      <router-link to="/categories" class="collapse-item">All Categories</router-link>
                      <router-link to="/store-category" class="collapse-item">Add Categories</router-link>
                    </div>
                  </div>
                </li>

                <li class="nav-item">
                  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#products"
                    aria-expanded="true" aria-controls="products">
                    <i class="far fa-fw fa-window-maximize"></i>
                    <span>Products</span>
                  </a>
                  <div id="products" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                      <h6 class="collapse-header">Products</h6>
                      <router-link to="/products" class="collapse-item">All Products</router-link>
                      <router-link to="/store-product" class="collapse-item">Add Products</router-link>
                    </div>
                  </div>
                </li>

                <li class="nav-item">
                  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#expense"
                    aria-expanded="true" aria-controls="expense">
                    <i class="far fa-fw fa-window-maximize"></i>
                    <span>Expenses</span>
                  </a>
                  <div id="expense" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                      <h6 class="collapse-header">Expenses</h6>
                      <router-link to="/expenses" class="collapse-item">All Expenses</router-link>
                      <router-link to="/store-expense" class="collapse-item">Add Expenses</router-link>
                    </div>
                  </div>
                </li>

                <li class="nav-item">
                  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#customer"
                    aria-expanded="true" aria-controls="customer">
                    <i class="far fa-fw fa-window-maximize"></i>
                    <span>Customer</span>
                  </a>
                  <div id="customer" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                      <h6 class="collapse-header">Customers</h6>
                      <router-link to="/customers" class="collapse-item">All Customer</router-link>
                      <router-link to="/store-customer" class="collapse-item">Add Customer</router-link>
                    </div>
                  </div>
                </li>

                <li class="nav-item">
                  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#salary"
                    aria-expanded="true" aria-controls="salary">
                    <i class="far fa-fw fa-window-maximize"></i>
                    <span>Salaries</span>
                  </a>
                  <div id="salary" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                      <h6 class="collapse-header">Salaries</h6>
                      <router-link to="/given-salary" class="collapse-item">Add Salary</router-link>
                      <router-link to="/salary" class="collapse-item">All Salary</router-link>
                    </div>
                  </div>
                </li>

                <li class="nav-item">
                  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#order"
                    aria-expanded="true" aria-controls="order">
                    <i class="far fa-fw fa-window-maximize"></i>
                    <span>Orders</span>
                  </a>
                  <div id="order" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                      <h6 class="collapse-header">Salaries</h6>
                      <router-link to="/order" class="collapse-item">Today Orders</router-link>
                      <router-link to="/salary" class="collapse-item">Search</router-link>
                    </div>
                  </div>
                </li>

                <li class="nav-item">
                  <router-link to="/stock" class="nav-link">
                      <i class="far fa-fw fa-window-maximize"></i>
                      <span>Stock</span>
                  </router-link>
                </li>

                <li class="nav-item">
                  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#reports"
                    aria-expanded="true" aria-controls="reports">
                    <i class="far fa-fw fa-window-maximize"></i>
                    <span>Reports</span>
                  </a>
                  <div id="reports" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                      <h6 class="collapse-header">Customers</h6>
                      <router-link to="/customers" class="collapse-item">Reports One</router-link>
                      <router-link to="/store-customer" class="collapse-item">Reports Two</router-link>
                    </div>
                  </div>
                </li>

                
              </ul>
            </nav>
            <!-- Sidebar -->
            <div id="content-wrapper" class="d-flex flex-column">
              <div id="content">
                <!-- TopBar -->
                <nav id="topbar" v-show="$route.path === '/' || $route.path === '/register' || $route.path === '/forget' ? false : true" class="d-none navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
                  <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                  </button>
                  <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown no-arrow">
                      <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-search fa-fw"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                        aria-labelledby="searchDropdown">
                        <form class="navbar-search">
                          <div class="input-group">
                            <input type="text" class="form-control bg-light border-1 small" placeholder="What do you want to look for?"
                              aria-label="Search" aria-describedby="basic-addon2" style="border-color: #3f51b5;">
                            <div class="input-group-append">
                              <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                              </button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </li>
                    <li class="nav-item dropdown no-arrow mx-1">
                      <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bell fa-fw"></i>
                        <span class="badge badge-danger badge-counter">3+</span>
                      </a>
                      <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="alertsDropdown">
                        <h6 class="dropdown-header">
                          Alerts Center
                        </h6>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                          <div class="mr-3">
                            <div class="icon-circle bg-primary">
                              <i class="fas fa-file-alt text-white"></i>
                            </div>
                          </div>
                          <div>
                            <div class="small text-gray-500">December 12, 2019</div>
                            <span class="font-weight-bold">A new monthly report is ready to download!</span>
                          </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                          <div class="mr-3">
                            <div class="icon-circle bg-success">
                              <i class="fas fa-donate text-white"></i>
                            </div>
                          </div>
                          <div>
                            <div class="small text-gray-500">December 7, 2019</div>
                            $290.29 has been deposited into your account!
                          </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                          <div class="mr-3">
                            <div class="icon-circle bg-warning">
                              <i class="fas fa-exclamation-triangle text-white"></i>
                            </div>
                          </div>
                          <div>
                            <div class="small text-gray-500">December 2, 2019</div>
                            Spending Alert: We've noticed unusually high spending for your account.
                          </div>
                        </a>
                        <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                      </div>
                    </li>
                    <li class="nav-item dropdown no-arrow mx-1">
                      <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-envelope fa-fw"></i>
                        <span class="badge badge-warning badge-counter">2</span>
                      </a>
                      <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="messagesDropdown">
                        <h6 class="dropdown-header">
                          Message Center
                        </h6>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                          <div class="dropdown-list-image mr-3">
                            <img class="rounded-circle" src="{{ asset('backend/img/man.png') }}" style="max-width: 60px" alt="">
                            <div class="status-indicator bg-success"></div>
                          </div>
                          <div class="font-weight-bold">
                            <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been
                              having.</div>
                            <div class="small text-gray-500">Udin Cilok · 58m</div>
                          </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                          <div class="dropdown-list-image mr-3">
                            <img class="rounded-circle" src="{{ asset('backend/img/girl.png') }}" style="max-width: 60px" alt="">
                            <div class="status-indicator bg-default"></div>
                          </div>
                          <div>
                            <div class="text-truncate">Am I a good boy? The reason I ask is because someone told me that people
                              say this to all dogs, even if they aren't good...</div>
                            <div class="small text-gray-500">Jaenab · 2w</div>
                          </div>
                        </a>
                        <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                      </div>
                    </li>
                    <li class="nav-item dropdown no-arrow mx-1">
                      <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-tasks fa-fw"></i>
                        <span class="badge badge-success badge-counter">3</span>
                      </a>
                      <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="messagesDropdown">
                        <h6 class="dropdown-header">
                          Task
                        </h6>
                        <a class="dropdown-item align-items-center" href="#">
                          <div class="mb-3">
                            <div class="small text-gray-500">Design Button
                              <div class="small float-right"><b>50%</b></div>
                            </div>
                            <div class="progress" style="height: 12px;">
                              <div class="progress-bar bg-success" role="progressbar" style="width: 50%" aria-valuenow="50"
                                aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </div>
                        </a>
                        <a class="dropdown-item align-items-center" href="#">
                          <div class="mb-3">
                            <div class="small text-gray-500">Make Beautiful Transitions
                              <div class="small float-right"><b>30%</b></div>
                            </div>
                            <div class="progress" style="height: 12px;">
                              <div class="progress-bar bg-warning" role="progressbar" style="width: 30%" aria-valuenow="30"
                                aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </div>
                        </a>
                        <a class="dropdown-item align-items-center" href="#">
                          <div class="mb-3">
                            <div class="small text-gray-500">Create Pie Chart
                              <div class="small float-right"><b>75%</b></div>
                            </div>
                            <div class="progress" style="height: 12px;">
                              <div class="progress-bar bg-danger" role="progressbar" style="width: 75%" aria-valuenow="75"
                                aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </div>
                        </a>
                        <a class="dropdown-item text-center small text-gray-500" href="#">View All Taks</a>
                      </div>
                    </li>
                    <div class="topbar-divider d-none d-sm-block"></div>
                    <li class="nav-item dropdown no-arrow">
                      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <img class="img-profile rounded-circle" src="{{ asset('backend/img/boy.png') }}" style="max-width: 60px">
                        <span class="ml-2 d-none d-lg-inline text-white small">Maman Ketoprak</span>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">
                          <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                          Profile
                        </a>
                        <a class="dropdown-item" href="#">
                          <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                          Settings
                        </a>
                        <a class="dropdown-item" href="#">
                          <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                          Activity Log
                        </a>
                        <div class="dropdown-divider"></div>
                        <router-link to="/logout" class="dropdown-item">
                          <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                          Logout
                        </router-link>
                      </div>
                    </li>
                  </ul>
                </nav>
                <!-- Topbar -->

                <!-- Container Fluid-->
                <div class="container-fluid" id="container-wrapper">
                
                    <router-view></router-view>

                </div>
                <!---Container Fluid-->
              </div>
              <!-- Footer -->
              <footer id="footer" v-show="$route.path === '/' || $route.path === '/register' || $route.path === '/forget' ? false : true" class="d-none sticky-footer bg-white">
                <div class="container my-auto">
                  <div class="copyright text-center my-auto">
                    <span>copyright &copy; 2022 - developed by
                      <b><a href="https://indrijunanda.gitlab.io/" target="_blank">indrijunanda</a></b>
                    </span>
                  </div>
                </div>
              </footer>
              <!-- Footer -->
            </div>
        </div>
    </div>

    <!-- Scroll to top -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('backend/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script type="text/javascript">
      $(function(){
          let token = localStorage.getItem('token');
          if(token){
            $("#sidebar").removeClass("d-none");
            $("#topbar").removeClass("d-none");
            $("#footer").removeClass("d-none");
          }
      })
    </script>

    <script src="{{ asset('backend/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('backend/js/ruang-admin.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('backend/js/demo/chart-area-demo.js') }}"></script>
</body>

</html>