<h1 class="text-center">Formulario de productos</h1>
<div class="row justify-content-center mb-4">
    <form id="formProducto" class="border shadow p-4 col-lg-4">
        <input type="hidden" name="pro_id" id="pro_id">
        <div class="row mb-3">
            <div class="col">
                <label for="nombre">Nombre del producto</label>
                <input type="text" name="nombre" id="nombre" class="form-control">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="precio">Precio del producto</label>
                <input type="number" name="precio" id="precio" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col">
                <button type="submit" id="btnGuardar" class="btn btn-primary w-100">Guardar</button>
            </div>
            <div class="col">
                <button type="button" id="btnModificar" class="btn btn-warning w-100">Modificar</button>
            </div>
            <div class="col">
                <button type="button" id="btnCancelar" class="btn btn-danger w-100">Cancelar</button>
            </div>
        </div>
    </form>
</div>
<div class="row">
    <div class="col table-responsive">
        <table class="table table-bordered table-hover" id="tablaProductos">
            <thead>
                <tr>
                    <th>NO.</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>
<script src="<?= asset('./build/js/producto/index.js') ?>"></script>