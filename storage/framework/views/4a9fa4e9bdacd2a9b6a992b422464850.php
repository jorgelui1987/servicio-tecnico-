<?php $__env->startSection('title', 'Editar Producto'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('productos.index')); ?>" style="color:#a855f7;">Inventario</a></li>
    <li class="breadcrumb-item active">Editar</li>
<?php $__env->stopSection(); ?>

    <?php $__env->startSection('content'); ?>
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-1">Editar Producto</h5>
                    <p class="text-muted mb-4" style="font-size:13px;">Modifica los datos del producto</p>
    
                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0 ps-3">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li style="font-size:13px;"><?php echo e($e); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>
    
                    <?php $producto = $producto ?? null; ?>

                <form action="<?php echo e(route('productos.update', $producto)); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>

                    <div class="row g-4">
                        <div class="col-lg-8">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label">Código SKU <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control <?php $__errorArgs = ['codigo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                           name="codigo" value="<?php echo e(old('codigo', $producto->codigo)); ?>">
                                    <?php $__errorArgs = ['codigo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Código de Barras</label>
                                    <input type="text" class="form-control <?php $__errorArgs = ['codigo_barras'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                           name="codigo_barras" value="<?php echo e(old('codigo_barras', $producto->codigo_barras)); ?>">
                                    <?php $__errorArgs = ['codigo_barras'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Garantía (días)</label>
                                    <input type="number" class="form-control" name="garantia_dias"
                                           value="<?php echo e(old('garantia_dias', $producto->garantia_dias ?? 0)); ?>" min="0">
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label">Nombre <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control <?php $__errorArgs = ['nombre'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                           name="nombre" value="<?php echo e(old('nombre', $producto->nombre)); ?>">
                                    <?php $__errorArgs = ['nombre'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Proveedor</label>
                                    <select name="proveedor_id" class="form-select">
                                        <option value="">— Sin proveedor —</option>
                                        <?php $__currentLoopData = \App\Models\Proveedor::where('activo', true)->orderBy('nombre')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prov): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($prov->id); ?>" <?php echo e(old('proveedor_id', $producto->proveedor_id)==$prov->id?'selected':''); ?>>
                                                <?php echo e($prov->nombre); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Categoría <span class="text-danger">*</span></label>
                                    <select name="categoria_id" class="form-select" required>
                                        <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($cat->id); ?>" <?php echo e(old('categoria_id',$producto->categoria_id)==$cat->id?'selected':''); ?>>
                                                <?php echo e($cat->nombre); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Marca <span class="text-danger">*</span></label>
                                    <select name="marca_id" class="form-select" required>
                                        <?php $__currentLoopData = $marcas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($m->id); ?>" <?php echo e(old('marca_id',$producto->marca_id)==$m->id?'selected':''); ?>>
                                                <?php echo e($m->nombre); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Modelo</label>
                                    <input type="text" class="form-control" name="modelo"
                                           value="<?php echo e(old('modelo', $producto->modelo)); ?>">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Color</label>
                                    <input type="text" class="form-control" name="color"
                                           value="<?php echo e(old('color', $producto->color)); ?>">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Condición</label>
                                    <select name="condicion" class="form-select">
                                        <?php $__currentLoopData = ['nuevo','reacondicionado','usado']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($c); ?>" <?php echo e(old('condicion',$producto->condicion)==$c?'selected':''); ?>><?php echo e(ucfirst($c)); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Almacenamiento</label>
                                    <select name="almacenamiento" class="form-select">
                                        <option value="">— Sin especificar —</option>
                                        <?php $__currentLoopData = ['32GB','64GB','128GB','256GB','512GB','1TB']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $alm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($alm); ?>" <?php echo e(old('almacenamiento',$producto->almacenamiento)==$alm?'selected':''); ?>><?php echo e($alm); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">RAM</label>
                                    <select name="ram" class="form-select">
                                        <option value="">— Sin especificar —</option>
                                        <?php $__currentLoopData = ['2GB','3GB','4GB','6GB','8GB','12GB','16GB']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ram): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($ram); ?>" <?php echo e(old('ram',$producto->ram)==$ram?'selected':''); ?>><?php echo e($ram); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">IMEI</label>
                                    <input type="text" class="form-control" name="imei"
                                           value="<?php echo e(old('imei', $producto->imei)); ?>">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Precio Compra (S/)</label>
                                    <input type="number" class="form-control" name="precio_compra"
                                           value="<?php echo e(old('precio_compra', $producto->precio_compra)); ?>"
                                           min="0" step="0.01" oninput="calcularMargen()">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Precio Venta (S/)</label>
                                    <input type="number" class="form-control" name="precio_venta"
                                           value="<?php echo e(old('precio_venta', $producto->precio_venta)); ?>"
                                           min="0" step="0.01" oninput="calcularMargen()">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Margen</label>
                                    <div class="form-control" style="background:#f9fafb;">
                                        <span id="margenValor" style="font-weight:600; color:#10b981;">
                                            <?php echo e(number_format($producto->margen, 1)); ?>%
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Stock Actual</label>
                                    <input type="number" class="form-control" name="stock"
                                           value="<?php echo e(old('stock', $producto->stock)); ?>" min="0">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Stock Mínimo</label>
                                    <input type="number" class="form-control" name="stock_minimo"
                                           value="<?php echo e(old('stock_minimo', $producto->stock_minimo)); ?>" min="0">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Estado</label>
                                    <select name="activo" class="form-select">
                                        <option value="1" <?php echo e($producto->activo?'selected':''); ?>>Activo</option>
                                        <option value="0" <?php echo e(!$producto->activo?'selected':''); ?>>Inactivo</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Descripción</label>
                                    <textarea class="form-control" name="descripcion" rows="3"><?php echo e(old('descripcion', $producto->descripcion)); ?></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <label class="form-label">Imagen del Producto</label>
                            <?php if($producto->imagen): ?>
                                <div class="mb-3">
                                    <img src="<?php echo e(asset('storage/'.$producto->imagen)); ?>" id="previewImg"
                                         style="width:100%; border-radius:12px; max-height:220px; object-fit:cover;">
                                    <p class="text-muted mt-1" style="font-size:12px;">Imagen actual</p>
                                </div>
                            <?php else: ?>
                                <img id="previewImg" src="" style="display:none; width:100%; border-radius:12px; max-height:220px; object-fit:cover; margin-bottom:8px;">
                            <?php endif; ?>

                            <div onclick="document.getElementById('imagenInput').click()"
                                 style="border:2px dashed #d1d5db; border-radius:12px; padding:20px;
                                        text-align:center; cursor:pointer; background:#fafafa;">
                                <i class="fas fa-camera text-muted mb-2 d-block"></i>
                                <span style="font-size:12px; color:#6b7280;">
                                    <?php echo e($producto->imagen ? 'Cambiar imagen' : 'Subir imagen'); ?>

                                </span>
                            </div>
                            <input type="file" id="imagenInput" name="imagen" accept="image/*"
                                   style="display:none;" onchange="previewImage(this)">
                        </div>
                    </div>

                    <hr class="mt-4">
                    <div class="d-flex gap-2 justify-content-end">
                        <a href="<?php echo e(route('productos.index')); ?>" class="btn btn-outline-secondary px-4">Cancelar</a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-save me-2"></i>Actualizar Producto
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
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            const img = document.getElementById('previewImg');
            img.src = e.target.result;
            img.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
function calcularMargen() {
    const compra = parseFloat(document.querySelector('[name=precio_compra]').value) || 0;
    const venta  = parseFloat(document.querySelector('[name=precio_venta]').value) || 0;
    const margen = compra > 0 ? ((venta - compra) / compra * 100) : 0;
    document.getElementById('margenValor').textContent = margen.toFixed(1) + '%';
    document.getElementById('margenValor').style.color = margen >= 0 ? '#10b981' : '#dc2626';
}
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\crm-gestion-tienda-celulares\resources\views/productos/edit.blade.php ENDPATH**/ ?>