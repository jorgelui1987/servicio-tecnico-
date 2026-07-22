<?php $__env->startSection('title', 'Nueva Reparación'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('reparaciones.index')); ?>" style="color:#a855f7;">Reparaciones</a></li>
    <li class="breadcrumb-item active">Nueva Orden</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-1">Nueva Orden de Reparación</h5>
                <p class="text-muted mb-4" style="font-size:13px;">Registra un nuevo equipo para servicio técnico</p>

                <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0 ps-3">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li style="font-size:13px;"><?php echo e($e); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="<?php echo e(route('reparaciones.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>

                    <div class="row g-4">
                        
                        <div class="col-12">
                            <h6 class="fw-600 mb-3" style="font-weight:600; color:#1e1b4b;">
                                <i class="fas fa-users me-2" style="color:#a855f7;"></i>Asignación
                            </h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Cliente <span class="text-danger">*</span></label>
                                    <select name="cliente_id" class="form-select <?php $__errorArgs = ['cliente_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                        <option value="">— Seleccionar cliente —</option>
                                        <?php $__currentLoopData = $clientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($c->id); ?>"
                                                    <?php echo e((old('cliente_id', request('cliente')) == $c->id) ? 'selected' : ''); ?>>
                                                <?php echo e($c->nombre_completo); ?> — <?php echo e($c->telefono); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['cliente_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Técnico Asignado <span class="text-danger">*</span></label>
                                    <select name="tecnico_id" class="form-select <?php $__errorArgs = ['tecnico_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                        <option value="">— Seleccionar técnico —</option>
                                        <?php $__currentLoopData = $tecnicos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($t->id); ?>" <?php echo e(old('tecnico_id')==$t->id?'selected':''); ?>>
                                                <?php echo e($t->name); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['tecnico_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Prioridad <span class="text-danger">*</span></label>
                                    <select name="prioridad" class="form-select" required>
                                        <option value="baja" <?php echo e(old('prioridad')=='baja'?'selected':''); ?>>🟢 Baja</option>
                                        <option value="media" <?php echo e(old('prioridad','media')=='media'?'selected':''); ?>>🟡 Media</option>
                                        <option value="alta" <?php echo e(old('prioridad')=='alta'?'selected':''); ?>>🟠 Alta</option>
                                        <option value="urgente" <?php echo e(old('prioridad')=='urgente'?'selected':''); ?>>🔴 Urgente</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        
                        <div class="col-12">
                            <h6 class="fw-600 mb-3" style="font-weight:600; color:#1e1b4b;">
                                <i class="fas fa-mobile-alt me-2" style="color:#a855f7;"></i>Datos del Equipo
                            </h6>
                            <div class="row g-3">
                                
                                <div class="col-md-4">
                                    <label class="form-label">📱 Tipo de Dispositivo <span class="text-danger">*</span></label>
                                    <select name="tipo_dispositivo" class="form-select <?php $__errorArgs = ['tipo_dispositivo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                        <option value="">— Seleccionar tipo —</option>
                                        <option value="celular" <?php echo e(old('tipo_dispositivo')=='celular'?'selected':''); ?>>📱 Celular / Smartphone</option>
                                        <option value="tablet" <?php echo e(old('tipo_dispositivo')=='tablet'?'selected':''); ?>>📟 Tablet / iPad</option>
                                        <option value="portatil" <?php echo e(old('tipo_dispositivo')=='portatil'?'selected':''); ?>>💻 Portátil / Laptop</option>
                                        <option value="otros" <?php echo e(old('tipo_dispositivo')=='otros'?'selected':''); ?>>🔧 Otros</option>
                                    </select>
                                    <?php $__errorArgs = ['tipo_dispositivo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                
                                <div class="col-md-4">
                                    <label class="form-label">🏷️ Marca</label>
                                    <?php
                                        $marcasPrecargadas = [
                                            'Samsung', 'Apple', 'Xiaomi', 'Huawei', 'Motorola',
                                            'LG', 'Sony', 'Nokia', 'Alcatel', 'Honor',
                                            'Realme', 'Oppo', 'Vivo', 'OnePlus', 'Google',
                                            'HP', 'Dell', 'Lenovo', 'Acer', 'Asus',
                                            'Toshiba', 'Microsoft', 'HTC', 'ZTE', 'BlackBerry',
                                        ];
                                        $marcaSeleccionada = old('marca');
                                    ?>
                                    <select name="marca_select" class="form-select marca-select" onchange="toggleMarcaInput(this)">
                                        <option value="">— Seleccionar o escribir —</option>
                                        <?php $__currentLoopData = $marcasPrecargadas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($m); ?>" <?php echo e($marcaSeleccionada==$m?'selected':''); ?>><?php echo e($m); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <option value="__otra__" <?php echo e($marcaSeleccionada && !in_array($marcaSeleccionada, $marcasPrecargadas) ? 'selected' : ''); ?>>✏️ Otra (escribir manualmente)</option>
                                    </select>
                                    <input type="text" class="form-control marca-input mt-1 <?php $__errorArgs = ['marca'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                           name="marca" value="<?php echo e(old('marca')); ?>"
                                           placeholder="Escribir marca manualmente..."
                                           style="<?php echo e($marcaSeleccionada && !in_array($marcaSeleccionada, $marcasPrecargadas) ? 'display:block;' : 'display:none;'); ?>">
                                    <?php $__errorArgs = ['marca'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                
                                <div class="col-md-4">
                                    <label class="form-label">📦 Modelo</label>
                                    <input type="text" class="form-control" name="modelo"
                                           value="<?php echo e(old('modelo')); ?>" placeholder="Galaxy, iPhone, ThinkPad...">
                                </div>
                                
                                <div class="col-md-4">
                                    <label class="form-label">🔢 IMEI / Serie</label>
                                    <input type="text" class="form-control" name="imei"
                                           value="<?php echo e(old('imei')); ?>" placeholder="123456789012345">
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="d-flex gap-2 align-items-start">
                                        <div style="flex:0 0 100px;">
                                            <label class="form-label">🔐 Tipo</label>
                                            <select name="tipo_codigo" class="form-select" onchange="togglePatronInput(this)">
                                                <option value="">—</option>
                                                <option value="pin" <?php echo e(old('tipo_codigo')=='pin'?'selected':''); ?>>🔢 PIN</option>
                                                <option value="patron" <?php echo e(old('tipo_codigo')=='patron'?'selected':''); ?>>🔓 Patrón</option>
                                            </select>
                                        </div>
                                        <div style="flex:1;">
                                            <label class="form-label">Valor</label>
                                            <input type="text" class="form-control patron-valor" name="codigo_equipo"
                                                   value="<?php echo e(old('codigo_equipo')); ?>"
                                                   placeholder="PIN numérico" style="display:block;">
                                        </div>
                                    </div>
                                    
                                    <div class="patron-dibujo mt-2" style="display:none;">
                                        <div style="font-size:11px; color:#9ca3af; margin-bottom:4px;">Dibuja el patrón (toca los puntos en orden):</div>
                                        <div style="display:flex; gap:2px; flex-wrap:wrap; max-width:140px; margin:0 auto;">
                                            <?php for($i=1;$i<=9;$i++): ?>
                                            <div class="patron-punto" data-pos="<?php echo e($i); ?>"
                                                 style="width:40px; height:40px; border-radius:50%; border:2px solid #a855f7;
                                                        display:flex; align-items:center; justify-content:center;
                                                        font-size:13px; color:#a855f7; cursor:pointer; background:#f8f5ff;
                                                        transition:all .2s; user-select:none;"
                                                 onclick="togglePunto(this)">
                                                <?php echo e($i); ?>

                                            </div>
                                            <?php endfor; ?>
                                        </div>
                                        <input type="hidden" name="patron_secuencia" class="patron-secuencia" value="<?php echo e(old('patron_secuencia')); ?>">
                                        <div style="display:flex; gap:4px; margin-top:4px;">
                                            <span style="font-size:11px; color:#9ca3af;" class="patron-texto">Ningún punto seleccionado</span>
                                            <button type="button" onclick="limpiarPatron()" style="font-size:11px; border:none; background:transparent; color:#dc2626; cursor:pointer; padding:0;">✕ Limpiar</button>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <label class="form-label">🎨 Color</label>
                                    <input type="text" class="form-control" name="color"
                                           value="<?php echo e(old('color')); ?>" placeholder="Negro, Blanco, Plateado...">
                                </div>
                                
                                <div class="col-md-4">
                                    <label class="form-label">📅 Fecha Estimada de Entrega</label>
                                    <input type="date" class="form-control" name="fecha_estimada"
                                           value="<?php echo e(old('fecha_estimada')); ?>" min="<?php echo e(date('Y-m-d')); ?>">
                                </div>
                            </div>
                        </div>

                        
                        <div class="col-12">
                            <h6 class="fw-600 mb-3" style="font-weight:600; color:#1e1b4b;">
                                <i class="fas fa-exclamation-triangle me-2" style="color:#a855f7;"></i>Falla y Presupuesto
                            </h6>
                            <div class="row g-3">
                                <div class="col-md-8">
                                    <label class="form-label">Falla Reportada por el Cliente <span class="text-danger">*</span></label>
                                    <textarea class="form-control <?php $__errorArgs = ['falla_reportada'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                              name="falla_reportada" rows="4"
                                              placeholder="Describe exactamente qué problema reporta el cliente..."><?php echo e(old('falla_reportada')); ?></textarea>
                                    <?php $__errorArgs = ['falla_reportada'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Presupuesto Estimado (S/)</label>
                                    <input type="number" class="form-control" name="presupuesto"
                                           value="<?php echo e(old('presupuesto', 0)); ?>" min="0" step="0.01">
                                    <div style="font-size:12px; color:#9ca3af; margin-top:4px;">
                                        Dejar en 0 si aún no se determinó
                                    </div>

                                    <label class="form-label mt-3">Abono (S/)</label>
                                    <input type="number" class="form-control" name="abono"
                                           value="<?php echo e(old('abono', 0)); ?>" min="0" step="0.01">
                                    <div style="font-size:12px; color:#9ca3af; margin-top:4px;">
                                        Monto pagado por adelantado
                                    </div>

                                    <label class="form-label mt-3">Total (S/)</label>
                                    <input type="number" class="form-control total-auto" name="total"
                                           value="<?php echo e(old('total', 0)); ?>" min="0" step="0.01" readonly
                                           style="background:#f3f4f6; font-weight:700;">
                                    <div style="font-size:12px; color:#9ca3af; margin-top:4px;">
                                        Presupuesto - Abono (saldo pendiente)
                                    </div>

                                    <label class="form-label mt-3">Notas Adicionales</label>
                                    <textarea class="form-control" name="notas" rows="4"
                                              placeholder="Accesorios recibidos, observaciones al recibir el equipo..."><?php echo e(old('notas')); ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="mt-4">
                    <div class="d-flex gap-2 justify-content-end">
                        <a href="<?php echo e(route('reparaciones.index')); ?>" class="btn btn-outline-secondary px-4">Cancelar</a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-save me-2"></i>Registrar Orden
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
// ── Toggle Marca (precargada / otra) ──
function toggleMarcaInput(select) {
    const input = select.closest('.col-md-4').querySelector('.marca-input');
    const marcaSelect = select.value;
    if (marcaSelect === '__otra__') {
        input.style.display = 'block';
        input.value = '';
        input.focus();
    } else {
        input.style.display = 'none';
        input.value = marcaSelect;
    }
}

// ── Dibujo de Patrón 3x3 ──
let patronPuntos = [];

function togglePatronInput(select) {
    const container = select.closest('.col-md-4');
    const dibujo = container.querySelector('.patron-dibujo');
    const valorInput = container.querySelector('.patron-valor');
    const tipo = select.value;

    if (tipo === 'patron') {
        dibujo.style.display = 'block';
        valorInput.style.display = 'none';
        valorInput.value = '';
    } else if (tipo === 'pin') {
        dibujo.style.display = 'none';
        valorInput.style.display = 'block';
        valorInput.placeholder = 'PIN numérico (ej: 1234)';
        limpiarPatron();
    } else {
        dibujo.style.display = 'none';
        valorInput.style.display = 'block';
        valorInput.placeholder = 'Valor del PIN o patrón';
        limpiarPatron();
    }
}

function togglePunto(el) {
    const container = el.closest('.col-md-4');
    const pos = parseInt(el.dataset.pos);
    const idx = patronPuntos.indexOf(pos);

    if (idx === -1) {
        // Agregar punto
        patronPuntos.push(pos);
        el.style.background = 'linear-gradient(135deg, #a855f7, #ec4899)';
        el.style.color = '#fff';
        el.style.borderColor = 'transparent';
        el.style.transform = 'scale(1.1)';
        el.textContent = patronPuntos.length;
    } else {
        // Quitar solo el punto seleccionado
        patronPuntos.splice(idx, 1);
        el.style.background = '#f8f5ff';
        el.style.color = '#a855f7';
        el.style.borderColor = '#a855f7';
        el.style.transform = 'scale(1)';
        // Renumerar todos los puntos restantes
        patronPuntos.forEach((p, i) => {
            const punto = container.querySelector(`.patron-punto[data-pos="${p}"]`);
            if (punto) punto.textContent = i + 1;
        });
    }

    actualizarPatronTexto(container);
}

function limpiarPatron() {
    patronPuntos = [];
    document.querySelectorAll('.patron-punto').forEach(el => {
        el.style.background = '#f8f5ff';
        el.style.color = '#a855f7';
        el.style.borderColor = '#a855f7';
        el.style.transform = 'scale(1)';
        el.textContent = el.dataset.pos;
    });
    document.querySelectorAll('.patron-texto').forEach(el => el.textContent = 'Ningún punto seleccionado');
    document.querySelectorAll('.patron-secuencia').forEach(el => el.value = '');
}

function actualizarPatronTexto(container) {
    const texto = container.querySelector('.patron-texto');
    const hidden = container.querySelector('.patron-secuencia');
    if (patronPuntos.length === 0) {
        texto.textContent = 'Ningún punto seleccionado';
        hidden.value = '';
    } else {
        const secuencia = patronPuntos.join('-');
        texto.textContent = `Secuencia: ${secuencia}`;
        hidden.value = secuencia;
    }
}

// ── Auto-calcular Total = Presupuesto - Abono ──
document.addEventListener('input', function(e) {
    if (e.target.name === 'presupuesto' || e.target.name === 'abono') {
        const presupuesto = parseFloat(document.querySelector('input[name="presupuesto"]').value) || 0;
        const abono = parseFloat(document.querySelector('input[name="abono"]').value) || 0;
        const totalInput = document.querySelector('input[name="total"]');
        if (totalInput) totalInput.value = Math.max(0, presupuesto - abono).toFixed(2);
    }
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\crm-gestion-tienda-celulares\resources\views/reparaciones/create.blade.php ENDPATH**/ ?>