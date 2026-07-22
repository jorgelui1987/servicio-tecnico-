
<?php $__env->startSection('title', 'Nuevo Proveedor'); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('proveedores.index')); ?>" style="color:#a855f7;">Proveedores</a></li>
    <li class="breadcrumb-item active">Nuevo Proveedor</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-1">Registrar Nuevo Proveedor</h5>
                <p class="text-muted mb-4" style="font-size:13px;">Completa los datos del proveedor</p>
                <?php if($errors->any()): ?>
                    <div class="alert alert-danger"><ul class="mb-0 ps-3"><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li style="font-size:13px;"><?php echo e($e); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul></div>
                <?php endif; ?>
                <form action="<?php echo e(route('proveedores.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nombre <span class="text-danger">*</span></label>
                            <input type="text" class="form-control <?php $__errorArgs = ['nombre'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="nombre" value="<?php echo e(old('nombre')); ?>" placeholder="Nombre del proveedor" required>
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
                            <label class="form-label">Contacto</label>
                            <input type="text" class="form-control" name="contacto" value="<?php echo e(old('contacto')); ?>" placeholder="Persona de contacto">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Teléfono</label>
                            <input type="text" class="form-control" name="telefono" value="<?php echo e(old('telefono')); ?>" placeholder="+51 999 999 999">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" placeholder="proveedor@email.com">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">RUC</label>
                            <input type="text" class="form-control" name="ruc" value="<?php echo e(old('ruc')); ?>" placeholder="12345678901">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Dirección</label>
                            <input type="text" class="form-control" name="direccion" value="<?php echo e(old('direccion')); ?>" placeholder="Dirección del proveedor">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Notas</label>
                            <textarea class="form-control" name="notas" rows="3" placeholder="Notas adicionales..."><?php echo e(old('notas')); ?></textarea>
                        </div>
                    </div>
                    <hr class="mt-4">
                    <div class="d-flex gap-2 justify-content-end">
                        <a href="<?php echo e(route('proveedores.index')); ?>" class="btn btn-outline-secondary px-4">Cancelar</a>
                        <button type="submit" class="btn btn-primary px-4"><i class="fas fa-save me-2"></i>Guardar Proveedor</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\crm-gestion-tienda-celulares\resources\views/proveedores/create.blade.php ENDPATH**/ ?>