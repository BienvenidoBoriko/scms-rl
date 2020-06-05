<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item">
                    <a class="sidebar-link "
                        href="{{ config('settings.host-front').':'.config('settings.port-front') }}"
                        aria-expanded="false">
                        <i class="fas fa-blog"></i>
                        <span class="hide-menu">Visitar Sitio</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link " href="{{ url('/') }}" aria-expanded="false">
                        <i class="fa fa-th-large"></i>
                        <span class="hide-menu">Tablero</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link " href="{{ url('/posts') }}" aria-expanded="false">
                        <i class="far fa-file"></i>
                        <span class="hide-menu">Entradas</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link " href="{{ url('/authors') }}" aria-expanded="false">
                        <i class="fas fa-user-tie"></i>
                        <span class="hide-menu">Autores</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link" href="{{ url('/tags') }}"
                        aria-expanded="false">
                        <i class="fas fa-tags"></i>
                        <span class="hide-menu">Etiquetas</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link " href="{{ url('/categories') }}" aria-expanded="false">
                        <i class="fas fa-clone"></i>
                        <span class="hide-menu">Categorias</span>
                    </a>
                </li>
                @can('update', App\Setting::class)
                    <li class="sidebar-item">
                        <a class="sidebar-link " href="{{ url('/settings') }}"
                            aria-expanded="false">
                            <i class="fas fa-cog"></i>
                            <span class="hide-menu">Ajustes</span>
                        </a>
                    </li>
                @endcan
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
