<nav class="navbar">
    <div class="container navbar-content">
        <a href="{{ route('home') }}" class="navbar-brand">
            <div class="logo-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="5"></circle>
                    <line x1="12" y1="1" x2="12" y2="3"></line>
                    <line x1="12" y1="21" x2="12" y2="23"></line>
                    <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                    <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                    <line x1="1" y1="12" x2="3" y2="12"></line>
                    <line x1="21" y1="12" x2="23" y2="12"></line>
                    <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                    <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                </svg>
            </div>
            <span>RK Trading</span>
        </a>
        <ul class="navbar-nav">
            <li class="nav-item"><a href="{{ route('home') }}" class="nav-link">Home</a></li>
            <li class="nav-item"><a href="#products" class="nav-link">Products</a></li>
            <li class="nav-item"><a href="#about" class="nav-link">About Us</a></li>
            @guest
                <li class="nav-item">
                    <a href="{{ route('auth.login') }}" class="btn-login">
                        Login
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                            <polyline points="10 17 15 12 10 7"></polyline>
                            <line x1="15" y1="12" x2="3" y2="12"></line>
                        </svg>
                    </a>
                </li>
            @else
                <li class="nav-item">
                    @if(auth()->user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}" class="btn-login">Dashboard</a>
                    @else
                        <a href="{{ route('customer.dashboard') }}" class="btn-login">Dashboard</a>
                    @endif
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('auth.logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn-login" style="background: none; border: none; color: inherit; cursor: pointer;">Logout</button>
                    </form>
                </li>
            @endguest
        </ul>
    </div>
</nav>
