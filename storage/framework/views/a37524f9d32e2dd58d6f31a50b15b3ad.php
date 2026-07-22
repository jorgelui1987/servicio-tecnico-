
<?php $__env->startSection('title', 'Ajuste de Inventario'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('productos.index')); ?>" style="color:#a855f7;">Inventario</a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('stock.movimientos')); ?>" style="color:#a855f7;">Movimientos</a></li>
    <li class="breadcrumb-item active">Nuevo Ajuste</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-1">Ajuste de Inventario</h5>
                <p class="text-muted mb-4" style="font-size:13px;">
                    Registra entradas, salidas o ajustes manuales de stock
                </p>

                <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0 ps-3">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li style="font-size:13px;"><?php echo e($e); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="<?php echo e(route('stock.ajuste.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>

                    <div class="row g-4">
                        <div class="col-12">
                            <label class="form-label">Producto <span class="text-danger">*</span></label>
                            <select name="producto_id" class="form-select <?php $__errorArgs = ['producto_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required
                                    onchange="actualizarStockActual(this)">
                                <option value="">— Seleccionar producto —</option>
                                <?php $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($p->id); ?>"
                                            data-stock="<?php echo e($p->stock); ?>"
                                            <?php echo e(old('producto_id')==$p->id?'selected':''); ?>>
                                        <?php echo e($p->nombre); ?> (<?php echo e($p->codigo); ?>) — Stock: <?php echo e($p->stock); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['producto_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Stock Actual</label>
                            <div class="form-control" id="stockActualDisplay" style="background:#f9fafb; font-weight:600; font-size:18px;">
                                —
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Stock Resultante</label>
                            <div class="form-control" id="stockResultanteDisplay" style="background:#f9fafb; font-weight:600; font-size:18px; color:#7c3aed;">
                                —
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Tipo de Movimiento <span class="text-danger">*</span></label>
                            <select name="tipo" class="form-select <?php $__errorArgs = ['tipo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required
                                    onchange="toggleMotivos()">
                                <option value="">— Seleccionar —</option>
                                <option value="entrada" <?php echo e(old('tipo')=='entrada'?'selected':''); ?>>📦 Entrada (agregar stock)</option>
                                <option value="salida" <?php echo e(old('tipo')=='salida'?'selected':''); ?>>📤 Salida (quitar stock)</option>
                                <option value="ajuste" <?php echo e(old('tipo')=='ajuste'?'selected':''); ?>>⚖️ Ajuste manual</option>
                            </select>
                            <?php $__errorArgs = ['tipo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Motivo <span class="text-danger">*</span></label>
                            <select name="motivo" class="form-select <?php $__errorArgs = ['motivo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required id="motivoSelect">
                                <option value="">— Seleccionar —</option>
                                <optgroup label="Entradas" id="motivosEntrada">
                                    <option value="compra" <?php echo e(old('motivo')=='compra'?'selected':''); ?>>Compra / Reposición</option>
                                    <option value="devolucion" <?php echo e(old('motivo')=='devolucion'?'selected':''); ?>>Devolución de cliente</option>
                                    <option value="sobrante" <?php echo e(old('motivo')=='sobrante'?'selected':''); ?>>Sobrante en inventario</option>
                                </optgroup>
                                <optgroup label="Salidas" id="motivosSalida">
                                    <option value="perdida" <?php echo e(old('motivo')=='perdida'?'selected':''); ?>>Pérdida</option>
                                    <option value="daño" <?php echo e(old('motivo')=='daño'?'selected':''); ?>>Dañado / Defectuoso</option>
                                </optgroup>
                                <optgroup label="Ajustes" id="motivosAjuste">
                                    <option value="ajuste" <?php echo e(old('motivo')=='ajuste'?'selected':''); ?>>Ajuste manual</option>
                                </optgroup>
                            </select>
                            <?php $__errorArgs = ['motivo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Cantidad <span class="text-danger">*</span></label>
                            <input type="number" class="form-control <?php $__errorArgs = ['cantidad'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   name="cantidad" value="<?php echo e(old('cantidad', 1)); ?>"
                                   min="1" step="1" id="cantidadInput"
                                   oninput="calcularStockResultante()">
                            <?php $__errorArgs = ['cantidad'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <div id="stockAdvertencia" class="text-danger mt-1" style="font-size:12px; display:none;">
                                ⚠️ La cantidad supera el stock actual
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Observación</label>
                            <textarea class="form-control" name="observacion" rows="2"
                                      placeholder="Detalla el motivo del ajuste..."><?php echo e(old('observacion')); ?></textarea>
                        </div>
                    </div>

                    <hr class="mt-4">
                    <div class="d-flex gap-2 justify-content-end">
                        <a href="<?php echo e(route('stock.movimientos')); ?>" class="btn btn-outline-secondary px-4">Cancelar</a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-save me-2"></i>Registrar Ajuste
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
let productosData = [];

document.addEventListener('DOMContentLoaded', function() {
    // Cargar datos de productos
    document.querySelectorAll('[name=producto_id] option').forEach(opt => {
        if (opt.value) {
            productosData[opt.value] = parseInt(opt.dataset.stock) || 0;
        }
    });
    toggleMotivos();
    calcularStockResultante();
});

function actualizarStockActual(select) {
    calcularStockResultante();
}

function toggleMotivos() {
    const tipo = document.querySelector('[name=tipo]').value;
    document.querySelectorAll('#motivosEntrada, #motivosSalida, #motivosAjuste').forEach(g => g.style.display = 'none');

    if (tipo === 'entrada') document.getElementById('motivosEntrada').style.display = '';
    else if (tipo === 'salida') document.getElementById('motivosSalida').style.display = '';
    else if (tipo === 'ajuste') document.getElementById('motivosAjuste').style.display = '';
}

function calcularStockResultante() {
    const select = document.querySelector('[name=producto_id]');
    const cantidad = parseInt(document.getElementById('cantidadInput').value) || 0;
    const tipo = document.querySelector('[name=tipo]').value;
    const stockActualEl = document.getElementById('stockActualDisplay');
    const stockResultanteEl = document.getElementById('stockResultanteDisplay');
    const advertencia = document.getElementById('stockAdvertencia');

    if (!select.value) {
        stockActualEl.textContent = '—';
        stockResultanteEl.textContent = '—';
        return;
    }

    const stockActual = productosData[select.value] || 0;
    stockActualEl.textContent = stockActual;

    let stockResultante = stockActual;
    if (tipo === 'entrada') stockResultante = stockActual + cantidad;
    else if (tipo === 'salida') stockResultante = stockActual - cantidad;
    else if (tipo === 'ajuste') stockResultante = stockActual + cantidad; // se maneja con signo

    stockResultanteEl.textContent = stockResultante;

    if (stockResultante < 0) {
        stockResultanteEl.style.color = '#dc2626';
        advertencia.style.display = 'block';
    } else {
        stockResultanteEl.style.color = '#7c3aed';
        advertencia.style.display = 'none';
    }
}
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\crm-gestion-tienda-celulares\resources\views/stock/ajuste.blade.php ENDPATH**/ ?>