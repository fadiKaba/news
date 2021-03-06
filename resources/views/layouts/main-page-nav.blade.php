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
              <a class="nav-link" href="/posts/2">World<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/posts/3">Art</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/posts/4">Sports</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/posts/5">Business</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/posts/6">Health</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/posts/7">Food</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/posts/8">Travel</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/posts/9">Magazine</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/posts/10">Books</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/posts/11">Style</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/posts/12">Opinions</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/posts/13">Science</a>
            </li>
          </ul>
        </div>
      </nav>
</div>

<!-- end third navbar -->