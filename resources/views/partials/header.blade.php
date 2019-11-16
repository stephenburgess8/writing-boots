<header id="wdi-header-primary">
    <nav class="wdi-nav" id="wdi-nav-primary">
        <div class="wdi-header-container">
            <div class="wdi-logo-container">
                <h3 class="wdi-header-logotype">
                    <a class="wdi-logo-link" href="{{ url('/') }}">
                    {{ config('app.name', 'Writing Boots') }}
                    </a>
                </h3>
            </div>
            <div class="wdi-menu-container"
                @guest
                  {{--   <li class="wdi-nav-list-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    <li class="wdi-nav-list-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li> --}}
                @else
                    <div class="wdi-menu">
                        <span class="wdi-menu-item">{{ Auth::user()->name }}</span>

                        <div class="wdi-menu-item">
                            <a class="" href="{{ route('logout') }}">{{ __('Logout') }}</a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                @endguest
            </div>
        </div>
    </nav>
</header>
