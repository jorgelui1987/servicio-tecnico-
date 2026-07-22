<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - CRM Celulares</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white text-center">
                        <h4>📱 Registrar usuario</h4>
                    </div>
                    <div class="card-body">
                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <p class="mb-0"><?php echo e($error); ?></p> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endif; ?>

                        <form method="POST" action="<?php echo e(route('register.post')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="mb-3">
                                <label class="form-label">Nombre completo</label>
                                <input type="text" name="name" class="form-control" value="<?php echo e(old('name')); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" value="<?php echo e(old('email')); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Contraseña</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Confirmar contraseña</label>
                                <input type="password" name="password_confirmation" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Rol</label>
                                <select name="rol" class="form-select" required>
                                    <option value="vendedor">Vendedor</option>
                                    <option value="tecnico">Técnico</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Teléfono</label>
                                <input type="text" name="telefono" class="form-control" value="<?php echo e(old('telefono')); ?>">
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Registrar</button>
                        </form>
                        <div class="text-center mt-3">
                            <a href="<?php echo e(route('login')); ?>">¿Ya tienes cuenta? Inicia sesión</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html><?php /**PATH C:\laragon\www\crm-gestion-tienda-celulares\resources\views/auth/register.blade.php ENDPATH**/ ?>