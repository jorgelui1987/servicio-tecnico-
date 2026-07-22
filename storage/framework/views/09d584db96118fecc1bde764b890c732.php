
<?php $__env->startSection('title', 'Órdenes de Compra'); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item active">Órdenes de Compra</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="d-flex align-items-center justify-content-between mb-4">
    <div><h4 class="mb-1 fw-bold">Órdenes de Compra</h4><p class="text-muted mb-0" style="font-size:13px;"><?php echo e($ordenes->total()); ?> órdenes registradas</p></div>
    <a href="<?php echo e(route('compras.create')); ?>" class="btn btn-primary px-4"><i class="fas fa-plus me-2"></i>Nueva Orden</a>
</div>
<div class="card mb-4"><div class="card-body p-3">
    <form method="GET" class="row g-2 align-items-end">
        <div class="col-md-3"><input type="text" class="form-control" name="buscar" placeholder="N° de orden..." value="<?php echo e(request('buscar')); ?>"></div>
        <div class="col-md-3"><select class="form-select" name="proveedor_id"><option value="">Todos los proveedores</option><?php $__currentLoopData = $proveedores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($p->id); ?>" <?php echo e(request('proveedor_id')==$p->id?'selected':''); ?>><?php echo e($p->nombre); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select></div>
        <div class="col-md-2"><select class="form-select" name="estado"><option value="">Todos los estados</option><option value="pendiente" <?php echo e(request('estado')=='pendiente'?'selected':''); ?>>Pendiente</option><option value="aprobada" <?php echo e(request('estado')=='aprobada'?'selected':''); ?>>Aprobada</option><option value="enviada" <?php echo e(request('estado')=='enviada'?'selected':''); ?>>Enviada</option><option value="recibida_parcial" <?php echo e(request('estado')=='recibida_parcial'?'selected':''); ?>>Recibida Parcial</option><option value="completada" <?php echo e(request('estado')=='completada'?'selected':''); ?>>Completada</option><option value="cancelada" <?php echo e(request('estado')=='cancelada'?'selected':''); ?>>Cancelada</option></select></div>
        <div class="col-md-2"><button type="submit" class="btn btn-primary w-100"><i class="fas fa-filter me-1"></i>Filtrar</button></div>
        <div class="col-md-2"><a href="<?php echo e(route('compras.index')); ?>" class="btn btn-outline-secondary w-100"><i class="fas fa-times"></i> Limpiar</a></div>
    </form>
</div></div>
<div class="card"><div class="card-body p-0"><div class="table-responsive">
<table class="table table-hover align-middle mb-0"><thead><tr>
    <th class="ps-4">N° Orden</th><th>Proveedor</th><th>Fecha</th><th>Total</th><th>Estado</th><th>Creado por</th><th class="text-end pe-4">Acciones</th>
</tr></thead><tbody>
<?php $__empty_1 = true; $__currentLoopData = $ordenes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $oc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
<tr>
    <td class="ps-4" style="font-weight:600;"><?php echo e($oc->numero_orden); ?></td>
    <td><a href="<?php echo e(route('proveedores.show', $oc->proveedor)); ?>" style="color:#7c3aed;font-weight:500;font-size:13px;"><?php echo e($oc->proveedor->nombre); ?></a></td>
    <td style="font-size:13px;color:#6b7280;"><?php echo e($oc->fecha_orden->format('d/m/Y')); ?></td>
    <td style="font-weight:600;">S/ <?php echo e(number_format($oc->total, 2)); ?></td>
    <td><span style="background:<?php echo e($oc->estado_bg); ?>;color:<?php echo e($oc->estado_color); ?>;border-radius:20px;padding:3px 10px;font-size:11px;"><?php echo e(ucfirst(str_replace('_',' ',$oc->estado))); ?></span></td>
    <td style="font-size:12px;color:#6b7280;"><?php echo e($oc->user->name ?? '—'); ?></td>
    <td class="text-end pe-4"><div class="d-flex gap-1 justify-content-end">
        <a href="<?php echo e(route('compras.show', $oc)); ?>" class="btn btn-sm" style="background:#f3f4f6;color:#374151;border-radius:8px;padding:5px 10px;" title="Ver"><i class="fas fa-eye fa-sm"></i></a>
        <?php if(in_array($oc->estado, ['pendiente','aprobada'])): ?>
        <a href="<?php echo e(route('compras.edit', $oc)); ?>" class="btn btn-sm" style="background:#ede9fe;color:#7c3aed;border-radius:8px;padding:5px 10px;" title="Editar"><i class="fas fa-edit fa-sm"></i></a>
        <form action="<?php echo e(route('compras.destroy', $oc)); ?>" method="POST" onsubmit="return confirm('¿Eliminar <?php echo e($oc->numero_orden); ?>?')" style="display:inline;"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button type="submit" class="btn btn-sm" style="background:#fee2e2;color:#dc2626;border-radius:8px;padding:5px 10px;" title="Eliminar"><i class="fas fa-trash fa-sm"></i></button></form>
        <?php endif; ?>
    </div></td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><tr><td colspan="7" class="text-center py-5"><i class="fas fa-clipboard-list fa-3x mb-3 d-block" style="color:#d1d5db;"></i><p class="text-muted mb-2">No hay órdenes de compra</p><a href="<?php echo e(route('compras.create')); ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus me-1"></i>Crear primera orden</a></td></tr>
<?php endif; ?>
</tbody></table></div>
<?php if($ordenes->hasPages()): ?><div class="p-3 border-top"><?php echo e($ordenes->links()); ?></div><?php endif; ?>
</div></div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\crm-gestion-tienda-celulares\resources\views/compras/index.blade.php ENDPATH**/ ?>