<?php $__env->startSection('title', 'Detalle Venta '.$venta->numero_venta); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('ventas.index')); ?>" style="color:#a855f7;">Ventas</a></li>
    <li class="breadcrumb-item active"><?php echo e($venta->numero_venta); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
@media print {
    .sidebar, .topbar, .breadcrumb, .btn-acciones, .page-content > .d-flex { display: none !important; }
    .main-wrapper { margin-left: 0 !important; }
    .page-content { padding: 0 !important; }
    .ticket { box-shadow: none !important; border: 1px solid #ddd; }
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex align-items-center justify-content-between mb-4 btn-acciones">
    <div>
        <h4 class="mb-1 fw-bold"><?php echo e($venta->numero_venta); ?></h4>
        <p class="text-muted mb-0" style="font-size:13px;">
            <?php echo e($venta->fecha_venta->format('d/m/Y H:i')); ?> ·
            Atendido por <strong><?php echo e($venta->vendedor->name ?? '—'); ?></strong>
        </p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?php echo e(route('ventas.ticket', $venta)); ?>" target="_blank" class="btn btn-outline-primary px-4">
            <i class="fas fa-receipt me-2"></i>Ticket 80mm
        </a>
        <button onclick="window.print()" class="btn btn-outline-primary px-4">
            <i class="fas fa-print me-2"></i>Imprimir
        </button>
        <?php if($venta->estado === 'completada'): ?>
        <form action="<?php echo e(route('ventas.cancelar', $venta)); ?>" method="POST"
              onsubmit="return confirm('¿Cancelar esta venta y restaurar el stock?')">
            <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
            <button type="submit" class="btn btn-outline-danger px-4">
                <i class="fas fa-ban me-2"></i>Cancelar Venta
            </button>
        </form>
        <?php endif; ?>
    </div>
</div>

<div class="row g-4">
    
    <div class="col-lg-8">
        <div class="card ticket">
            <div class="card-body p-4">
                
                <div class="d-flex align-items-start justify-content-between mb-4">
                    <div>
                <div class="d-flex align-items-center gap-3 mb-2">
                    <?php if(isset($empresa) && $empresa && $empresa->logo): ?>
                        <img src="<?php echo e(asset($empresa->logo)); ?>" alt="Logo" style="width:42px;height:42px;border-radius:10px;object-fit:contain;">
                    <?php else: ?>
                        <div style="width:42px; height:42px; background:linear-gradient(135deg,#a855f7,#ec4899);
                            border-radius:10px; display:flex; align-items:center; justify-content:center;">
                            <i class="fas fa-mobile-alt" style="color:#fff;"></i>
                        </div>
                    <?php endif; ?>
                    <div>
                        <div style="font-weight:700; font-size:16px;"><?php echo e($empresa->nombre_tienda ?? 'CRM Tienda Celulares'); ?></div>
                        <?php if($empresa->ruc): ?><div style="font-size:11px; color:#9ca3af;">RUC: <?php echo e($empresa->ruc); ?></div><?php endif; ?>
                        <div style="font-size:12px; color:#9ca3af;">Comprobante de Venta</div>
                    </div>
                </div>
                    </div>
                    <div class="text-end">
                        <div style="font-size:20px; font-weight:700; color:#a855f7;"><?php echo e($venta->numero_venta); ?></div>
                        <div style="font-size:12px; color:#9ca3af;"><?php echo e($venta->fecha_venta->format('d/m/Y H:i')); ?></div>
                        <?php $cfg=['completada'=>['#d1fae5','#065f46'],'cancelada'=>['#fee2e2','#991b1b'],'pendiente'=>['#fef3c7','#92400e'],'devuelta'=>['#f3f4f6','#374151']]; $c=$cfg[$venta->estado]??['#f3f4f6','#374151']; ?>
                        <span style="background:<?php echo e($c[0]); ?>; color:<?php echo e($c[1]); ?>; border-radius:20px; padding:4px 12px; font-size:12px; font-weight:600; display:inline-block; margin-top:4px;">
                            <?php echo e(ucfirst($venta->estado)); ?>

                        </span>
                    </div>
                </div>

                
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <div class="p-3 rounded-3" style="background:#f8f5ff;">
                            <div style="font-size:11px; color:#9ca3af; margin-bottom:4px;">CLIENTE</div>
                            <div style="font-weight:600;"><?php echo e($venta->cliente->nombre_completo ?? '—'); ?></div>
                            <div style="font-size:12px; color:#6b7280;"><?php echo e($venta->cliente->telefono ?? ''); ?></div>
                            <?php if($venta->cliente && $venta->cliente->email): ?>
                            <div style="font-size:12px; color:#6b7280;"><?php echo e($venta->cliente->email); ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 rounded-3" style="background:#f8f5ff;">
                            <div style="font-size:11px; color:#9ca3af; margin-bottom:4px;">PAGO</div>
                            <?php $iconos=['efectivo'=>'💵','tarjeta'=>'💳','transferencia'=>'🏦','cuotas'=>'📅','yape'=>'📱','plin'=>'📲']; ?>
                            <div style="font-weight:600;"><?php echo e($iconos[$venta->metodo_pago] ?? ''); ?> <?php echo e(ucfirst($venta->metodo_pago)); ?></div>
                            <div style="font-size:12px; color:#6b7280;">Vendedor: <?php echo e($venta->vendedor->name ?? '—'); ?></div>
                        </div>
                    </div>
                </div>

                
                <div class="table-responsive mb-4">
                    <table class="table mb-0" style="font-size:13.5px;">
                        <thead>
                            <tr style="border-bottom:2px solid #e9d5ff;">
                                <th style="padding:8px 0; color:#6b7280; font-size:12px; text-transform:uppercase;">Producto</th>
                                <th style="padding:8px 0; color:#6b7280; font-size:12px; text-transform:uppercase; text-align:center;">Cant.</th>
                                <th style="padding:8px 0; color:#6b7280; font-size:12px; text-transform:uppercase; text-align:right;">P. Unit.</th>
                                <th style="padding:8px 0; color:#6b7280; font-size:12px; text-transform:uppercase; text-align:right;">Descto.</th>
                                <th style="padding:8px 0; color:#6b7280; font-size:12px; text-transform:uppercase; text-align:right;">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $venta->detalles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $det): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr style="border-bottom:1px solid #f3f4f6;">
                                <td style="padding:10px 0;">
                                    <div style="font-weight:500;"><?php echo e($det->producto->nombre ?? '—'); ?></div>
                                    <?php if($det->producto && $det->producto->marca): ?>
                                        <div style="font-size:11px; color:#9ca3af;"><?php echo e($det->producto->marca->nombre); ?></div>
                                    <?php endif; ?>
                                    <?php if($det->imei_vendido): ?>
                                        <div style="font-size:11px; color:#9ca3af;">IMEI: <?php echo e($det->imei_vendido); ?></div>
                                    <?php endif; ?>
                                </td>
                                <td style="padding:10px 0; text-align:center;"><?php echo e($det->cantidad); ?></td>
                                <td style="padding:10px 0; text-align:right;">S/ <?php echo e(number_format($det->precio_unitario, 2)); ?></td>
                                <td style="padding:10px 0; text-align:right; color:#dc2626;">
                                    <?php echo e($det->descuento > 0 ? '— S/ '.number_format($det->descuento,2) : '—'); ?>

                                </td>
                                <td style="padding:10px 0; text-align:right; font-weight:600;">S/ <?php echo e(number_format($det->subtotal, 2)); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>

                
                <div class="row justify-content-end">
                    <div class="col-md-5">
                        <div class="d-flex justify-content-between mb-2" style="font-size:13.5px;">
                            <span class="text-muted">Subtotal</span>
                            <span>S/ <?php echo e(number_format($venta->subtotal, 2)); ?></span>
                        </div>
                        <?php if($venta->descuento > 0): ?>
                        <div class="d-flex justify-content-between mb-2" style="font-size:13.5px;">
                            <span class="text-muted">Descuento</span>
                            <span class="text-danger">— S/ <?php echo e(number_format($venta->descuento, 2)); ?></span>
                        </div>
                        <?php endif; ?>
                        <div class="d-flex justify-content-between mb-3" style="font-size:13.5px;">
                            <span class="text-muted">IGV (18%)</span>
                            <span>S/ <?php echo e(number_format($venta->impuesto, 2)); ?></span>
                        </div>
                        <div class="d-flex justify-content-between p-3 rounded-3"
                             style="background:linear-gradient(135deg,#a855f7,#ec4899);">
                            <span style="color:#fff; font-weight:700; font-size:16px;">TOTAL</span>
                            <span style="color:#fff; font-weight:700; font-size:20px;">S/ <?php echo e(number_format($venta->total, 2)); ?></span>
                        </div>
                    </div>
                </div>

                <?php if($venta->notas): ?>
                <div class="mt-3 p-3 rounded-3" style="background:#f9fafb; font-size:13px; color:#6b7280;">
                    <i class="fas fa-sticky-note me-1"></i><strong>Notas:</strong> <?php echo e($venta->notas); ?>

                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    
    <div class="col-lg-4">
        <div class="card mb-3">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-3">Acciones Rápidas</h6>
                <div class="d-grid gap-2">
                    <a href="<?php echo e(route('ventas.ticket', $venta)); ?>" target="_blank" class="btn btn-primary">
                        <i class="fas fa-receipt me-2"></i>Ticket 80mm
                    </a>
                    <button onclick="window.print()" class="btn btn-outline-primary">
                        <i class="fas fa-print me-2"></i>Imprimir A4
                    </button>
                    <?php if($venta->cliente_id): ?>
                    <a href="<?php echo e(route('clientes.show', $venta->cliente_id)); ?>" class="btn btn-outline-primary">
                        <i class="fas fa-user me-2"></i>Ver Perfil del Cliente
                    </a>
                    <?php endif; ?>
                    <a href="<?php echo e(route('ventas.create')); ?>" class="btn btn-outline-secondary">
                        <i class="fas fa-plus me-2"></i>Nueva Venta
                    </a>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-3">Resumen</h6>
                <div class="d-flex justify-content-between mb-2" style="font-size:13px;">
                    <span class="text-muted">Productos</span>
                    <span class="fw-500"><?php echo e($venta->detalles->count()); ?></span>
                </div>
                <div class="d-flex justify-content-between mb-2" style="font-size:13px;">
                    <span class="text-muted">Unidades</span>
                    <span class="fw-500"><?php echo e($venta->detalles->sum('cantidad')); ?></span>
                </div>
                <div class="d-flex justify-content-between mb-2" style="font-size:13px;">
                    <span class="text-muted">Método de Pago</span>
                    <span class="fw-500"><?php echo e(ucfirst($venta->metodo_pago)); ?></span>
                </div>
                <div class="d-flex justify-content-between mb-2" style="font-size:13px;">
                    <span class="text-muted">Fecha</span>
                    <span class="fw-500"><?php echo e($venta->fecha_venta->format('d/m/Y')); ?></span>
                </div>
                <div class="d-flex justify-content-between" style="font-size:13px;">
                    <span class="text-muted">Hora</span>
                    <span class="fw-500"><?php echo e($venta->fecha_venta->format('H:i')); ?></span>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\crm-gestion-tienda-celulares\resources\views/ventas/show.blade.php ENDPATH**/ ?>