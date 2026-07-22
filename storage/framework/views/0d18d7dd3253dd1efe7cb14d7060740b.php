<?php $__env->startSection('title', 'Nuevo Cliente'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('clientes.index')); ?>" style="color:#a855f7;">Clientes</a></li>
    <li class="breadcrumb-item active">Nuevo Cliente</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-1">Registrar Nuevo Cliente</h5>
                <p class="text-muted mb-4" style="font-size:13px;">Completa los datos del cliente</p>

                <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0 ps-3">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li style="font-size:13px;"><?php echo e($e); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="<?php echo e(route('clientes.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>

                    
                    <div class="mb-4">
                        <label class="form-label">Tipo de Cliente <span class="text-danger">*</span></label>
                        <div class="d-flex gap-3">
                            <label class="d-flex align-items-center gap-2 cursor-pointer"
                                   style="padding:10px 20px; border:1.5px solid #e5e7eb; border-radius:10px; cursor:pointer; flex:1; transition:.2s;"
                                   onclick="this.style.borderColor='#a855f7'; document.getElementById('tipo_empresa').style.borderColor='#e5e7eb';">
                                <input type="radio" name="tipo" value="particular"
                                       <?php echo e(old('tipo','particular')=='particular'?'checked':''); ?>

                                       style="accent-color:#a855f7;">
                                <span style="font-size:13.5px;">
                                    <i class="fas fa-user me-1 text-muted"></i> Particular
                                </span>
                            </label>
                            <label id="tipo_empresa" class="d-flex align-items-center gap-2"
                                   style="padding:10px 20px; border:1.5px solid #e5e7eb; border-radius:10px; cursor:pointer; flex:1; transition:.2s;"
                                   onclick="this.style.borderColor='#a855f7'; document.querySelector('[value=particular]').parentElement.style.borderColor='#e5e7eb';">
                                <input type="radio" name="tipo" value="empresa"
                                       <?php echo e(old('tipo')=='empresa'?'checked':''); ?>

                                       style="accent-color:#a855f7;">
                                <span style="font-size:13.5px;">
                                    <i class="fas fa-building me-1 text-muted"></i> Empresa
                                </span>
                            </label>
                        </div>
                    </div>

                    
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Nombre <span class="text-danger">*</span></label>
                            <input type="text" class="form-control <?php $__errorArgs = ['nombre'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   name="nombre" value="<?php echo e(old('nombre')); ?>" placeholder="Nombre">
                            <?php $__errorArgs = ['nombre'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Apellido <span class="text-danger">*</span></label>
                            <input type="text" class="form-control <?php $__errorArgs = ['apellido'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   name="apellido" value="<?php echo e(old('apellido')); ?>" placeholder="Apellido">
                            <?php $__errorArgs = ['apellido'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   name="email" value="<?php echo e(old('email')); ?>" placeholder="correo@ejemplo.com">
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Teléfono <span class="text-danger">*</span></label>
                            <input type="text" class="form-control <?php $__errorArgs = ['telefono'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   name="telefono" value="<?php echo e(old('telefono')); ?>" placeholder="999 999 999">
                            <?php $__errorArgs = ['telefono'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Celular</label>
                            <input type="text" class="form-control" name="celular"
                                   value="<?php echo e(old('celular')); ?>" placeholder="999 999 999">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">DNI / Documento</label>
                            <input type="text" class="form-control <?php $__errorArgs = ['dni'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   name="dni" value="<?php echo e(old('dni')); ?>" placeholder="12345678">
                            <?php $__errorArgs = ['dni'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Fecha de Nacimiento</label>
                            <input type="date" class="form-control" name="fecha_nacimiento"
                                   value="<?php echo e(old('fecha_nacimiento')); ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Ciudad</label>
                            <input type="text" class="form-control" name="ciudad"
                                   value="<?php echo e(old('ciudad')); ?>" placeholder="Lima">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Dirección</label>
                            <input type="text" class="form-control" name="direccion"
                                   value="<?php echo e(old('direccion')); ?>" placeholder="Av. Ejemplo 123">
                        </div>
                    </div>

                    
                    <div id="datos-empresa" style="display:<?php echo e(old('tipo')=='empresa'?'block':'none'); ?>;">
                        <hr>
                        <h6 class="fw-600 mb-3" style="font-weight:600;">Datos de Empresa</h6>
                        <div class="row g-3 mb-3">
                            <div class="col-md-8">
                                <label class="form-label">Razón Social</label>
                                <input type="text" class="form-control" name="empresa"
                                       value="<?php echo e(old('empresa')); ?>" placeholder="Empresa SAC">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">RUC</label>
                                <input type="text" class="form-control" name="ruc"
                                       value="<?php echo e(old('ruc')); ?>" placeholder="20123456789">
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="mb-3">
                        <label class="form-label">Notas internas</label>
                        <textarea class="form-control" name="notas" rows="3"
                                  placeholder="Observaciones, preferencias del cliente..."><?php echo e(old('notas')); ?></textarea>
                    </div>

                    <div class="d-flex gap-2 justify-content-end">
                        <a href="<?php echo e(route('clientes.index')); ?>" class="btn btn-outline-secondary px-4">
                            Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-save me-2"></i>Guardar Cliente
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    const radios = document.querySelectorAll('input[name="tipo"]');
    const datosEmpresa = document.getElementById('datos-empresa');

    radios.forEach(r => r.addEventListener('change', function() {
        datosEmpresa.style.display = this.value === 'empresa' ? 'block' : 'none';
    }));
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\crm-gestion-tienda-celulares\resources\views/clientes/create.blade.php ENDPATH**/ ?>