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
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white text-center">
                        <h4>📱 Crear tu cuenta gratuita</h4>
                        <p class="mb-0">Comienza a gestionar tu tienda de celulares</p>
                    </div>
                    <div class="card-body">
                        <?php if(session('success')): ?>
                            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
                        <?php endif; ?>

                        <form method="POST" action="<?php echo e(route('registro.tenant.store')); ?>">
                            <?php echo csrf_field(); ?>

                            <div class="text-center mb-4">
                                <span class="badge bg-success" style="font-size:0.9rem; padding:8px 20px;">
                                    🌱 Plan Gratis incluido
                                </span>
                            </div>

                            <h5 class="border-bottom pb-2">Datos de la empresa</h5>
                            <div class="mb-3">
                                <label class="form-label">Nombre de tu tienda o empresa *</label>
                                <input type="text" name="empresa" class="form-control <?php $__errorArgs = ['empresa'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('empresa')); ?>" required placeholder="Ej: Celulares García">
                                <?php $__errorArgs = ['empresa'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="invalid-feedback"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <h5 class="border-bottom pb-2 mt-4">Datos del administrador</h5>
                            <div class="mb-3">
                                <label class="form-label">Nombre completo *</label>
                                <input type="text" name="nombre" class="form-control <?php $__errorArgs = ['nombre'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('nombre')); ?>" required placeholder="Ej: Juan Pérez">
                                <?php $__errorArgs = ['nombre'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="invalid-feedback"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Correo electrónico *</label>
                                <input type="email" name="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('email')); ?>" required placeholder="tucorreo@ejemplo.com">
                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="invalid-feedback"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Contraseña *</label>
                                <input type="password" name="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="invalid-feedback"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Confirmar contraseña *</label>
                                <input type="password" name="password_confirmation" class="form-control" required>
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" name="terminos" class="form-check-input" id="terminos" required>
                                <label class="form-check-label" for="terminos">Acepto los <a href="#" target="_blank">términos y condiciones</a></label>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Crear cuenta gratuita</button>
                        </form>

                        <div class="text-center mt-3">
                            <p class="text-muted small">¿Ya tienes cuenta? <a href="<?php echo e(route('login')); ?>">Inicia sesión</a></p>
                        </div>
                    </div>
                </div>
                <p class="text-center text-muted small mt-3">
                    Al registrarte aceptas nuestros términos de servicio.
                    Recibirás un correo con los detalles de acceso.
                </p>
            </div>
        </div>
    </div>
</body>
</html><?php /**PATH C:\laragon\www\crm-gestion-tienda-celulares\resources\views/registro-tenant.blade.php ENDPATH**/ ?>