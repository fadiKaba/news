{{-- <div class="container">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm pb-0 px-md-0">
        <div class="container">
            <span class="navbar-toggler-icon "></span>
            <span class="ml-2">sear</span>
            <div class="ml-md-4 d-none">
                <form action="">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="  search" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <div class="input-group-append">
                          <button class="btn btn-outline-secondary" type="button" id="button-addon2">Search</button>
                        </div>
                      </div>                
                </form>
            </div>
            
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    
                </ul>
            </div>
            <div class="text-left">
                <a class="lang d-none d-md-inline" href="#">Engilsh</a>
                <a class="lang ml-2 d-none d-md-inline" href="#">Arabic</a>
          
            </div>
                
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item mr-1">
                        <a class="main-btn" href="{{ route('login') }}">subscribe now</a>
                    </li>
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="main-btn" href="{{ route('login') }}">{{ __('Log in') }}</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
    
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
    
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest                   
                </ul>
            </div>
        </div>
    </nav>
    
    <nav class="navbar navbar-light bg-white pt-0">
        <span class="mt-5">date</span>
        <a class="brand mx-auto" href="#">My web site</a>
        <a class="mt-5" href="#">Today's Paper</a>
      </nav>
      
</div> --}}

<div class="container first-nav d-none d-md-block">
    <div class="row py-1">
        <div class="col-md-4 d-flex">
            <button id="menu-btn" class="btn"><img src="{{asset('ico/menu.svg')}}" alt="menu" width="18px"></button>
            <div class="d-flex">
                <button id="search-btn" class="btn"><img src="{{asset('ico/research.svg')}}" alt="menu" width="18px"></button>
                <form action="" id="search-form" class="d-none ml-1">
                    <div class="input-group">
                        <input class="form-control" type="text" placeholder="search">
                        <div class="input-group-append">
                            <button class="btn main-btn" type="button" id="button-addon2">go</button>
                        </div>
                    </div>                   
                </form>
            </div>          
        </div>
        <div class="col-md-4 text-center">
            <a href="#" class="lang font-weight-bold">Engilsh</a>
            <a href="#" class="lang ml-3">Arabic</a>
        </div>
        <div class="col-md-4 text-right">
            <button class="btn main-btn">subscribe</button>
            <button class="btn main-btn">login</button>
        </div>
    </div>
</div>
  <!-- left menu -->
<div id="left-menu" class="menu-left">
    <div class="btn-group dropright d-block">
            <a type="button" class="border-0">
            Home Page
            </a>
      </div>
      <div class="btn-group dropright d-block">
            <a type="button" class="border-0 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                World
            </a>
            <div class="dropdown-menu">
                <span class="text-muted">World</span>
                <a href="#" class="d-md-block">Africa</a>
                <a href="#" class="d-md-block">Asia</a>
                <a href="#" class="d-md-block">Australia</a>
                <a href="#" class="d-md-block">Americas</a>
                <a href="#" class="d-md-block">Europe</a>
        </div>
    </div>
    <div class="btn-group dropright d-block">
        <a type="button" class="border-0 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Art
        </a>
        <div class="dropdown-menu">
            <span class="text-muted">Art</span>
            <a href="#" class="d-md-block">Art & Design</a>
            <a href="#" class="d-md-block">Movies</a>
            <a href="#" class="d-md-block">Dance</a>
            <a href="#" class="d-md-block">Music</a>
            <a href="#" class="d-md-block">Television</a>
            <a href="#" class="d-md-block">Theater</a>
        </div>
    </div>
    <div class="btn-group dropright d-block">
        <a type="button" class="border-0 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Sport
        </a>
        <div class="dropdown-menu">
            <span class="text-muted">Sport</span>
            <a href="#" class="d-md-block">Baseball</a>
            <a href="#" class="d-md-block">Football</a>
            <a href="#" class="d-md-block">Golf</a>
            <a href="#" class="d-md-block">Tennis</a>
            <a href="#" class="d-md-block">Soccer</a>
            <a href="#" class="d-md-block">Hockey</a>
        </div>
    </div>
    <div class="btn-group dropright d-block">
        <a type="button" class="border-0 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Heath
        </a>
        <div class="dropdown-menu">
            <span class="text-muted">Health</span>
            <a href="#" class="d-md-block">Money & Policy</a>
            <a href="#" class="d-md-block">Health Guide</a>
        </div>
    </div>
    <div class="btn-group dropright d-block">
        <a type="button" class="border-0 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Food
        </a>
        <div class="dropdown-menu">
            <span class="text-muted">Food</span>
            <a href="#" class="d-md-block">Coocking</a>
            <a href="#" class="d-md-block">Restaurant Search</a>
        </div>
    </div>
    <div class="btn-group dropright d-block">
        <a type="button" class="border-0">
        Travel
        </a>
    </div>
    <div class="btn-group dropright d-block">
        <a type="button" class="border-0">
        Magazine
    </a>
    </div>
    <div class="btn-group dropright d-block">
        <a type="button" class="border-0">
        Books
        </a>
    </div>
</div>

<!-- end left menu -->