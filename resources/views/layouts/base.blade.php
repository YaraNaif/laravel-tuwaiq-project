<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <title>Admin-Panel - لوحة القيادة</title>
    <style>
        *{
            font-family: cairo;
            color:white
        }

    </style>
</head>
<body dir="{{(session()->get('locale')=='ar' ? 'rtl' : 'ltr')}}">
    <Header>
          <!-- Navbar -->
          <!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
    <!-- Container wrapper -->
    <div class="container-fluid">
        <!-- Navbar brand -->
        <a class="navbar-brand" href="#">Brand</a>

        <!-- Icons -->
        
        <ul class="navbar-nav d-flex flex-row me-1">
            <li class="nav-item me-3 me-lg-0">
                <a class="nav-link text-white" href="#"><i class="fas fa-envelope mx-1"></i> {{ __('messages.Contact') }}</a>
            </li>
            <li class="nav-item me-3 me-lg-0">
            <a class="nav-link text-white" href="#"><i class="fas fa-cog mx-1"></i>{{ __('messages.Settings') }}</a>


      <!-- dropdwon language  -->
<li class="nav-item dropdown p-3">
    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        اللغة
    </a>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item text-center" href="{{ url('language/ar') }}">العربية <img src="images/saudi-arabia.png" class="rounded-circle" width="30" height="30" alt=""></a></li>
        <li><a class="dropdown-item text-center" href="{{ url('language/en') }}">English <img src="images/en.png" class="rounded-circle" width="30" height="30" alt=""></a></li>
    </ul>
</li>


         <!-- dropdwon acc  -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <i class="fas fa-user mx-1"></i> Welcome  {{ Auth::user()->name }}! </a>
                <!-- Dropdown menu -->
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li>
                        <a class="dropdown-item" href="#">My account</a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="{{route('logout')}}">Log out</a>
                    </li>
                </ul>
            </li>
        </ul>
        
    </div>

    <!-- Container wrapper -->
</nav>
<!-- Navbar -->
          <!-- Navbar --> 
    </Header>

    <main>
    
          <div class="row">
            <div class="col-auto col-sm-3 col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <span class="fs-5 d-none d-sm-inline">Menu</span>
                    </a>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                        <li class="nav-item">
                            <a href="{{route('index')}}" class="nav-link align-middle px-0">
                                <i class="bi bi-house-door"></i> <span class="ms-1 d-none d-sm-inline">Home</span>
                            </a>
                        </li>
                        <li>
                                <!-- new function for read and search here -->
                        <a href="{{route('get-products')}}" class="nav-link align-middle px-0">


                            <i class="bi bi-bag"></i> <span class="ms-1 d-none d-sm-inline">Product</span> </a>
                          
                        </li>
                        <li>
                            <!-- i used the function in products details for search only -->
                            <a href="{{route('Product-Details')}}" class="nav-link px-0 align-middle">
                                <i class="bi bi-bag-heart-fill"></i> <span class="ms-1 d-none d-sm-inline">Product Details</span></a>
                        </li>
                        <li>
                            <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                                <i class="fs-4 bi-bootstrap"></i> <span class="ms-1 d-none d-sm-inline text-white">Cards</span></a>
                          
                        </li>
                        <li>
                            <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-grid"></i> <span class="ms-1 d-none d-sm-inline text-white">Invoice</span> </a>
                               
                        </li>
                        <li>
                            <a href="#" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline text-white">Customers</span> </a>
                        </li>
                    </ul>
                    <hr>
                    
                    <div class="dropdown pb-4">
    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="bi bi-person-square"></i>
        <span class="d-none d-sm-inline mx-1">{{ Auth::user()->name }}</span>
    </a>
</div>

               
                </div>
           
            </div>
            <div class="col-auto col-sm-8 col-md-8 col-xl-6 px-sm-6 px-0">
                @yield('content')
            </div>
         </div>
    </main>

   <footer>
            
   </footer>

</body>
</html>