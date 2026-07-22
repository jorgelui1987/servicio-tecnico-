
<?php $__env->startSection('title', 'Proveedores'); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item active">Proveedores</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="d-flex align-items-center justify-content-between mb-4">
    <div><h4 class="mb-1 fw-bold">Proveedores</h4><p class="text-muted mb-0" style="font-size:13px;"><?php echo e($proveedores->total()); ?> proveedores registrados</p></div>
    <a href="<?php echo e(route('proveedores.create')); ?>" class="btn btn-primary px-4"><i class="fas fa-plus me-2"></i>Nuevo Proveedor</a>
</div>
<div class="card"><div class="card-body p-0"><div class="table-responsive">
<table class="table table-hover align-middle mb-0"><thead><tr>
    <th class="ps-4">Nombre</th><th>Contacto</th><th>Teléfono</th><th>Email</th><th>RUC</th><th>Órdenes</th><th>Estado</th><th class="text-end pe-4">Acciones</th>
</tr></thead><tbody>
<?php $__empty_1 = true; $__currentLoopData = $proveedores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
<tr>
    <td class="ps-4"><div style="font-weight:500; font-size:13.5px;"><?php echo e($p->nombre); ?></div></td>
    <td style="font-size:13px;"><?php echo e($p->contacto ?: '—'); ?></td>
    <td style="font-size:13px;"><?php echo e($p->telefono ?: '—'); ?></td>
    <td style="font-size:13px;"><?php echo e($p->email ?: '—'); ?></td>
    <td style="font-size:13px;"><?php echo e($p->ruc ?: '—'); ?></td>
    <td><span style="background:#ede9fe;color:#7c3aed;border-radius:20px;padding:3px 10px;font-size:12px;"><?php echo e($p->ordenesCompra->count()); ?></span></td>
    <td><?php if($p->activo): ?><span style="background:#d1fae5;color:#065f46;border-radius:20px;padding:3px 10px;font-size:11px;">Activo</span><?php else: ?><span style="background:#fee2e2;color:#dc2626;border-radius:20px;padding:3px 10px;font-size:11px;">Inactivo</span><?php endif; ?></td>
    <td class="text-end pe-4"><div class="d-flex gap-1 justify-content-end">
        <a href="<?php echo e(route('proveedores.show', $p)); ?>" class="btn btn-sm" style="background:#f3f4f6;color:#374151;border-radius:8px;padding:5px 10px;" title="Ver"><i class="fas fa-eye fa-sm"></i></a>
        <a href="<?php echo e(route('proveedores.edit', $p)); ?>" class="btn btn-sm" style="background:#ede9fe;color:#7c3aed;border-radius:8px;padding:5px 10px;" title="Editar"><i class="fas fa-edit fa-sm"></i></a>
        <form action="<?php echo e(route('proveedores.toggle', $p)); ?>" method="POST" style="display:inline;"><?php echo csrf_field(); ?> <button type="submit" class="btn btn-sm" style="background:#fef3c7;color:#92400e;border-radius:8px;padding:5px 10px;" title="<?php echo e($p->activo ? 'Desactivar' : 'Activar'); ?>"><i class="fas fa-<?php echo e($p->activo ? 'ban' : 'check'); ?> fa-sm"></i></button></form>
        <?php if($p->ordenesCompra->count() == 0): ?>
        <form action="<?php echo e(route('proveedores.destroy', $p)); ?>" method="POST" onsubmit="return confirm('¿Eliminar <?php echo e(addslashes($p->nombre)); ?>?')" style="display:inline;"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button type="submit" class="btn btn-sm" style="background:#fee2e2;color:#dc2626;border-radius:8px;padding:5px 10px;" title="Eliminar"><i class="fas fa-trash fa-sm"></i></button></form>
        <?php endif; ?>
    </div></td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><tr><td colspan="8" class="text-center py-5"><i class="fas fa-truck fa-3x mb-3 d-block" style="color:#d1d5db;"></i><p class="text-muted mb-2">No hay proveedores registrados</p><a href="<?php echo e(route('proveedores.create')); ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus me-1"></i>Agregar proveedor</a></td></tr>
<?php endif; ?>
</tbody></table></div>
<?php if($proveedores->hasPages()): ?><div class="p-3 border-top"><?php echo e($proveedores->links()); ?></div><?php endif; ?>
</div></div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\crm-gestion-tienda-celulares\resources\views/proveedores/index.blade.php ENDPATH**/ ?>