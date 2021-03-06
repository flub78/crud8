        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
            
                @auth
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" 
                 aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    
                    <ul class="navbar-nav mr-auto">
						
    					<li class="nav-item">
      						<a class="nav-link" href="{{ route('home') }}">Home</a>
    					</li>

@if (auth()->user()->isAdmin())    				
    					<li class="nav-item dropdown">
      						<a class="nav-link dropdown-toggle" href="#" id="navbardrop1" data-toggle="dropdown">Admin</a>
      						
      						<div class="dropdown-menu">
        						<a class="dropdown-item" href="{{ route('users.index') }}">Users</a>
        						<a class="dropdown-item" href="{{ route('backup.index') }}">Backup</a>
      						</div>
    					</li>
@endif    					
    					<li class="nav-item dropdown">
      						<a class="nav-link dropdown-toggle" href="#" id="navbardrop2" data-toggle="dropdown">Games</a>
      						
      						<div class="dropdown-menu">
        						<a class="dropdown-item" href="{{ route('games.index') }}">List</a>
        						<a class="dropdown-item" href="{{ route('games.create') }}">New Game</a>
      						</div>
    					</li>
                    </ul>
                    @endauth
                    
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
