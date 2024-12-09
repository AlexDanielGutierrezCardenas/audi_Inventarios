
@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <!-- Sección Materiales -->
    <div class="row">
        <!-- Sección Ingreso de Material -->
        <div class="col-12">
            <!-- Tablas de Materiales y Cotizaciones -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="material-tab" data-bs-toggle="tab" href="#material" role="tab" aria-controls="material" aria-selected="true">Ingreso de Material</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="cotizaciones-tab" data-bs-toggle="tab" href="#cotizaciones" role="tab" aria-controls="cotizaciones" aria-selected="false">Cotizaciones</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <!-- Ingreso de Material -->
                <div class="tab-pane fade show active" id="material" role="tabpanel" aria-labelledby="material-tab">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4>Listado de Materiales</h4>
                        <button class="btn btn-success" onclick="openCreateIngresoMaterialModal()">Crear Ingreso</button>
                    </div>
                    <table class="table table-bordered text-nowrap">
                        <thead class="table-light">
                            <tr>
                                <th>Proveedor</th>
                                <th>Factura</th>
                                <th>Material</th>
                                <th>Cantidad</th>
                                <th>precio Unitario</th>
                                <th>precio Total</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ingresos as $ingreso)
                            <tr>
                                <td>{{ $ingreso->proveedor->nombre_proveedor }}</td>
                                <td>{{ $ingreso->factura->numero_factura }}</td>
                                <td>{{ $ingreso->material->nombre }}</td>
                                <td>{{ $ingreso->cantidad }}</td>
                                <td>{{ $ingreso->precio_unitario }}</td>
                                <td>{{ $ingreso->precio_total }}</td>
                                <td>
                                    <button onclick="openEditMaterialModal({{ json_encode($ingreso) }})" class="btn btn-warning btn-sm">Editar</button>
                                    <form action="{{ route('admin.ingreso.destroy', $ingreso->id_ingreso) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Cotizaciones -->
                <div class="tab-pane fade" id="cotizaciones" role="tabpanel" aria-labelledby="cotizaciones-tab">
                    <h4>Listado de Cotizaciones</h4>
                    <table class="table table-bordered text-nowrap">
                        <thead class="table-light">
                            <tr>
                                <th>ID Proveedor</th>
                                <th>ID Factura</th>
                                <th>N° Documento</th>
                                <th>Cantidad</th>
                                <th>Precio Unitario</th>
                                <th>Precio Total</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        {{-- <tbody>
                            @foreach ($cotizaciones as $cotizacion)
                            <tr>
                                <td>{{ $cotizacion->id_proveedor }}</td>
                                <td>{{ $cotizacion->id_factura }}</td>
                                <td>{{ $cotizacion->ndocumento }}</td>
                                <td>{{ $cotizacion->cantidad }}</td>
                                <td>{{ $cotizacion->precio_unitario }}</td>
                                <td>{{ $cotizacion->precio_total }}</td>
                                <td>
                                    <button onclick="openEditCotizacionModal({{ json_encode($cotizacion) }})" class="btn btn-warning btn-sm">Editar</button>
                                    <form action="{{ route('admin.cotizacion.destroy', $cotizacion->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody> --}}
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Crear Ingreso Material -->
    <div class="modal fade" id="createMaterialModal" tabindex="-1" aria-labelledby="createMaterialModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg"> <!-- modal-lg para hacerlo más grande -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createMaterialModalLabel">Crear Ingreso de Material</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.ingreso.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <!-- Row para Proveedor y Material -->
                        <div class="row">
                            <!-- Proveedor -->
                            <div class="col-md-6 mb-3">
                                <label for="id_proveedor" class="form-label">Proveedor</label>
                                <select name="id_proveedor" id="id_proveedor" class="form-control" required onchange="mostrarDetallesProveedor()">
                                    <option value="">Seleccionar Proveedor</option>
                                    @foreach ($proveedores as $proveedor)
                                        <option value="{{ $proveedor->id_proveedor }}" 
                                            data-nombre="{{ $proveedor->nombre_proveedor }}" 
                                            data-direccion="{{ $proveedor->direccion }}" 
                                            data-nit="{{ $proveedor->nit }}" 
                                            data-telefono="{{ $proveedor->telefono }}">
                                            {{ $proveedor->nombre_proveedor }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
    
                            <!-- Material -->
                            <div class="col-md-6 mb-3">
                                <label for="id_material" class="form-label">Material</label>
                                <select name="id_material" id="id_material" class="form-control" required onchange="mostrarDetallesMaterial()">
                                    <option value="">Seleccionar Material</option>
                                    @foreach ($materials as $material)
                                        <option value="{{ $material->id_material }}" 
                                            data-nombre="{{ $material->nombre }}" 
                                            data-unidad="{{ $material->unidad }}">
                                            {{ $material->codigo_material }} - {{ $material->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
    
                        <!-- División entre Proveedor y Material -->
                        <div class="row">
                            <!-- Detalles del Proveedor (Izquierda) -->
                            <div id="detallesProveedor" class="col-md-6" style="display:none;">
                                <h6>detalles de Proveedor</h6>
                                <div class="row">
                                    <div class="col-md-12">
                                        <strong>Dirección:</strong>
                                        <p id="proveedorDireccion"></p>
                                    </div>
                                    <div class="col-md-12">
                                        <strong>NIT:</strong>
                                        <p id="proveedorNit"></p>
                                    </div>
                                    <div class="col-md-12">
                                        <strong>Teléfono:</strong>
                                        <p id="proveedorTelefono"></p>
                                    </div>
                                </div>
                            </div>
    
                            <!-- Detalles del Material (Derecha) -->
                            <div id="detallesMaterial" class="col-md-6" style="display:none;">
                                <h6>detalles de Material</h6>
                                <div class="row">
                                    <div class="col-md-12">
                                        <strong>Nombre del Material:</strong>
                                        <p id="materialNombre"></p>
                                    </div>
                                    <div class="col-md-12">
                                        <strong>Unidad:</strong>
                                        <p id="materialUnidad"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Número de Factura y Fecha de Emisión -->
                        <div class="mb-3 d-flex justify-content-center">
                            <div class="text-center">
                                <strong>Número de Comprobante:</strong>
                                <p id="numero_documento" name="numero_documento">{{ $nuevoNumero }}</p>
                                <input type="hidden" name="numero_documento" value="{{ $nuevoNumero }}">
                            </div>
                        </div>
                        
                        <div class="mb-3 d-flex justify-content-center align-items-center">
                            <!-- Switch deslizante para seleccionar entre automático o manual -->
                            <div class="form-check form-switch me-3">
                                <input class="form-check-input" type="checkbox" id="switchFechaManual" checked>
                                <label class="form-check-label" for="switchFechaManual">
                                    <strong>Fecha Automática</strong>
                                </label>
                            </div>
                            
                            <!-- Campo para mostrar la fecha automática -->
                            <div id="fechaAuto" class="text-center">
                                <strong>Fecha de Emisión:</strong>
                                <p id="fecha_emision">{{ $fechaEmision }}</p>
                                <!-- Input oculto para la fecha automática -->
                                <input type="hidden" id="fechaEmision" name="fecha_emision" value="{{ $fechaEmision }}">
                            </div>
                            
                            <!-- Campo para ingresar la fecha manual -->
                            <div id="fechaManual" class="d-none">
                                <label for="inputFechaManual"><strong>Ingrese Fecha:</strong></label>
                                <input type="date" id="inputFechaManual" name="fecha_emision" class="form-control">
                            </div>
                        </div>

                        <div class="mb-3 d-flex justify-content-center align-items-center">
                            <!-- Switch para seleccionar entre Factura o Recibo -->
                            <div class="form-check form-switch me-3">
                                <input class="form-check-input" type="checkbox" id="switchFacturaRecibo" checked>
                                <label class="form-check-label" for="switchFacturaRecibo">
                                    <strong>Factura o Recibo?</strong>
                                </label>
                            </div>
                            
                            <!-- Campo para el número de factura -->
                            <div id="campoFactura">
                                <label for="numeroFactura"><strong>Número de Factura:</strong></label>
                                <input type="text" id="numeroFactura" name="numero_factura" class="form-control">
                            </div>
                            
                            <!-- Campo para el número de recibo (oculto inicialmente) -->
                            <div id="campoRecibo" class="d-none">
                                <label for="numeroRecibo"><strong>Número de Recibo:</strong></label>
                                <input type="text" id="numeroRecibo" name="numero_recibo" class="form-control">
                            </div>
                        </div>
                        
                        
                        <!-- Sección Cantidad -->
                        <div class="mb-3">
                            <label for="cantidad" class="form-label">Cantidad</label>
                            <div class="input-group">
                                <button type="button" class="btn btn-outline-secondary" id="menos" onclick="decrementarCantidad()">-</button>
                                <input type="number" id="cantidad" name="cantidad" class="form-control" value="1" min="1" required readonly>
                                <button type="button" class="btn btn-outline-secondary" id="mas" onclick="incrementarCantidad()">+</button>
                            </div>
                        </div>
    
                        <div class="mb-3">
                            <label for="precio_unitario" class="form-label">Precio Unitario</label>
                            <input type="number" id="precio_unitario" name="precio_unitario" class="form-control" required oninput="calcularTotal()">
                        </div>
    
                        <!-- Precio Total -->
                        <div class="mb-3">
                            <label for="precio_total" class="form-label">Precio Total</label>
                            <input type="number" id="precio_total" name="precio_total" class="form-control" required readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Crear Ingreso Material</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<!-- Modal para Editar Material -->
<div class="modal fade" id="editMaterialModal" tabindex="-1" aria-labelledby="editMaterialModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editMaterialModalLabel">Editar Material</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editMaterialForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <!-- Proveedor -->
                    <div class="mb-3">
                        <label for="edit_id_proveedor" class="form-label">Proveedor</label>
                        <select name="id_proveedor" id="edit_id_proveedor" class="form-control" required>
                            <option value="">Seleccionar Proveedor</option>
                            @foreach ($proveedores as $proveedor)
                                <option value="{{ $proveedor->id_proveedor }}">{{ $proveedor->nombre }}</option>
                            @endforeach
                        </select>
                    </div>


                    <!-- Cantidad -->
                    <div class="mb-3">
                        <label for="edit_cantidad" class="form-label">Cantidad</label>
                        <input type="number" name="cantidad" id="edit_cantidad" class="form-control" required>
                    </div>

                    <!-- Precio Unitario -->
                    <div class="mb-3">
                        <label for="edit_precio_unitario" class="form-label">Precio Unitario</label>
                        <input type="number" name="precio_unitario" id="edit_precio_unitario" class="form-control" required>
                    </div>

                    <!-- Precio Total -->
                    <div class="mb-3">
                        <label for="edit_precio_total" class="form-label">Precio Total</label>
                        <input type="number" name="precio_total" id="edit_precio_total" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- Scripts -->
<script>
function openCreateIngresoMaterialModal() {
    new bootstrap.Modal(document.getElementById('createMaterialModal')).show();
}

function openEditMaterialModal(material) {
    const form = document.getElementById('editMaterialForm');
    form.action = `/admin/material/${material.id}`;
    document.getElementById('edit_proveedor').value = material.id_proveedor;
    document.getElementById('edit_factura').value = material.id_factura;
    document.getElementById('edit_ndocumento').value = material.ndocumento;
    document.getElementById('edit_cantidad').value = material.cantidad;
    document.getElementById('edit_precio_unitario').value = material.precio_unitario;
    document.getElementById('edit_precio_total').value = material.precio_total;

    new bootstrap.Modal(document.getElementById('editMaterialModal')).show();
}
    function mostrarDetallesFactura() {
    var selectFactura = document.getElementById('id_factura');
    var selectedOption = selectFactura.options[selectFactura.selectedIndex];
    var facturaNumero = selectedOption.getAttribute('data-numero');
    var facturaFecha = selectedOption.getAttribute('data-fecha');

    document.getElementById('facturaFecha').innerText = facturaFecha;
    document.getElementById('detallesFactura').style.display = 'block';
}

function mostrarDetallesProveedor() {
    var proveedorSelect = document.getElementById("id_proveedor");
    var proveedorDetails = document.getElementById("detallesProveedor");

    if (proveedorSelect.value) {
        var selectedOption = proveedorSelect.options[proveedorSelect.selectedIndex];
        document.getElementById("proveedorDireccion").innerText = selectedOption.getAttribute("data-direccion");
        document.getElementById("proveedorNit").innerText = selectedOption.getAttribute("data-nit");
        document.getElementById("proveedorTelefono").innerText = selectedOption.getAttribute("data-telefono");

        proveedorDetails.style.display = "block"; // Mostrar detalles del proveedor
    } else {
        proveedorDetails.style.display = "none"; // Ocultar detalles del proveedor
    }
}

function mostrarDetallesMaterial() {
    var materialSelect = document.getElementById("id_material");
    var materialDetails = document.getElementById("detallesMaterial");

    if (materialSelect.value) {
        var selectedOption = materialSelect.options[materialSelect.selectedIndex];
        document.getElementById("materialNombre").innerText = selectedOption.getAttribute("data-nombre");
        document.getElementById("materialUnidad").innerText = selectedOption.getAttribute("data-unidad");

        materialDetails.style.display = "block"; // Mostrar detalles del material
    } else {
        materialDetails.style.display = "none"; // Ocultar detalles del material
    }
}

function buscarFactura() {
        const numeroFactura = document.getElementById('numero_documento').value.trim();
        const facturas = @json($facturas);

        // Busca la factura por número
        const factura = facturas.find(f => f.numero_factura === numeroFactura);

        if (factura) {
            // Mostrar los detalles en la pantalla
            document.getElementById('facturaDocumento').textContent = factura.numero_documento;
            document.getElementById('facturaNumero').textContent = factura.numero_factura;
            document.getElementById('facturaFecha').textContent = factura.fecha_emision;
            document.getElementById('detallesFactura').style.display = 'block';
        } else {
            // Ocultar los detalles si no se encuentra la factura
            document.getElementById('facturaNumero').textContent = '';
            document.getElementById('facturaFecha').textContent = '';
            document.getElementById('detallesFactura').style.display = 'none';
        }
    }


    // Función para incrementar la cantidad
    function incrementarCantidad() {
        let cantidad = document.getElementById('cantidad');
        cantidad.value = parseInt(cantidad.value) + 1;
        calcularTotal(); // Recalcular el total cuando se cambia la cantidad
    }

    // Función para decrementar la cantidad
    function decrementarCantidad() {
        let cantidad = document.getElementById('cantidad');
        if (cantidad.value > 1) {
            cantidad.value = parseInt(cantidad.value) - 1;
            calcularTotal(); // Recalcular el total cuando se cambia la cantidad
        }
    }

    // Función para calcular el precio total
    function calcularTotal() {
        let cantidad = document.getElementById('cantidad').value;
        let precioUnitario = document.getElementById('precio_unitario').value;
        let precioTotal = document.getElementById('precio_total');
        
        // Si ambos campos tienen valores, realizar el cálculo
        if (cantidad && precioUnitario) {
            precioTotal.value = (parseFloat(cantidad) * parseFloat(precioUnitario)).toFixed(2);
        } else {
            precioTotal.value = 0; // Si no hay valores, dejar el precio total en 0
        }
    }
    
</script>


<script>
    // Función para verificar el estado del switch y mostrar/ocultar campos
    document.getElementById('switchFacturaRecibo').addEventListener('change', function() {
        var isChecked = this.checked;
        
        // Si el switch está marcado como Factura
        if (isChecked) {
            document.getElementById('campoFactura').classList.remove('d-none');
            document.getElementById('campoRecibo').classList.add('d-none');
            // Vaciar el campo de recibo cuando está marcado como Factura
            document.getElementById('numeroRecibo').value = '';
        } else {
            // Si el switch está desmarcado como Recibo
            document.getElementById('campoFactura').classList.add('d-none');
            document.getElementById('campoRecibo').classList.remove('d-none');
            // Vaciar el campo de factura cuando está marcado como Recibo
            document.getElementById('numeroFactura').value = '';
        }
    });

    // Enviar solo los datos necesarios dependiendo del estado del switch
    function enviarDatos() {
        var isChecked = document.getElementById('switchFacturaRecibo').checked;
        var formData = new FormData();

        // Si está marcado como Factura, agregamos el número de factura y vaciamos el recibo
        if (isChecked) {
            var numeroFactura = document.getElementById('numeroFactura').value;
            formData.append('numero_factura', numeroFactura);
            formData.append('numero_recibo', null);  // Vaciar datos del recibo
        } else {
            // Si está marcado como Recibo, agregamos el número de recibo y vaciamos la factura
            var numeroRecibo = document.getElementById('numeroRecibo').value;
            formData.append('numero_recibo', numeroRecibo);
            formData.append('numero_factura', null);  // Vaciar datos de la factura
        }


        fetch('/ruta/a/tu/controlador', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => console.log(data))
        .catch(error => console.error('Error:', error));
    }
</script>



<script>
    document.addEventListener("DOMContentLoaded", () => {
        const switchFechaManual = document.getElementById("switchFechaManual");
        const fechaAuto = document.getElementById("fechaAuto");
        const fechaManual = document.getElementById("fechaManual");
        const inputFechaManual = document.getElementById("inputFechaManual");
        const hiddenFechaEmision = document.getElementById("fechaEmision");

        // Función para actualizar el valor del campo 'fecha_emision'
        function actualizarFechaEmision() {
            if (switchFechaManual.checked) {
                // Si está marcado el switch, se usa la fecha automática
                hiddenFechaEmision.value = "{{ $fechaEmision }}"; // Fecha automática
            } else {
                // Si no está marcado, se usa la fecha manual
                hiddenFechaEmision.value = inputFechaManual.value || ''; // Fecha manual
            }
        }

        // Al cambiar el switch, se actualiza la vista y el valor de fecha_emision
        switchFechaManual.addEventListener("change", () => {
            if (switchFechaManual.checked) {
                // Mostrar fecha automática
                fechaAuto.classList.remove("d-none");
                fechaManual.classList.add("d-none");

                // Actualizar el valor del campo oculto con la fecha automática
                hiddenFechaEmision.value = "{{ $fechaEmision }}";
            } else {
                // Mostrar entrada de fecha manual
                fechaAuto.classList.add("d-none");
                fechaManual.classList.remove("d-none");

                // Si hay una fecha manual ingresada, actualizar el valor
                hiddenFechaEmision.value = inputFechaManual.value || '';
            }
        });

        // Enviar la fecha correcta antes de enviar el formulario
        const form = document.querySelector('form');
        form.addEventListener('submit', (event) => {
            // Asegurarnos de que el valor correcto esté en fecha_emision antes de enviar el formulario
            actualizarFechaEmision();
        });
    });
</script>

@endsection