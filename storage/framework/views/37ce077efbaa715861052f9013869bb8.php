<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SuperAdmin - Usuarios de <?php echo e($tenant->empresa); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="<?php echo e(route('superadmin.dashboard')); ?>">🔐 SuperAdmin CRM</a>
            <div class="ms-auto">
                <a href="<?php echo e(route('superadmin.tenants')); ?>" class="btn btn-outline-light btn-sm">← Volver a Tenants</a>
                <a href="<?php echo e(route('superadmin.logout')); ?>" class="btn btn-outline-light btn-sm ms-2"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar Sesión</a>
                <form id="logout-form" action="<?php echo e(route('superadmin.logout')); ?>" method="POST" class="d-none"><?php echo csrf_field(); ?></form>
            </div>
        </div>
    </nav>

    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2>Usuarios de <?php echo e($tenant->empresa); ?></h2>
                <p class="text-muted">Gestiona contraseñas de los usuarios de este tenant</p>
            </div>
            <span class="badge bg-info" style="font-size:1rem;"><?php echo e($usuarios->count()); ?> usuarios</span>
        </div>

        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <?php if(session('error')): ?>
            <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
        <?php endif; ?>

        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usuario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($usuario->id); ?></td>
                            <td><?php echo e($usuario->name); ?></td>
                            <td><code><?php echo e($usuario->email); ?></code></td>
                            <td>
                                <span class="badge bg-<?php echo e($usuario->rol === 'admin' ? 'primary' : ($usuario->rol === 'vendedor' ? 'info' : 'warning')); ?>">
                                    <?php echo e($usuario->rol); ?>

                                </span>
                            </td>
                            <td>
                                <span class="badge bg-<?php echo e($usuario->activo ? 'success' : 'danger'); ?>">
                                    <?php echo e($usuario->activo ? 'Activo' : 'Inactivo'); ?>

                                </span>
                            </td>
                            <td>
                                <!-- Botón cambiar contraseña -->
                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalPassword"
                                        onclick="document.getElementById('formCambiarPass').action = '<?php echo e(route('superadmin.usuarios.change-password', $usuario)); ?>';
                                                document.getElementById('userNamePass').textContent = '<?php echo e(addslashes($usuario->name)); ?>';
                                                document.getElementById('userEmailPass').textContent = '<?php echo e($usuario->email); ?>';">
                                    🔑 Cambiar contraseña
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="6" class="text-center">No hay usuarios en este tenant</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>

                <div class="mt-3">
                    <a href="<?php echo e(route('superadmin.tenants.login-as', $tenant)); ?>" class="btn btn-info"
                       onclick="return confirm('¿Iniciar sesión como admin de <?php echo e($tenant->empresa); ?>?')">
                        🔑 Iniciar sesión como admin
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Cambiar Contraseña -->
    <div class="modal fade" id="modalPassword" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">🔑 Cambiar contraseña</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="formCambiarPass" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <p>Usuario: <strong id="userNamePass"></strong> (<span id="userEmailPass"></span>)</p>
                        <div class="mb-3">
                            <label class="form-label">Nueva contraseña *</label>
                            <input type="password" name="password" class="form-control" required minlength="8">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Confirmar contraseña *</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-warning">Cambiar contraseña</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html><?php /**PATH C:\laragon\www\crm-gestion-tienda-celulares\resources\views/superadmin/tenant-users.blade.php ENDPATH**/ ?>