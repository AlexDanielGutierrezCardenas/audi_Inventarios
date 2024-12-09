@extends('layouts.admin')

@section('content')

<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="material-tab" data-bs-toggle="tab" href="#material" role="tab" aria-controls="material" aria-selected="true">salida de Material</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="material" role="tabpanel" aria-labelledby="material-tab">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4>Listado de Materiales de Salida</h4>
                        <button type="button" class="btn btn-primary" onclick="openCreateIngresoMaterialModal()">
            Crear Salida de Material
        </button>
                    </div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Área</th>
                                <th>Proveedor</th>
                                <th>Solicitante</th>
                                <th>Despachador</th>
                                <th>Material</th>
                                <th>Cantidad</th>
                                <th>Precio Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($salidas as $salida)
                                <tr>
                                    <td>{{ $salida->area->nombre }}</td>
                                    <td>{{ $salida->proveedor->nombre_proveedor }}</td>
                                    <td>{{ $salida->solicitante->persona->nombre }}</td> <!-- Nombre del solicitante -->
                                    <td>{{ $salida->despachador->persona->nombre }}</td> <!-- Nombre del despachador -->
                                    <td>{{ $salida->material->nombre }}</td> <!-- Asegúrate de tener la relación con 'material' en el modelo -->
                                    <td>{{ $salida->cantidad }}</td>
                                    <td>{{ $salida->cantidad * $salida->precio_unitario }}</td> <!-- Precio total calculado -->
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>

                
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
                    </table>
                </div>
            </div>
        </div>
    </div>

   <div class="modal fade" id="createMaterialModal" tabindex="-1" aria-labelledby="createMaterialModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createMaterialModalLabel">Crear Salida de Material</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.salida.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    
                    <div class="mb-3">
                        <label for="id_area" class="form-label">Area</label>
                        <select name="id_area" id="id_area" class="form-control" required>
                            <option value="">Seleccionar Area</option>
                            @foreach ($areas as $area)
                                <option value="{{ $area->id_area }}">{{ $area->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="id_proveedor" class="form-label">Material</label>
                        <select name="id_material" id="id_material" class="form-control" required>
                            <option value="">Seleccionar Material</option>
                            @foreach ($materials as $material)
                                <option value="{{ $material->id_material }}">{{ $material->nombre }}</option>
                            @endforeach
                        </select>
                        
                        <div id="material-status"></div> <!-- Aquí se mostrarán los mensajes -->
                    </div>

    
                    <div class="mb-3">
                        <label for="id_proveedor" class="form-label">Proveedor</label>
                        <select name="id_proveedor" id="id_proveedor" class="form-control" required>
                            <option value="">Seleccionar Proveedor</option>
                            @foreach ($proveedores as $proveedor)
                                <option value="{{ $proveedor->id_proveedor }}">{{ $proveedor->nombre_proveedor }}</option>
                            @endforeach
                        </select>
                    </div>
                    
    
<div class="mb-3">
    <label for="id_solicitante" class="form-label">Solicitante</label>
    <select name="id_solicitante" id="id_solicitante" class="form-control" required>
        <option value="">Seleccionar Solicitante</option>
        @foreach ($solicitantes as $solicitante)
            <option value="{{ $solicitante->id_solicitante }}">
                {{ $solicitante->persona->nombre }} <!-- Mostrar el nombre de la persona -->
            </option>
        @endforeach
    </select>
</div>

<!-- Despachador -->
<div class="mb-3">
    <label for="id_despachador" class="form-label">Despachador</label>
    <select name="id_despachador" id="id_despachador" class="form-control" required>
        <option value="">Seleccionar Despachador</option>
        @foreach ($despachadores as $despachador)
            <option value="{{ $despachador->id_despachador }}">
                {{ $despachador->persona->nombre }} <!-- Mostrar el nombre de la persona -->
            </option>
        @endforeach
    </select>
</div>
                    <div class="mb-3">
                        <label for="cantidad" class="form-label">Cantidad</label>
                        <div class="input-group">
                            <button type="button" class="btn btn-outline-secondary" id="menos" onclick="decrementarCantidad()" aria-label="Disminuir cantidad">-</button>
                            <input type="number" id="cantidad" name="cantidad" class="form-control" value="1" min="1" required readonly>
                            <button type="button" class="btn btn-outline-secondary" id="mas" onclick="incrementarCantidad()" aria-label="Aumentar cantidad">+</button>
                        </div>
                        <!-- Indicador de límite -->
                        <div id="limite-indicador" class="limite-indicador"></div>
                        <small id="mensaje-error" class="text-danger" style="display: none;"></small>
                    </div>
                    
                    <div class="mb-3">
                        <label for="cantidad_actual" class="form-label">Cantidad Actual</label>
                        <input type="text" id="cantidad_actual" name="cantidad_actual" class="form-control" readonly>
                        
                    </div>
         
                    <div class="mb-3">
                        <label for="precio_unitario" class="form-label">Precio Unitario</label>
                        <input type="number" id="precio_unitario"  name="precio_unitario" class="form-control" value="0" readonly>
                    </div>
                    
                    <div class="mb-3">
                        <label for="precio_total" class="form-label">Precio Total</label>
                        <input type="number" id="precio_total" name="precio_total" class="form-control" readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Registrar Salida</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
 <!-- Bootstrap JS -->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
 <script>
     function openCreateIngresoMaterialModal() {
         new bootstrap.Modal(document.getElementById('createMaterialModal')).show();
     }
 </script>
<script>

    let cantidadInput = document.getElementById('cantidad');
    let limiteMaximo = 100;  // Define el límite máximo de cantidad (puedes cambiar este valor)

    function incrementarCantidad() {
        let cantidad = parseInt(cantidadInput.value);
        if (cantidad < limiteMaximo) {
            cantidadInput.value = cantidad + 1;
            actualizarLimiteIndicador();
        } else {
            mostrarError('El límite máximo es ' + limiteMaximo);
        }
    }

    function decrementarCantidad() {
        let cantidad = parseInt(cantidadInput.value);
        if (cantidad > 1) {
            cantidadInput.value = cantidad - 1;
            ocultarError();
        }
    }

    function actualizarLimiteIndicador() {
        let cantidad = parseInt(cantidadInput.value);
        if (cantidad === limiteMaximo) {
            document.getElementById('limite-indicador').innerHTML = "¡Has alcanzado el límite máximo!";
        } else {
            document.getElementById('limite-indicador').innerHTML = "";
        }
    }

    function mostrarError(mensaje) {
        document.getElementById('mensaje-error').style.display = 'block';
        document.getElementById('mensaje-error').innerText = mensaje;
    }

    function ocultarError() {
        document.getElementById('mensaje-error').style.display = 'none';
    }


    function calcularTotal() {
        let cantidad = document.getElementById('cantidad').value;
        let precioUnitario = document.getElementById('precio_unitario').value;
        let precioTotal = document.getElementById('precio_total');
        
        // Si ambos campos tienen valores, realizar el cálculo
        if (cantidad && precioUnitario) {
            precioTotal.value = (parseInt(cantidad) * parseFloat(precioUnitario)).toFixed(2);
        } else {
            precioTotal.value = 0; // Si no hay valores, dejar el precio total en 0
        }
    }
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$('#id_material').on('change', function() {
    const idMaterial = $(this).val();

    if (idMaterial) {
        $.ajax({
            url: '{{ route("verificar.material") }}', // Ruta al controlador
            method: 'GET',
            data: { id_material: idMaterial },
            success: function(response) {
                console.log(response); // Verifica qué responde el servidor
                if (response.exists) {
                    $('#material-status').html(
                        `<div class="alert alert-success">El material existe en ingreso.</div>`
                    );
                } else {
                    $('#material-status').html(
                        `<div class="alert alert-danger">El material no existe en ingreso.</div>`
                    );
                }
            },
            error: function(xhr) {
                console.error(xhr.responseText); // Debug de errores
                $('#material-status').html(
                    `<div class="alert alert-danger">Hubo un error al verificar el material.</div>`
                );
            }
        });
    } else {
        $('#material-status').html('');
    }
});

</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('id_material').addEventListener('change', function () {
        let idMaterial = this.value;

        if (idMaterial) {
            fetch('/admin/verificar-material?id_material=' + idMaterial)
                .then(response => response.json())
                .then(data => {
                    if (data.exists) {
                        let precioInput = document.getElementById('precio_unitario');
                        if (precioInput) {
                            // Convertir a número antes de asignar
                            precioInput.value = parseFloat(data.precio_unitario).toFixed(2);
                        }
                    } else {
                        console.log('Material no encontrado');
                    }
                })
                .catch(error => {
                    console.error('Error al verificar el material:', error);
                });
        }
    });
});

setTimeout(function () {
    let precioInput = document.getElementById('precio_unitario');
    if (precioInput) {
        precioInput.value = data.precio_unitario;
    }
}, 100); // Retraso de 100 ms


</script>

<script>

document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('id_material').addEventListener('change', function () {
        let idMaterial = this.value;

        if (idMaterial) {
            fetch('/admin/verificar-stock?id_material=' + idMaterial)
                .then(response => response.json())
                .then(data => {
                    if (data.exists) {
                        // Actualizar el precio unitario
                        let precioInput = document.getElementById('cantidad_actual');
                        if (precioInput) {
                            precioInput.value = parseFloat(data.precio_unitario).toFixed(2);
                        }

                        // Actualizar la cantidad actual
                        let cantidadInput = document.getElementById('cantidad_actual');
                        if (cantidadInput) {
                            cantidadInput.value = parseInt(data.cantidad_actual, 10); // Convertir a número entero
                        }
                    } else {
                        console.log('Material no encontrado');
                    }
                })
                .catch(error => {
                    console.error('Error al verificar el material:', error);
                });
        }
    });
});


setTimeout(function () {
    let precioInput = document.getElementById('precio_unitario');
    if (precioInput) {
        precioInput.value = data.precio_unitario;
    }
}, 100); // Retraso de 100 ms



</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const cantidadInput = document.getElementById('cantidad');
    const cantidadActualInput = document.getElementById('cantidad_actual');
    const mensajeError = document.getElementById('mensaje-error');
    const btnMas = document.getElementById('mas'); // Botón de incremento (+)
    const btnMenos = document.getElementById('menos'); // Botón de decremento (-)
    const limiteIndicador = document.getElementById('limite-indicador');

    // Función para incrementar la cantidad
    function incrementarCantidad() {
        let cantidad = parseInt(cantidadInput.value) || 0; // Obtener la cantidad actual
        const cantidadActual = parseInt(cantidadActualInput.value) || 0; // Obtener el límite de cantidad_actual
        const limiteCantidad = cantidadActual - 1; // Límite máximo de cantidad (restamos 1)

        // Si la cantidad es menor que el límite, aumentar la cantidad
        if (cantidad < limiteCantidad) {
            cantidadInput.value = cantidad + 1;
            mensajeError.style.display = 'none'; // Ocultar mensaje de error
            btnMas.disabled = false; // Habilitar el botón de incrementar
            btnMenos.disabled = false; // Habilitar el botón de decrementar
            actualizarIndicador(); // Actualizar el indicador
            calcularTotal(); // Recalcular el total cuando se cambia la cantidad
        } else {
            mensajeError.textContent = 'No puedes exceder la cantidad disponible (menos 1).';
            mensajeError.style.display = 'block'; // Mostrar mensaje de error
            btnMas.disabled = true; // Deshabilitar el botón de incrementar
            actualizarIndicador(); // Actualizar el indicador a rojo
        }
    }

    // Función para decrementar la cantidad
    function decrementarCantidad() {
        let cantidad = parseInt(cantidadInput.value) || 0; // Obtener la cantidad actual

        if (cantidad > 1) {
            cantidadInput.value = cantidad - 1;
            mensajeError.style.display = 'none'; 
            btnMas.disabled = false; 
            btnMenos.disabled = false; 
            actualizarIndicador(); 
            calcularTotal(); 
        } else {
            mensajeError.textContent = 'La cantidad mínima es 1.';
            mensajeError.style.display = 'block';
            btnMenos.disabled = true;
            actualizarIndicador(); 
        }
    }


    function actualizarIndicador() {
        let cantidad = parseInt(cantidadInput.value) || 0;
        const cantidadActual = parseInt(cantidadActualInput.value) || 0;
        const limiteCantidad = cantidadActual - 1; 

    
        if (cantidad >= limiteCantidad) {
            limiteIndicador.classList.add('rojo');
            limiteIndicador.classList.remove('verde');
        } else {
            limiteIndicador.classList.add('verde');
            limiteIndicador.classList.remove('rojo');
        }
    }

    // Función para calcular el precio total
    function calcularTotal() {
        let cantidad = parseFloat(cantidadInput.value);
        let precioUnitario = parseFloat(document.getElementById('precio_unitario').value);
        let precioTotal = document.getElementById('precio_total');
        
        if (!isNaN(cantidad) && !isNaN(precioUnitario)) {
            let precioTotalCalculado = (cantidad * precioUnitario).toFixed(2);
            precioTotal.value = precioTotalCalculado; 
        } else {
            precioTotal.value = 0; 
        }
    }


    cantidadInput.addEventListener('input', function () {
        const cantidadActual = parseInt(cantidadActualInput.value) || 0; 
        const limiteCantidad = cantidadActual - 1; 
        let cantidad = parseInt(cantidadInput.value) || 0;

       
        if (cantidad > limiteCantidad) {
            cantidadInput.value = limiteCantidad;
            mensajeError.textContent = 'No puedes consumir más cantidad que la disponible (menos 1).';
            mensajeError.style.display = 'block'; 
            btnMas.disabled = true; 
            actualizarIndicador(); 
        } else {
            mensajeError.style.display = 'none'; 
            btnMas.disabled = false; 
            actualizarIndicador(); 
        }

        
        if (cantidad === 1) {
            calcularTotal();
        }
    });

    document.getElementById('mas').addEventListener('click', incrementarCantidad);
    document.getElementById('menos').addEventListener('click', decrementarCantidad);
});




</script>

<style>
    .limite-indicador {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    margin-top: 5px;
}

.limite-indicador.rojo {
    background-color: rgb(199, 143, 21);
}

.limite-indicador.verde {
    background-color: green;
}

</style>

@endsection