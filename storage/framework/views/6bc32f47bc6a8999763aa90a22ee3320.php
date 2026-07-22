<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SuperAdmin - Tenants</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="<?php echo e(route('superadmin.dashboard')); ?>">🔐 SuperAdmin CRM</a>
            <div class="ms-auto">
                <a href="<?php echo e(route('superadmin.tenants.create')); ?>" class="btn btn-success btn-sm me-2">+ Nuevo Tenant</a>
                <a href="<?php echo e(route('superadmin.logout')); ?>" class="btn btn-outline-light btn-sm"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar Sesión</a>
                <form id="logout-form" action="<?php echo e(route('superadmin.logout')); ?>" method="POST" class="d-none"><?php echo csrf_field(); ?></form>
            </div>
        </div>
    </nav>

    <div class="container py-4">
        <h2>Gestión de Tenants</h2>

        <?php if(session('success')): ?>
            <div class="alert alert-success mt-3"><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <?php if(session('error')): ?>
            <div class="alert alert-danger mt-3"><?php echo e(session('error')); ?></div>
        <?php endif; ?>

        <div class="card mt-3">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Empresa</th>
                            <th>Subdominio</th>
                            <th>Plan</th>
                            <th>Usuarios</th>
                            <th>Estado</th>
                            <th>Expira</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $tenants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tenant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($tenant->id); ?></td>
                            <td><?php echo e($tenant->empresa); ?></td>
                            <td><code><?php echo e($tenant->subdominio); ?></code></td>
                            <td><span class="badge bg-info"><?php echo e($tenant->plan); ?></span></td>
                            <td><?php echo e($tenant->usuarios_count ?? 'N/A'); ?></td>
                            <td>
                                <span class="badge bg-<?php echo e($tenant->estado === 'activo' ? 'success' : ($tenant->estado === 'suspendido' ? 'warning' : 'danger')); ?>">
                                    <?php echo e($tenant->estado); ?>

                                </span>
                            </td>
                            <td>
                                <?php if($tenant->fecha_expiracion): ?>
                                    <?php echo e($tenant->fecha_expiracion->format('d/m/Y')); ?>

                                    <?php if($tenant->fecha_expiracion->isPast()): ?>
                                        <span class="badge bg-danger">Vencido</span>
                                    <?php endif; ?>
                                <?php else: ?>
                                    Sin fecha
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?php echo e(route('superadmin.tenants.edit', $tenant)); ?>" class="btn btn-sm btn-primary">Editar</a>
                                <a href="<?php echo e(route('superadmin.tenants.users', $tenant)); ?>" class="btn btn-sm btn-secondary" title="Usuarios">👤</a>
                                <a href="<?php echo e(route('superadmin.tenants.login-as', $tenant)); ?>" class="btn btn-sm btn-info"
                                   onclick="return confirm('¿Iniciar sesión como admin de <?php echo e($tenant->empresa); ?>?')"
                                   title="Login como tenant">🔑</a>

                                <form action="<?php echo e(route('superadmin.tenants.toggle', $tenant)); ?>" method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-sm btn-<?php echo e($tenant->estado === 'activo' ? 'warning' : 'success'); ?>"
                                            onclick="return confirm('¿<?php echo e($tenant->estado === 'activo' ? 'Suspender' : 'Activar'); ?> este tenant?')">
                                        <?php echo e($tenant->estado === 'activo' ? 'Suspender' : 'Activar'); ?>

                                    </button>
                                </form>

                                <form action="<?php echo e(route('superadmin.tenants.destroy', $tenant)); ?>" method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('¿Eliminar PERMANENTEMENTE este tenant? Todos sus datos se perderán.')">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="8" class="text-center">No hay tenants registrados</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>

                <div class="mt-3">
                    <?php echo e($tenants->links()); ?>

                </div>
            </div>
        </div>
    </div>
</body>
</html><?php /**PATH C:\laragon\www\crm-gestion-tienda-celulares\resources\views/superadmin/tenants.blade.php ENDPATH**/ ?>