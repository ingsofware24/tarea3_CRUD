<h1 class="text-center">Formulario de Aplicaciones</h1>
<div class="row justify-content-center mb-4">
    <form id="formAplicacion" class="border shadow p-4 col-lg-4">
        <input type="hidden" name="app_id" id="app_id">
        <div class="row mb-3">
            <div class="col">
                <label for="app_nombre">Nombre de la Aplicacion</label>
                <input type="text" name="app_nombre" id="app_nombre" class="form-control">
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
        <table class="table table-bordered table-hover" id="tablaAplicacion">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nombre</th>
                    <th colspan="2">Acciones</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>
<script src="<?= asset('./build/js/aplicacion/index.js') ?>"></script>