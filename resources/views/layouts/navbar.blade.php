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

<!-- firs navbar -->
<div class="container first-nav d-none d-md-block">
    <div class="row pt-1">
        <div class="col-md-4 d-flex">
            <button id="menu-btn" class="btn"><img src="{{asset('ico/menu.svg')}}" alt="menu" width="18px"></button>
            <div class="d-flex">
                <button id="search-btn" class="btn ml-2"><img src="{{asset('ico/research.svg')}}" alt="menu" width="18px"></button>
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
            <a href="#" class="btn main-btn text-white">subscribe</a>
            {{-- <a href="/login" class="btn main-btn text-white">login</a> --}}

        @guest
                <a class="btn main-btn text-white" href="{{ route('login') }}">{{ __('Log in') }}</a>
        @else
            <a class="nav-item dropdown">
                <a id="navbarDropdown" class="dropdown-toggle btn main-btn text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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
            </a>
        @endguest

        </div>
    </div>
</div>
  <!-- end firs navbar -->
  
  <!-- left menu -->
<div id="left-menu" class="menu-left">
    <button class="btn close-menu"><img src="{{asset('ico/close.svg')}}" alt="close" width="15px"></button>
    {{-- <button class="btn close close-menu p-2">
        <span aria-hidden="true">X</span>
    </button> --}}
    <div class="btn-group dropright d-block">
            <a href="/" type="button" class="border-0">
            Home Page
            </a>
      </div>
      <div class="btn-group dropright d-block">
            <a type="button" class="border-0 dropdown-toggle"  aria-haspopup="true" aria-expanded="false">
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
        <a type="button" class="border-0 dropdown-toggle" aria-haspopup="true" aria-expanded="false">
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
        <a type="button" class="border-0 dropdown-toggle" aria-haspopup="true" aria-expanded="false">
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
        <a type="button" class="border-0 dropdown-toggle" aria-haspopup="true" aria-expanded="false">
            Heath
        </a>
        <div class="dropdown-menu">
            <span class="text-muted">Health</span>
            <a href="#" class="d-md-block">Money & Policy</a>
            <a href="#" class="d-md-block">Health Guide</a>
        </div>
    </div>
    <div class="btn-group dropright d-block">
        <a type="button" class="border-0 dropdown-toggle" aria-haspopup="true" aria-expanded="false">
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

<!-- second navbar -->
<div class="container second-navbar">
    <div class="row">
        <div class="col-md-4 text-left date">
           <p class=" d-none d-md-flex">{{date('l, M d, Y')}}</p>
        </div>
        <div class="col-md-4 text-center brand">
            <div class="d-flex d-md-none">
                <div class="col-2 px-0">
                   <button class="navbar-toggler" 
                   type="button" 
                   data-toggle="collapse" 
                   data-target="#navbarNavDropdown" 
                   aria-controls="navbarNavDropdown" 
                   aria-expanded="false" 
                   aria-label="Toggle navigation"
                   class="btn"><img src="{{asset('/ico/menu.svg')}}" alt="menu" width="20px"></button>
                </div>
                <div class="col-8 px-0">
                    <h1 class="brand py-2"><a href="/" class="text-decoration-none text-dark">My news website</a></h1> 
                </div>
                <div class="col-2 px-0">
                    <button class="btn"><img src="/ico/user.svg" alt="account" width="20px"></button>
                </div>
            </div> 
            <h1 class="brand d-none d-md-block my-0"><a href="/" class="text-decoration-none text-dark">My news website</a></h1>         
        </div>
        <div class="col-md-4 md-text-right today">
            <p class="mr-auto d-md-none">Date</p> 
            <p>today's paper</p> 
        </div>
    </div>
</div>
<!-- end second navbar -->

<!-- third navbar -->
<div class="container third-navbar">
    <nav class="navbar navbar-expand-lg py-1 mt-1">
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav m-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">World<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Art</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Business</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Opinion</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Sport</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Health</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Food</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Travel</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Magazine</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Books</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Style</a>
            </li>
          </ul>
        </div>
      </nav>
</div>

<!-- end third navbar -->
