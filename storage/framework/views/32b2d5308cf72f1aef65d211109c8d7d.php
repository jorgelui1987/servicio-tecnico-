
<?php $__env->startSection('title', 'Alertas de Stock Bajo'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('productos.index')); ?>" style="color:#a855f7;">Inventario</a></li>
    <li class="breadcrumb-item active">Alertas de Stock</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="kpi-card bg-grad-purple">
            <div class="kpi-icon"><i class="fas fa-exclamation-triangle"></i></div>
            <div class="kpi-value"><?php echo e($totalStockBajo); ?></div>
            <div class="kpi-label">Productos con stock bajo</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="kpi-card bg-grad-pink">
            <div class="kpi-icon"><i class="fas fa-times-circle"></i></div>
            <div class="kpi-value"><?php echo e($totalSinStock); ?></div>
            <div class="kpi-label">Productos sin stock</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="kpi-card bg-grad-cyan">
            <div class="kpi-icon"><i class="fas fa-boxes"></i></div>
            <div class="kpi-value"><?php echo e($productosCriticos); ?></div>
            <div class="kpi-label">Críticos (bajo pero con stock)</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="kpi-card bg-grad-green">
            <div class="kpi-icon"><i class="fas fa-dollar-sign"></i></div>
            <div class="kpi-value">S/ <?php echo e(number_format($valorStockBajo, 0)); ?></div>
            <div class="kpi-label">Valor en compra del stock bajo</div>
        </div>
    </div>
</div>


<div class="card mb-4">
    <div class="card-body p-3">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-search fa-sm"></i></span>
                    <input type="text" class="form-control" name="buscar"
                           placeholder="Nombre o código..." value="<?php echo e(request('buscar')); ?>">
                </div>
            </div>
            <div class="col-md-2">
                <select class="form-select" name="categoria_id">
                    <option value="">Todas las categorías</option>
                    <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($cat->id); ?>" <?php echo e(request('categoria_id')==$cat->id?'selected':''); ?>>
                            <?php echo e($cat->nombre); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-md-2">
                <select class="form-select" name="marca_id">
                    <option value="">Todas las marcas</option>
                    <?php $__currentLoopData = $marcas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($m->id); ?>" <?php echo e(request('marca_id')==$m->id?'selected':''); ?>>
                            <?php echo e($m->nombre); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-primary flex-1">
                    <i class="fas fa-filter me-1"></i>Filtrar
                </button>
                <a href="<?php echo e(route('stock.bajo')); ?>" class="btn btn-outline-secondary">
                    <i class="fas fa-times"></i>
                </a>
            </div>
            <div class="col-md-2">
                <div class="form-check form-check-inline mt-2">
                    <input class="form-check-input" type="checkbox" name="sin_stock" id="sinStock"
                           value="1" <?php echo e(request('sin_stock')?'checked':''); ?>

                           onchange="this.form.submit()">
                    <label class="form-check-label" for="sinStock" style="font-size:13px;">
                        Solo sin stock
                    </label>
                </div>
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
                        <th class="ps-4">Producto</th>
                        <th>Categoría / Marca</th>
                        <th>Stock Actual</th>
                        <th>Stock Mínimo</th>
                        <th>Déficit</th>
                        <th>Precio Venta</th>
                        <th>Valor en Stock</th>
                        <th class="text-end pe-4">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php
                        $deficit = $producto->stock_minimo - $producto->stock;
                        $nivel = $producto->stock <= 0 ? 'critico' : ($producto->stock <= $producto->stock_minimo / 2 ? 'alerta' : 'bajo');
                    ?>
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex align-items-center gap-3">
                                <?php if($producto->imagen): ?>
                                    <img src="<?php echo e(asset('storage/'.$producto->imagen)); ?>"
                                         style="width:40px; height:40px; border-radius:8px; object-fit:cover;">
                                <?php else: ?>
                                    <div style="width:40px; height:40px; border-radius:8px;
                                        background:linear-gradient(135deg,#a855f7,#ec4899);
                                        display:flex; align-items:center; justify-content:center;">
                                        <i class="fas fa-mobile-alt" style="color:#fff; font-size:14px;"></i>
                                    </div>
                                <?php endif; ?>
                                <div>
                                    <div style="font-weight:500; font-size:13px;"><?php echo e($producto->nombre); ?></div>
                                    <div style="font-size:11px; color:#9ca3af;"><?php echo e($producto->codigo); ?></div>
                                </div>
                            </div>
                        </td>
                        <td style="font-size:12px;">
                            <div><?php echo e($producto->categoria->nombre ?? '—'); ?></div>
                            <div style="color:#9ca3af;"><?php echo e($producto->marca->nombre ?? '—'); ?></div>
                        </td>
                        <td>
                            <?php if($producto->stock <= 0): ?>
                                <span style="background:#fee2e2; color:#dc2626; border-radius:20px; padding:4px 12px; font-size:13px; font-weight:700;">
                                    <?php echo e($producto->stock); ?>

                                </span>
                            <?php elseif($nivel === 'alerta'): ?>
                                <span style="background:#fef3c7; color:#92400e; border-radius:20px; padding:4px 12px; font-size:13px; font-weight:700;">
                                    <?php echo e($producto->stock); ?>

                                </span>
                            <?php else: ?>
                                <span style="background:#fef9c3; color:#854d0e; border-radius:20px; padding:4px 12px; font-size:13px; font-weight:700;">
                                    <?php echo e($producto->stock); ?>

                                </span>
                            <?php endif; ?>
                        </td>
                        <td style="font-size:13px;"><?php echo e($producto->stock_minimo); ?></td>
                        <td>
                            <span style="font-weight:600; color:#dc2626; font-size:13px;">
                                -<?php echo e($deficit > 0 ? $deficit : 0); ?>

                            </span>
                        </td>
                        <td style="font-size:13px;">S/ <?php echo e(number_format($producto->precio_venta, 2)); ?></td>
                        <td style="font-size:13px; color:#6b7280;">
                            S/ <?php echo e(number_format($producto->stock * $producto->precio_venta, 2)); ?>

                        </td>
                        <td class="text-end pe-4">
                            <div class="d-flex gap-1 justify-content-end">
                                <a href="<?php echo e(route('productos.show', $producto)); ?>"
                                   class="btn btn-sm" style="background:#f3f4f6; color:#374151; border-radius:8px; padding:5px 10px;" title="Ver">
                                    <i class="fas fa-eye fa-sm"></i>
                                </a>
                                <a href="<?php echo e(route('productos.edit', $producto)); ?>"
                                   class="btn btn-sm" style="background:#ede9fe; color:#7c3aed; border-radius:8px; padding:5px 10px;" title="Editar">
                                    <i class="fas fa-edit fa-sm"></i>
                                </a>
                                <a href="<?php echo e(route('stock.bajo.whatsapp', $producto)); ?>"
                                   class="btn btn-sm" style="background:#e0f2fe; color:#0369a1; border-radius:8px; padding:5px 10px;"
                                   title="Notificar por WhatsApp" target="_blank">
                                    <i class="fab fa-whatsapp fa-sm"></i>
                                </a>
                                <a href="<?php echo e(route('stock.ajuste')); ?>?producto_id=<?php echo e($producto->id); ?>"
                                   class="btn btn-sm" style="background:#d1fae5; color:#065f46; border-radius:8px; padding:5px 10px;" title="Ajustar stock">
                                    <i class="fas fa-exchange-alt fa-sm"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="8" class="text-center py-5">
                            <i class="fas fa-check-circle fa-3x mb-3 d-block" style="color:#10b981;"></i>
                            <p class="text-muted mb-0" style="font-size:15px; font-weight:500;">¡Todo en orden!</p>
                            <p class="text-muted" style="font-size:13px;">No hay productos con stock bajo en este momento.</p>
                            <a href="<?php echo e(route('productos.index')); ?>" class="btn btn-primary btn-sm mt-2">
                                <i class="fas fa-box me-1"></i>Ver inventario completo
                            </a>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if($productos->hasPages()): ?>
        <div class="p-3 border-top d-flex justify-content-between align-items-center">
            <span class="text-muted" style="font-size:13px;">
                Mostrando <?php echo e($productos->firstItem()); ?>–<?php echo e($productos->lastItem()); ?> de <?php echo e($productos->total()); ?> productos
            </span>
            <?php echo e($productos->links()); ?>

        </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\crm-gestion-tienda-celulares\resources\views/stock/bajo.blade.php ENDPATH**/ ?>