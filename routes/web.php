<?php


use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


//User Routes
Route::middleware(['auth','user-role:user'])->group(function()
{
    Route::get("/home",[App\Http\Controllers\HomeController::class, 'userHome'])->name("home");
});

Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

//Admin Routes
Route::middleware(['auth','user-role:admin'])->group(function()
{
    Route::get("/admin/home",[App\Http\Controllers\HomeController::class, 'adminHome'])->name("admin.home");
    Route::get("/admin/persona",[App\Http\Controllers\PersonaController::class, 'adminPersona'])->name("admin.persona");
    Route::get("/admin/proveedor",[App\Http\Controllers\ProveedorController::class, 'adminProveedor'])->name("admin.proveedor");
    Route::get("/admin/solicitante",[App\Http\Controllers\SolicitanteController::class, 'adminSolicitante'])->name("admin.solicitante");
    Route::get("/admin/despachador",[App\Http\Controllers\DespachadorController::class, 'adminDespachador'])->name("admin.despachador");
    Route::get("/admin/material",[App\Http\Controllers\MaterialController::class, 'adminMaterial'])->name("admin.material");
    Route::get("/admin/ingresomaterial",[App\Http\Controllers\IngresoMaterialController::class, 'adminIngresoMaterial'])->name("admin.ingresomaterial");
    Route::get("/admin/salidamaterial",[App\Http\Controllers\SalidaMaterialController::class, 'adminSalidaMaterial'])->name("admin.salidamaterial");
    Route::get("/admin/inventario",[App\Http\Controllers\InventarioController::class, 'adminInventario'])->name("admin.inventario");

    // Route::get('/admin/persona/create', [App\Http\Controllers\PersonaController::class, 'create'])->name('admin.persona.create');
    // Route::post('/admin/persona', [App\Http\Controllers\PersonaController::class, 'store'])->name('admin.persona.store');

    //Rutas de persona
    // Route::get('/admin/persona', [App\Http\Controllers\PersonaController::class, 'index'])->name('admin.persona.index');
    Route::get('/admin/persona/create', [App\Http\Controllers\PersonaController::class, 'create'])->name('admin.persona.create');
    Route::post('/admin/persona', [App\Http\Controllers\PersonaController::class, 'store'])->name('admin.persona.store');
    Route::get('/admin/persona/{id}', [App\Http\Controllers\PersonaController::class, 'show'])->name('admin.persona.show');
    Route::get('/admin/persona/{id}/edit', [App\Http\Controllers\PersonaController::class, 'edit'])->name('admin.persona.edit');
    Route::put('/admin/persona/{id}', [App\Http\Controllers\PersonaController::class, 'update'])->name('admin.persona.update');
    Route::delete('/admin/persona/{id}', [App\Http\Controllers\PersonaController::class, 'destroy'])->name('admin.persona.destroy');

    //Rutas de proveedor
    Route::get('/admin/proveedor/create', [App\Http\Controllers\ProveedorController::class, 'create'])->name('admin.proveedor.create');
    Route::post('/admin/proveedor', [App\Http\Controllers\ProveedorController::class, 'store'])->name('admin.proveedor.store');
    Route::get('/admin/proveedor/{id}', [App\Http\Controllers\ProveedorController::class, 'show'])->name('admin.proveedor.show');
    Route::get('/admin/proveedor/{id}/edit', [App\Http\Controllers\ProveedorController::class, 'edit'])->name('admin.proveedor.edit');
    Route::put('/admin/proveedor/{id}', [App\Http\Controllers\ProveedorController::class, 'update'])->name('admin.proveedor.update');
    Route::delete('/admin/proveedor/{id}', [App\Http\Controllers\ProveedorController::class, 'destroy'])->name('admin.proveedor.destroy');


    //rutas formulario
    Route::get('/admin/formulario/create', [App\Http\Controllers\FormularioController::class, 'create'])->name('admin.formulario.create');
    Route::post('/admin/formulario', [App\Http\Controllers\FormularioController::class, 'store'])->name('admin.formulario.store');


    //ruta de solicitante
    Route::get('/admin/solicitante/create', [App\Http\Controllers\SolicitanteController::class, 'create'])->name('admin.solicitante.create');
    Route::post('/admin/solicitante', [App\Http\Controllers\SolicitanteController::class, 'store'])->name('admin.solicitante.store');
    Route::get('/admin/solicitante/{id}', [App\Http\Controllers\SolicitanteController::class, 'show'])->name('admin.solicitante.show');
    Route::get('/admin/solicitante/{id}/edit', [App\Http\Controllers\SolicitanteController::class, 'edit'])->name('admin.solicitante.edit');
    Route::put('/admin/solicitante/{id}', [App\Http\Controllers\SolicitanteController::class, 'update'])->name('admin.solicitante.update');
    Route::delete('/admin/solicitante/{id}', [App\Http\Controllers\SolicitanteController::class, 'destroy'])->name('admin.solicitante.destroy');
    Route::patch('/admin/solicitante/{id}/estado', [App\Http\Controllers\SolicitanteController::class, 'toggleEstado'])->name('admin.solicitante.toggleEstado');
    // En routes/web.php
    // Route::post('/admin/solicitante/toggleEstado/{id}', [App\Http\Controllers\SolicitanteController::class, 'toggleEstado']);

    //// rutas para despachador
    Route::get('/admin/despachador/create', [App\Http\Controllers\DespachadorController::class, 'create'])->name('admin.despachador.create');
    Route::post('/admin/despachador', [App\Http\Controllers\DespachadorController::class, 'store'])->name('admin.despachador.store');
    Route::get('/admin/despachador/{id}', [App\Http\Controllers\DespachadorController::class, 'show'])->name('admin.despachador.show');
    Route::get('/admin/despachador/{id}/edit', [App\Http\Controllers\DespachadorController::class, 'edit'])->name('admin.despachador.edit');
    Route::put('/admin/despachador/{id}', [App\Http\Controllers\DespachadorController::class, 'update'])->name('admin.despachador.update');
    Route::delete('/admin/despachador/{id}', [App\Http\Controllers\DespachadorController::class, 'destroy'])->name('admin.despachador.destroy');
    Route::patch('/admin/despachador/{id}/estado', [App\Http\Controllers\DespachadorController::class, 'toggleEstado'])->name('admin.despachador.toggleEstado');

    // rutas material
    Route::get('material/create', [App\Http\Controllers\MaterialController::class, 'create'])->name('admin.material.create');
    Route::post('material/', [App\Http\Controllers\MaterialController::class, 'store'])->name('admin.material.store');
    Route::get('material/{id_material}/edit', [App\Http\Controllers\MaterialController::class, 'edit'])->name('admin.material.edit');
    Route::put('material/{id_material}', [App\Http\Controllers\MaterialController::class, 'update'])->name('admin.material.update');
    Route::delete('material/{id_material}', [App\Http\Controllers\MaterialController::class, 'destroy'])->name('admin.material.destroy');


    //rutas ingreso
    Route::get('ingreso/create', [App\Http\Controllers\IngresoMaterialController::class, 'create'])->name('admin.ingreso.create');
    Route::post('ingreso/', [App\Http\Controllers\IngresoMaterialController::class, 'store'])->name('admin.ingreso.store');
    Route::get('ingreso/{id_ingreso}/edit', [App\Http\Controllers\IngresoMaterialController::class, 'edit'])->name('admin.ingreso.edit');
    Route::put('ingreso/{id_ingreso}', [App\Http\Controllers\IngresoMaterialController::class, 'update'])->name('admin.ingreso.update');
    Route::delete('ingreso/{id_ingreso}', [App\Http\Controllers\IngresoMaterialController::class, 'destroy'])->name('admin.ingreso.destroy');
    Route::get('ingreso/factura/{id}', [App\Http\Controllers\IngresoMaterialController::class, 'mostrarFactura']);

    //ruta inventario
    // Route::get('/admin/inventario/{id_ingreso}/detalles', [App\Http\Controllers\InventarioController::class, 'detalles'])->name('admin.inventario');

    //ruta de salida
    Route::post('admin/salida', [App\Http\Controllers\SalidaMaterialController::class, 'store'])->name('admin.salida.store');
    Route::get('admin/verificar-material', [App\Http\Controllers\SalidaMaterialController::class, 'verificarExistencia'])->name('verificar.material');
    Route::get('admin/verificar-stock', [App\Http\Controllers\SalidaMaterialController::class, 'verificarStock']);

    //karde
    Route::get('admin/kardex', [App\Http\Controllers\KardexController::class, 'index'])->name('admin.kardex');
   
    Route::get('admin/inventarioprincipal', [App\Http\Controllers\InventarioPrincipalController::class, 'index'])->name('admin.inventarioprincipal');

    Route::post('/generate-pdf', [App\Http\Controllers\InventarioPrincipalController::class, 'generatePDF'])->name('generate.pdf');
    Route::post('/generate-inventarios-pdf', [App\Http\Controllers\InventarioPrincipalController::class, 'generateInventarioPDF'])->name('generate.inventario.pdf');
    Route::post('/generate-excel', [App\Http\Controllers\InventarioPrincipalController::class, 'generateExcel'])->name('generate.excel');

    Route::get('/exportar-material', [App\Http\Controllers\MaterialController::class, 'exportar'])->name('exportar.material');
    //Route::get('/reporte-material', [App\Http\Controllers\MaterialController::class, 'generateMaterialPDF'])->name('reporte.materiales');
    Route::get('/reporte-materiales-pdf', [App\Http\Controllers\MaterialController::class, 'generateMaterialPDF'])->name('reporte.materiales.pdf');
    // Route::post('/generate-kardex-pdf', [App\Http\Controllers\KardexController::class, 'generatekardexPDF'])->name('generate.kardex.pdf');
    Route::get('/generate-kardex-pdf', [App\Http\Controllers\KardexController::class, 'generateKardexPDF'])->name('generate.kardex.pdf');
    Route::get('/exportar-kardex', [App\Http\Controllers\KardexController::class, 'exportarKardex'])->name('exportar.kardex');
    // Route::get('/admin/persona/{id}/edit', [PersonaController::class, 'edit'])->name('admin.persona.edit');
    // Route::put('/admin/persona/{id}', [PersonaController::class, 'update'])->name('admin.persona.update');
    // Route::delete('/admin/persona/{id}', [PersonaController::class, 'destroy'])->name('admin.persona.destroy');
});

