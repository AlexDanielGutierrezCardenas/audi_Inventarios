<div class="header @@classList">
    <!-- Navbar -->

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <a id="nav-toggle" href="#"><i data-feather="menu" class="nav-icon me-2 icon-xs"></i></a>
        <a class="navbar-brand" href="#">SOFTWARE AUDITORIA</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Barra de búsqueda -->
            <form class="d-flex ms-auto my-2 my-lg-0">
                <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Buscar">
                <button class="btn btn-outline-light" type="submit">
                    <i class="bi bi-search"></i> <!-- Icono de búsqueda con Bootstrap Icons -->
                </button>
            </form>

            <!-- Navbar items -->
            <ul class="navbar-nav ms-auto">
                <!-- Notifications Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-bell-fill"></i> <!-- Icono de campana -->
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <!-- Encabezado -->
                        <div class="border-bottom px-3 pt-2 pb-3 d-flex justify-content-between align-items-center">
                            <p class="mb-0 text-dark fw-medium fs-4">Notificaciones</p>
                            <a href="#" class="text-muted">
                                <span><i class="bi bi-gear"></i></span> <!-- Icono de configuración -->
                            </a>
                        </div>
                
                        <!-- Lista de notificaciones -->
                        <ul class="list-group list-group-flush notification-list-scroll">
                            <li class="list-group-item bg-light">
                                <a href="#" class="text-muted text-decoration-none">
                                    <h5 class="mb-1">Gerente</h5>
                                    <p class="mb-0">Ya no hay más ejemplares, por favor pedirle que lo mande a su email.</p>
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="#" class="text-muted text-decoration-none">
                                    <h5 class="mb-1">Despachador</h5>
                                    <p class="mb-0">Por favor pedir más, la gente está buscando.</p>
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="#" class="text-muted text-decoration-none">
                                    <h5 class="mb-1">Solicitante</h5>
                                    <p class="mb-0">Excelente tienda.</p>
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="#" class="text-muted text-decoration-none">
                                    <h5 class="mb-1">Proveedor</h5>
                                    <p class="mb-0">Quiere más de los equipos que me pidió anteriormente.</p>
                                </a>
                            </li>
                        </ul>
                
                        <!-- Pie -->
                        <div class="border-top px-3 py-2 text-center">
                            <a href="#" class="text-inherit fw-semi-bold text-decoration-none">Mirar todas las notificaciones</a>
                        </div>
                    </div>
                </li>
                

                <!-- User Profile Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdownUser" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ Avatar::create(Auth::user()->name)->toBase64() }}" alt="avatar" class="rounded-circle" width="35" height="35">
                        <span class="ms-2 text-light">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownUser">
                        <li><a class="dropdown-item" href="#"><i class="bi bi-person-circle me-2"></i>Editar perfil</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-clock-history me-2"></i>Historial de actividad</a></li>
                        <li><a class="dropdown-item text-success" href="#"><i class="bi bi-star me-2"></i>Mas Mejoras</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                <i class="bi bi-box-arrow-right me-2"></i>Cerrar sesión
                            </button>
                        </form>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</div>
