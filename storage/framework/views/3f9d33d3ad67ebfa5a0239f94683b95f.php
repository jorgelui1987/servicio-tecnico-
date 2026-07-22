
<?php $__env->startSection('title', 'Movimientos de Stock'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('productos.index')); ?>" style="color:#a855f7;">Inventario</a></li>
    <li class="breadcrumb-item active">Movimientos de Stock</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="mb-1 fw-bold">Historial de Movimientos</h4>
        <p class="text-muted mb-0" style="font-size:13px;">
            <?php echo e($movimientos->total()); ?> movimientos registrados
        </p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?php echo e(route('stock.ajuste')); ?>" class="btn btn-primary px-4">
            <i class="fas fa-plus me-2"></i>Nuevo Ajuste
        </a>
    </div>
</div>


<div class="card mb-4">
    <div class="card-body p-3">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-md-3">
                <label class="form-label">Producto</label>
                <select class="form-select" name="producto_id">
                    <option value="">Todos los productos</option>
                    <?php $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($p->id); ?>" <?php echo e(request('producto_id')==$p->id?'selected':''); ?>>
                            <?php echo e($p->nombre); ?> (<?php echo e($p->codigo); ?>)
                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">Tipo</label>
                <select class="form-select" name="tipo">
                    <option value="">Todos</option>
                    <option value="entrada" <?php echo e(request('tipo')=='entrada'?'selected':''); ?>>Entrada</option>
                    <option value="salida" <?php echo e(request('tipo')=='salida'?'selected':''); ?>>Salida</option>
                    <option value="ajuste" <?php echo e(request('tipo')=='ajuste'?'selected':''); ?>>Ajuste</option>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">Motivo</label>
                <select class="form-select" name="motivo">
                    <option value="">Todos</option>
                    <option value="venta" <?php echo e(request('motivo')=='venta'?'selected':''); ?>>Venta</option>
                    <option value="compra" <?php echo e(request('motivo')=='compra'?'selected':''); ?>>Compra</option>
                    <option value="ajuste" <?php echo e(request('motivo')=='ajuste'?'selected':''); ?>>Ajuste manual</option>
                    <option value="devolucion" <?php echo e(request('motivo')=='devolucion'?'selected':''); ?>>Devolución</option>
                    <option value="perdida" <?php echo e(request('motivo')=='perdida'?'selected':''); ?>>Pérdida</option>
                    <option value="daño" <?php echo e(request('motivo')=='daño'?'selected':''); ?>>Dañado</option>
                    <option value="sobrante" <?php echo e(request('motivo')=='sobrante'?'selected':''); ?>>Sobrante</option>
                    <option value="cancelacion" <?php echo e(request('motivo')=='cancelacion'?'selected':''); ?>>Cancelación venta</option>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">Desde</label>
                <input type="date" class="form-control" name="fecha_desde" value="<?php echo e(request('fecha_desde')); ?>">
            </div>
            <div class="col-md-2">
                <label class="form-label">Hasta</label>
                <input type="date" class="form-control" name="fecha_hasta" value="<?php echo e(request('fecha_hasta')); ?>">
            </div>
            <div class="col-md-1 d-flex gap-1">
                <button type="submit" class="btn btn-primary flex-1" style="padding:6px 12px;">
                    <i class="fas fa-filter"></i>
                </button>
                <a href="<?php echo e(route('stock.movimientos')); ?>" class="btn btn-outline-secondary" style="padding:6px 12px;">
                    <i class="fas fa-times"></i>
                </a>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">Fecha / Hora</th>
                        <th>Producto</th>
                        <th>Tipo</th>
                        <th>Motivo</th>
                        <th class="text-center">Stock Anterior</th>
                        <th class="text-center">Cantidad</th>
                        <th class="text-center">Stock Nuevo</th>
                        <th>Usuario</th>
                        <th class="pe-4">Observación</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $movimientos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mov): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="ps-4" style="font-size:12px; color:#6b7280;">
                            <?php echo e($mov->created_at->format('d/m/Y H:i')); ?>

                        </td>
                        <td>
                            <a href="<?php echo e(route('productos.show', $mov->producto)); ?>"
                               style="color:#7c3aed; font-weight:500; font-size:13px;">
                                <?php echo e($mov->producto->nombre ?? '—'); ?>

                            </a>
                            <div style="font-size:11px; color:#9ca3af;"><?php echo e($mov->producto->codigo ?? ''); ?></div>
                        </td>
                        <td>
                            <?php if($mov->tipo === 'entrada'): ?>
                                <span style="background:#d1fae5; color:#065f46; border-radius:20px; padding:3px 10px; font-size:11px;">
                                    <i class="fas fa-arrow-down fa-xs me-1"></i>Entrada
                                </span>
                            <?php elseif($mov->tipo === 'salida'): ?>
                                <span style="background:#fee2e2; color:#dc2626; border-radius:20px; padding:3px 10px; font-size:11px;">
                                    <i class="fas fa-arrow-up fa-xs me-1"></i>Salida
                                </span>
                            <?php else: ?>
                                <span style="background:#fef3c7; color:#92400e; border-radius:20px; padding:3px 10px; font-size:11px;">
                                    <i class="fas fa-adjust fa-xs me-1"></i>Ajuste
                                </span>
                            <?php endif; ?>
                        </td>
                        <td style="font-size:13px;"><?php echo e($mov->motivo_label); ?></td>
                        <td class="text-center" style="font-size:13px;"><?php echo e($mov->stock_anterior); ?></td>
                        <td class="text-center">
                            <span style="font-weight:600; font-size:14px;
                                <?php echo e($mov->cantidad > 0 ? 'color:#059669;' : 'color:#dc2626;'); ?>">
                                <?php echo e($mov->cantidad > 0 ? '+'.$mov->cantidad : $mov->cantidad); ?>

                            </span>
                        </td>
                        <td class="text-center" style="font-size:13px; font-weight:600;"><?php echo e($mov->stock_nuevo); ?></td>
                        <td style="font-size:12px;"><?php echo e($mov->user->name ?? '—'); ?></td>
                        <td class="pe-4" style="font-size:12px; color:#6b7280; max-width:180px;">
                            <?php echo e($mov->observacion ? Str::limit($mov->observacion, 60) : '—'); ?>

                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="9" class="text-center py-5">
                            <i class="fas fa-exchange-alt fa-3x mb-3 d-block" style="color:#d1d5db;"></i>
                            <p class="text-muted mb-0">No hay movimientos registrados</p>
                            <p class="text-muted" style="font-size:12px;">Realiza una venta o un ajuste de inventario para ver movimientos aquí.</p>
                            <a href="<?php echo e(route('stock.ajuste')); ?>" class="btn btn-primary btn-sm mt-2">
                                <i class="fas fa-plus me-1"></i>Nuevo Ajuste
                            </a>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if($movimientos->hasPages()): ?>
        <div class="p-3 border-top d-flex justify-content-between align-items-center">
            <span class="text-muted" style="font-size:13px;">
                Mostrando <?php echo e($movimientos->firstItem()); ?>–<?php echo e($movimientos->lastItem()); ?> de <?php echo e($movimientos->total()); ?> movimientos
            </span>
            <?php echo e($movimientos->links()); ?>

        </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\crm-gestion-tienda-celulares\resources\views/stock/movimientos.blade.php ENDPATH**/ ?>