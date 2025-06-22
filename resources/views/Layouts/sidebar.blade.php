<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        @foreach ($accessibleMenus as $menu)
            <li class="nav-item">
                {{-- Gunakan helper url() untuk keamanan dan fleksibilitas --}}
                <a class="nav-link" href="{{ url($menu->link_menu) }}">

                    {{--
                        Ambil kelas ikon dari database.
                        Jika kolom icon_class kosong, gunakan ikon default 'mdi mdi-circle-outline'.
                    --}}
                    <i class="menu-icon {{ $menu->icon_class ?? 'mdi mdi-circle-outline' }}"></i>

                    <span class="menu-title">{{ $menu->name }}</span>
                </a>
            </li>
        @endforeach
    </ul>
</nav>
