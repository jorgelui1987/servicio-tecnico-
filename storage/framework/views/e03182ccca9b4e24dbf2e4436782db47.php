
<?php $__env->startSection('title', $ordenCompra->numero_orden); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('compras.index')); ?>" style="color:#a855f7;">Órdenes de Compra</a></li>
    <li class="breadcrumb-item active"><?php echo e($ordenCompra->numero_orden); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="mb-1 fw-bold"><?php echo e($ordenCompra->numero_orden); ?></h4>
        <p class="text-muted mb-0" style="font-size:13px;">
            Proveedor: <a href="<?php echo e(route('proveedores.show', $ordenCompra->proveedor)); ?>" style="color:#7c3aed;"><?php echo e($ordenCompra->proveedor->nombre); ?></a>
            · Fecha: <?php echo e($ordenCompra->fecha_orden->format('d/m/Y')); ?>

            · Creado por: <?php echo e($ordenCompra->user->name ?? '—'); ?>

        </p>
    </div>
    <div class="d-flex gap-2">
        <?php if(in_array($ordenCompra->estado, ['pendiente','aprobada','enviada','recibida_parcial'])): ?>
        <div class="dropdown">
            <button class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown">
                <i class="fas fa-edit me-1"></i>Cambiar Estado
            </button>
            <ul class="dropdown-menu shadow-sm border-0" style="border-radius:12px;font-size:13px;">
                <?php if($ordenCompra->estado === 'pendiente'): ?>
                <li><form action="<?php echo e(route('compras.estado', $ordenCompra)); ?>" method="POST"><?php echo csrf_field(); ?><input type="hidden" name="estado" value="aprobada"><button class="dropdown-item" type="submit"><span style="display:inline-block;width:10px;height:10px;background:#06b6d4;border-radius:50%;margin-right:8px;"></span>Aprobar</button></form></li>
                <?php endif; ?>
                <?php if(in_array($ordenCompra->estado, ['pendiente','aprobada'])): ?>
                <li><form action="<?php echo e(route('compras.estado', $ordenCompra)); ?>" method="POST"><?php echo csrf_field(); ?><input type="hidden" name="estado" value="cancelada"><button class="dropdown-item text-danger" type="submit"><span style="display:inline-block;width:10px;height:10px;background:#dc2626;border-radius:50%;margin-right:8px;"></span>Cancelar</button></form></li>
                <?php endif; ?>
                <?php if(in_array($ordenCompra->estado, ['aprobada','enviada','recibida_parcial'])): ?>
                <li><form action="<?php echo e(route('compras.estado', $ordenCompra)); ?>" method="POST"><?php echo csrf_field(); ?><input type="hidden" name="estado" value="completada"><button class="dropdown-item" type="submit"><span style="display:inline-block;width:10px;height:10px;background:#10b981;border-radius:50%;margin-right:8px;"></span>Marcar como Completada (recibir todo)</button></form></li>
                <?php endif; ?>
            </ul>
        </div>
        <?php endif; ?>
        <a href="<?php echo e(route('compras.index')); ?>" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-1"></i>Volver</a>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-3">Detalle de la Orden</h6>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" style="font-size:13px;">
                        <thead><tr><th>Producto</th><th class="text-center">Cant.</th><th class="text-center">Recibido</th><th class="text-center">Pendiente</th><th class="text-end">P. Unitario</th><th class="text-end">Dto.</th><th class="text-end">Subtotal</th></tr></thead>
                        <tbody>
                            <?php $__currentLoopData = $ordenCompra->detalles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $det): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <div style="font-weight:500;"><?php echo e($det->producto->nombre ?? '—'); ?></div>
                                    <div style="font-size:11px;color:#9ca3af;"><?php echo e($det->producto->codigo ?? ''); ?></div>
                                </td>
                                <td class="text-center"><?php echo e($det->cantidad_ordenada); ?></td>
                                <td class="text-center"><?php echo e($det->cantidad_recibida); ?></td>
                                <td class="text-center"><?php echo e($det->pendiente_recibir); ?></td>
                                <td class="text-end">S/ <?php echo e(number_format($det->precio_unitario, 2)); ?></td>
                                <td class="text-end"><?php echo e($det->descuento > 0 ? 'S/ '.number_format($det->descuento, 2) : '—'); ?></td>
                                <td class="text-end" style="font-weight:600;">S/ <?php echo e(number_format($det->subtotal, 2)); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-3">Resumen</h6>
                <div style="font-size:13px;">
                    <div class="d-flex justify-content-between py-2" style="border-bottom:1px solid #f3f4f6;">
                        <span class="text-muted">Estado</span>
                        <span style="background:<?php echo e($ordenCompra->estado_bg); ?>;color:<?php echo e($ordenCompra->estado_color); ?>;border-radius:20px;padding:3px 10px;font-size:11px;"><?php echo e(ucfirst(str_replace('_',' ',$ordenCompra->estado))); ?></span>
                    </div>
                    <div class="d-flex justify-content-between py-2" style="border-bottom:1px solid #f3f4f6;">
                        <span class="text-muted">Subtotal</span>
                        <span>S/ <?php echo e(number_format($ordenCompra->subtotal, 2)); ?></span>
                    </div>
                    <div class="d-flex justify-content-between py-2" style="border-bottom:1px solid #f3f4f6;">
                        <span class="text-muted">Descuento</span>
                        <span style="color:#dc2626;">- S/ <?php echo e(number_format($ordenCompra->descuento, 2)); ?></span>
                    </div>
                    <div class="d-flex justify-content-between py-2" style="border-bottom:1px solid #f3f4f6;">
                        <span class="text-muted">Impuesto (18%)</span>
                        <span>S/ <?php echo e(number_format($ordenCompra->impuesto, 2)); ?></span>
                    </div>
                    <div class="d-flex justify-content-between py-2">
                        <span class="fw-bold">Total</span>
                        <span style="font-weight:700;font-size:18px;color:#7c3aed;">S/ <?php echo e(number_format($ordenCompra->total, 2)); ?></span>
                    </div>
                </div>
                <?php if($ordenCompra->fecha_estimada): ?>
                <hr>
                <div style="font-size:12px;color:#6b7280;">
                    <i class="fas fa-calendar me-1"></i>Fecha estimada: <?php echo e($ordenCompra->fecha_estimada->format('d/m/Y')); ?>

                </div>
                <?php endif; ?>
                <?php if($ordenCompra->fecha_recibida): ?>
                <div style="font-size:12px;color:#10b981;">
                    <i class="fas fa-check-circle me-1"></i>Recibida: <?php echo e($ordenCompra->fecha_recibida->format('d/m/Y')); ?>

                </div>
                <?php endif; ?>
                <?php if($ordenCompra->notas): ?>
                <hr>
                <div><strong style="font-size:12px;">Notas:</strong><p style="font-size:12px;color:#374151;margin-top:4px;"><?php echo e($ordenCompra->notas); ?></p></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\crm-gestion-tienda-celulares\resources\views/compras/show.blade.php ENDPATH**/ ?>