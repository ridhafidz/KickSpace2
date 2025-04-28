<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        @foreach ($accessibleMenus as $menu)
            <li class="nav-item">
                <a class="nav-link" href="{{ $menu->link_menu }}">
                    <i class="menu-icon fa-solid fa-bars"></i>
                    <span class="menu-title">{{ $menu->name }}</span>
                </a>
            </li>
        @endforeach
    </ul>
</nav>
