<!-- Sidebar -->
<nav class="navbar-vertical navbar navbar-dark bg-dark">
    <div class="nav-scroller">
        <!-- Brand logo -->
        <div class="d-flex flex-column justify-content-center align-items-center py-4">
            <!-- Texto SoftAudi en mayúsculas -->
            <a class="text-white h1 text-uppercase mb-2">SoftAudi</a>
            <!-- Logo centrado debajo del texto -->
            <a href="#">
                <img src="{{ asset('admin_assets/images/logo/images.jpeg') }}" alt="Logo" class="img-fluid rounded-circle" width="100" />
            </a>
        </div>
        

        <!-- Navbar nav -->
        <ul class="navbar-nav flex-column" id="sideNavbar">
            <!-- Dashboard Section -->
            <li class="nav-item">
                <a class="nav-link text-white py-3" href="{{route('admin.home')}}">
                    <i data-feather="home" class="nav-icon icon-xs me-2"></i>Admin Dashboard
                </a>
            </li>

            <!-- Divider -->
            <li class="nav-item">
                <div class="navbar-heading text-muted">Seccion</div>
            </li>

<!-- Admin Personal Section -->
<li class="nav-item">
    <a class="nav-link has-arrow text-white py-3" href="#" onclick="toggleCollapse('navPersonal')">
        <i data-feather="layers" class="nav-icon icon-xs me-2"></i> Administrador Personal
    </a>
    <div id="navPersonal" class="collapse">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link text-white" href="{{route('admin.persona')}}">
                    Personas
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{route('admin.proveedor')}}">
                    Proveedores
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{route('admin.solicitante')}}">
                    Solicitantes
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{route('admin.despachador')}}">
                    Despachador
                </a>
            </li>
        </ul>
    </div>
</li>

<!-- Admin Products Section -->
<li class="nav-item">
    <a class="nav-link has-arrow text-white py-3" href="#" onclick="toggleCollapse('navAuthentication')">
        <i data-feather="lock" class="nav-icon icon-xs me-2"></i> Administrador Productos
    </a>
    <div id="navAuthentication" class="collapse">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link text-white" href="{{route('admin.material')}}">
                    Material
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{route('admin.ingresomaterial')}}">
                    Ingreso Material
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{route('admin.salidamaterial')}}">
                    Salida Material
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{route('admin.inventario')}}"> Inventario de Materiales</a>
            </li>
        </ul>
    </div>
</li>




            <!-- UI Componentes Section -->
            <li class="nav-item">
                <div class="navbar-heading text-muted">Inventarios</div>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white" href="{{route('admin.inventarioprincipal')}}"> 
                    <i data-feather="package" class="nav-icon icon-xs me-2"></i>Inventarios de Materiales
                </a>
            </li>


            <!-- Documentation Section -->
            <li class="nav-item">
                <div class="navbar-heading text-muted">Kardex</div>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white" href="{{route('admin.kardex')}}"> 
                    <i data-feather="clipboard" class="nav-icon icon-xs me-2"></i>Kardex de Materiales
                </a>
            </li>
        </ul>
    </div>
</nav>


<script>
    function toggleCollapse(targetId) {
    var collapseElement = document.getElementById(targetId);

    // Si el div tiene la clase 'show', la eliminamos para colapsar
    if (collapseElement.classList.contains('show')) {
        collapseElement.classList.remove('show');
    } else {
        // Si no tiene la clase 'show', la agregamos para expandir
        collapseElement.classList.add('show');
    }
}

</script>