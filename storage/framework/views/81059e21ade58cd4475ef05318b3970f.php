<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SuperAdmin - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">🔐 SuperAdmin CRM</a>
            <div class="ms-auto">
                <a href="<?php echo e(route('superadmin.tenants')); ?>" class="btn btn-outline-light btn-sm me-2">Tenants</a>
                <a href="<?php echo e(route('superadmin.logout')); ?>" class="btn btn-outline-light btn-sm"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar Sesión</a>
                <form id="logout-form" action="<?php echo e(route('superadmin.logout')); ?>" method="POST" class="d-none"><?php echo csrf_field(); ?></form>
            </div>
        </div>
    </nav>

    <div class="container py-4">
        <h2>Panel de Control SuperAdmin</h2>

        <div class="row mt-4">
            <div class="col-md-3">
                <div class="card text-bg-primary mb-3">
                    <div class="card-body text-center">
                        <h5 class="card-title"><?php echo e($stats['total_tenants']); ?></h5>
                        <p class="card-text">Total Tenants</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-bg-success mb-3">
                    <div class="card-body text-center">
                        <h5 class="card-title"><?php echo e($stats['tenants_activos']); ?></h5>
                        <p class="card-text">Activos</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-bg-danger mb-3">
                    <div class="card-body text-center">
                        <h5 class="card-title"><?php echo e($stats['tenants_suspendidos']); ?></h5>
                        <p class="card-text">Suspendidos</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-bg-info mb-3">
                    <div class="card-body text-center">
                        <h5 class="card-title"><?php echo e($stats['usuarios_totales']); ?></h5>
                        <p class="card-text">Usuarios Totales</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header d-flex justify-content-between">
                <span>Últimos Tenants Registrados</span>
                <a href="<?php echo e(route('superadmin.tenants')); ?>" class="btn btn-sm btn-primary">Ver todos</a>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Empresa</th>
                            <th>Subdominio</th>
                            <th>Plan</th>
                            <th>Estado</th>
                            <th>Registro</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $stats['ultimos_tenants']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tenant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($tenant->empresa); ?></td>
                            <td><?php echo e($tenant->subdominio); ?></td>
                            <td><span class="badge bg-info"><?php echo e($tenant->plan); ?></span></td>
                            <td>
                                <span class="badge bg-<?php echo e($tenant->estado === 'activo' ? 'success' : 'danger'); ?>">
                                    <?php echo e($tenant->estado); ?>

                                </span>
                            </td>
                            <td><?php echo e($tenant->created_at->format('d/m/Y')); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="5" class="text-center">No hay tenants registrados</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html><?php /**PATH C:\laragon\www\crm-gestion-tienda-celulares\resources\views/superadmin/dashboard.blade.php ENDPATH**/ ?>