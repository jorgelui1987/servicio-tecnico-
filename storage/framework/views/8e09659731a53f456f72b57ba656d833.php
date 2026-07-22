<?php $__env->startSection('title', 'Actualizar Reparación'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('reparaciones.index')); ?>" style="color:#a855f7;">Reparaciones</a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('reparaciones.show', $reparacion)); ?>" style="color:#a855f7;"><?php echo e($reparacion->numero_orden); ?></a></li>
    <li class="breadcrumb-item active">Editar</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div>
                        <h5 class="fw-bold mb-1">Actualizar Orden: <?php echo e($reparacion->numero_orden); ?></h5>
                        <p class="text-muted mb-0" style="font-size:13px;">
                            <?php echo e($reparacion->dispositivo); ?> — <?php echo e($reparacion->cliente->nombre_completo ?? ''); ?>

                        </p>
                    </div>
                    <a href="<?php echo e(route('reparaciones.show', $reparacion)); ?>" class="btn btn-outline-secondary">
                        <i class="fas fa-eye me-1"></i>Ver Detalle
                    </a>
                </div>

                <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0 ps-3">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li style="font-size:13px;"><?php echo e($e); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="<?php echo e(route('reparaciones.update', $reparacion)); ?>" method="POST">
                    <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>

                    <div class="row g-4">
                        
                        <div class="col-12">
                            <h6 class="fw-600 mb-3" style="font-weight:600; color:#1e1b4b;">
                                <i class="fas fa-tasks me-2" style="color:#a855f7;"></i>Estado de la Orden
                            </h6>
                            <div class="row g-3">
                                <div class="col-md-5">
                                    <label class="form-label">Estado Actual <span class="text-danger">*</span></label>
                                    <select name="estado" class="form-select" required>
                                        <?php $estados = ['recibido'=>'📥 Recibido','en_diagnostico'=>'🔍 En Diagnóstico','esperando_repuesto'=>'⏳ Esperando Repuesto','en_reparacion'=>'🔧 En Reparación','listo'=>'✅ Listo para Entregar','entregado'=>'📦 Entregado','no_reparable'=>'❌ No Reparable']; ?>
                                        <?php $__currentLoopData = $estados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $lbl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($val); ?>" <?php echo e(old('estado',$reparacion->estado)==$val?'selected':''); ?>>
                                                <?php echo e($lbl); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Prioridad</label>
                                    <select name="prioridad" class="form-select">
                                        <option value="baja" <?php echo e(old('prioridad',$reparacion->prioridad)=='baja'?'selected':''); ?>>🟢 Baja</option>
                                        <option value="media" <?php echo e(old('prioridad',$reparacion->prioridad)=='media'?'selected':''); ?>>🟡 Media</option>
                                        <option value="alta" <?php echo e(old('prioridad',$reparacion->prioridad)=='alta'?'selected':''); ?>>🟠 Alta</option>
                                        <option value="urgente" <?php echo e(old('prioridad',$reparacion->prioridad)=='urgente'?'selected':''); ?>>🔴 Urgente</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Técnico Asignado</label>
                                    <select name="tecnico_id" class="form-select">
                                        <?php $__currentLoopData = $tecnicos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($t->id); ?>" <?php echo e(old('tecnico_id',$reparacion->tecnico_id)==$t->id?'selected':''); ?>>
                                                <?php echo e($t->name); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        
                        <div class="col-12">
                            <h6 class="fw-600 mb-3" style="font-weight:600; color:#1e1b4b;">
                                <i class="fas fa-mobile-alt me-2" style="color:#a855f7;"></i>Equipo
                            </h6>
                            <div class="row g-3">
                                
                                <div class="col-md-4">
                                    <label class="form-label">📱 Tipo de Dispositivo <span class="text-danger">*</span></label>
                                    <select name="tipo_dispositivo" class="form-select" required>
                                        <option value="">— Seleccionar tipo —</option>
                                        <option value="celular" <?php echo e(old('tipo_dispositivo',$reparacion->tipo_dispositivo)=='celular'?'selected':''); ?>>📱 Celular / Smartphone</option>
                                        <option value="tablet" <?php echo e(old('tipo_dispositivo',$reparacion->tipo_dispositivo)=='tablet'?'selected':''); ?>>📟 Tablet / iPad</option>
                                        <option value="portatil" <?php echo e(old('tipo_dispositivo',$reparacion->tipo_dispositivo)=='portatil'?'selected':''); ?>>💻 Portátil / Laptop</option>
                                        <option value="otros" <?php echo e(old('tipo_dispositivo',$reparacion->tipo_dispositivo)=='otros'?'selected':''); ?>>🔧 Otros</option>
                                    </select>
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
                                        $marcaActual = old('marca', $reparacion->marca ?? '');
                                        $esOtra = $marcaActual && !in_array($marcaActual, $marcasPrecargadas);
                                    ?>
                                    <select name="marca_select" class="form-select marca-select" onchange="toggleMarcaInputEdit(this)">
                                        <option value="">— Seleccionar o escribir —</option>
                                        <?php $__currentLoopData = $marcasPrecargadas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($m); ?>" <?php echo e($marcaActual==$m?'selected':''); ?>><?php echo e($m); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <option value="__otra__" <?php echo e($esOtra?'selected':''); ?>>✏️ Otra (escribir manualmente)</option>
                                    </select>
                                    <input type="text" class="form-control marca-input mt-1" name="marca"
                                           value="<?php echo e(old('marca',$reparacion->marca)); ?>"
                                           placeholder="Escribir marca manualmente..."
                                           style="<?php echo e($esOtra ? 'display:block;' : 'display:none;'); ?>">
                                </div>
                                
                                <div class="col-md-4">
                                    <label class="form-label">📦 Modelo</label>
                                    <input type="text" class="form-control" name="modelo"
                                           value="<?php echo e(old('modelo',$reparacion->modelo)); ?>">
                                </div>
                                
                                <div class="col-md-4">
                                    <label class="form-label">🔢 IMEI / Serie</label>
                                    <input type="text" class="form-control" name="imei"
                                           value="<?php echo e(old('imei',$reparacion->imei)); ?>">
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="d-flex gap-2 align-items-start">
                                        <div style="flex:0 0 100px;">
                                            <label class="form-label">🔐 Tipo</label>
                                            <select name="tipo_codigo" class="form-select" onchange="togglePatronInputEdit(this)">
                                                <option value="">—</option>
                                                <option value="pin" <?php echo e(old('tipo_codigo',$reparacion->tipo_codigo)=='pin'?'selected':''); ?>>🔢 PIN</option>
                                                <option value="patron" <?php echo e(old('tipo_codigo',$reparacion->tipo_codigo)=='patron'?'selected':''); ?>>🔓 Patrón</option>
                                            </select>
                                        </div>
                                        <div style="flex:1;">
                                            <label class="form-label">Valor</label>
                                            <input type="text" class="form-control patron-valor" name="codigo_equipo"
                                                   value="<?php echo e(old('codigo_equipo',$reparacion->codigo_equipo)); ?>"
                                                   placeholder="PIN numérico"
                                                   style="display:<?php echo e(old('tipo_codigo',$reparacion->tipo_codigo)=='patron'?'none':'block'); ?>;">
                                        </div>
                                    </div>
                                    
                                    <div class="patron-dibujo mt-2" style="display:<?php echo e(old('tipo_codigo',$reparacion->tipo_codigo)=='patron'?'block':'none'); ?>;">
                                        <div style="font-size:11px; color:#9ca3af; margin-bottom:4px;">Dibuja el patrón (toca los puntos en orden):</div>
                                        <div style="display:flex; gap:2px; flex-wrap:wrap; max-width:140px; margin:0 auto;">
                                            <?php for($i=1;$i<=9;$i++): ?>
                                            <div class="patron-punto" data-pos="<?php echo e($i); ?>"
                                                 style="width:40px; height:40px; border-radius:50%; border:2px solid #a855f7;
                                                        display:flex; align-items:center; justify-content:center;
                                                        font-size:13px; color:#a855f7; cursor:pointer; background:#f8f5ff;
                                                        transition:all .2s; user-select:none;"
                                                 onclick="togglePuntoEdit(this)">
                                                <?php echo e($i); ?>

                                            </div>
                                            <?php endfor; ?>
                                        </div>
                                        <input type="hidden" name="patron_secuencia" class="patron-secuencia" value="<?php echo e(old('patron_secuencia')); ?>">
                                        <div style="display:flex; gap:4px; margin-top:4px;">
                                            <span style="font-size:11px; color:#9ca3af;" class="patron-texto">Ningún punto seleccionado</span>
                                            <button type="button" onclick="limpiarPatronEdit()" style="font-size:11px; border:none; background:transparent; color:#dc2626; cursor:pointer; padding:0;">✕ Limpiar</button>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <label class="form-label">🎨 Color</label>
                                    <input type="text" class="form-control" name="color"
                                           value="<?php echo e(old('color',$reparacion->color)); ?>">
                                </div>
                                
                                <div class="col-md-4">
                                    <label class="form-label">📅 Fecha Estimada de Entrega</label>
                                    <input type="date" class="form-control" name="fecha_estimada"
                                           value="<?php echo e(old('fecha_estimada', optional($reparacion->fecha_estimada)->format('Y-m-d'))); ?>">
                                </div>
                            </div>
                        </div>

                        
                        <div class="col-12">
                            <h6 class="fw-600 mb-3" style="font-weight:600; color:#1e1b4b;">
                                <i class="fas fa-stethoscope me-2" style="color:#a855f7;"></i>Diagnóstico Técnico
                            </h6>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label">Falla Reportada <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="falla_reportada" rows="3" required><?php echo e(old('falla_reportada',$reparacion->falla_reportada)); ?></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Diagnóstico del Técnico</label>
                                    <textarea class="form-control" name="diagnostico" rows="4"
                                              placeholder="Describe el diagnóstico técnico del equipo..."><?php echo e(old('diagnostico',$reparacion->diagnostico)); ?></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Solución Aplicada</label>
                                    <textarea class="form-control" name="solucion" rows="4"
                                              placeholder="Describe qué se hizo para solucionar la falla..."><?php echo e(old('solucion',$reparacion->solucion)); ?></textarea>
                                </div>
                            </div>
                        </div>

                        
                        <div class="col-12">
                            <h6 class="fw-600 mb-3" style="font-weight:600; color:#1e1b4b;">
                                <i class="fas fa-dollar-sign me-2" style="color:#a855f7;"></i>Costos y Garantía
                            </h6>
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <label class="form-label">Presupuesto (S/)</label>
                                    <input type="number" class="form-control" name="presupuesto"
                                           value="<?php echo e(old('presupuesto',$reparacion->presupuesto)); ?>" min="0" step="0.01">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Costo Final (S/)</label>
                                    <input type="number" class="form-control" name="costo_final"
                                           value="<?php echo e(old('costo_final',$reparacion->costo_final)); ?>" min="0" step="0.01">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Abono (S/)</label>
                                    <input type="number" class="form-control" name="abono"
                                           value="<?php echo e(old('abono',$reparacion->abono)); ?>" min="0" step="0.01">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Total (S/)</label>
                                    <input type="number" class="form-control total-auto" name="total"
                                           value="<?php echo e(old('total',$reparacion->total)); ?>" min="0" step="0.01" readonly
                                           style="background:#f3f4f6; font-weight:700;">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">¿Incluye Garantía?</label>
                                    <select name="garantia" class="form-select">
                                        <option value="0" <?php echo e(!$reparacion->garantia?'selected':''); ?>>No</option>
                                        <option value="1" <?php echo e($reparacion->garantia?'selected':''); ?>>Sí</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Días de Garantía</label>
                                    <input type="number" class="form-control" name="dias_garantia"
                                           value="<?php echo e(old('dias_garantia',$reparacion->dias_garantia)); ?>" min="0">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Notas adicionales</label>
                                    <textarea class="form-control" name="notas" rows="2"><?php echo e(old('notas',$reparacion->notas)); ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="mt-4">
                    <?php
                        use App\Helpers\WhatsAppHelper;
                        $cliente = $reparacion->cliente;
                        $telefonoCliente = WhatsAppHelper::limpiarNumero($cliente->telefono ?? $cliente->celular);
                        $urlRecibido = WhatsAppHelper::generarUrl(
                            $telefonoCliente,
                            WhatsAppHelper::mensajeRecibido($reparacion, $empresa->nombre_tienda ?? 'CRM Celulares')
                        );
                        $urlListo = WhatsAppHelper::generarUrl(
                            $telefonoCliente,
                            WhatsAppHelper::mensajeListo($reparacion, $empresa->nombre_tienda ?? 'CRM Celulares')
                        );
                    ?>
                    <?php if($urlRecibido): ?>
                    <div class="mb-3">
                        <label class="form-label fw-600" style="font-size:13px; color:#1e1b4b;">
                            <i class="fab fa-whatsapp me-1" style="color:#25D366;"></i>Notificar al Cliente por WhatsApp
                        </label>
                        <div class="d-flex gap-2">
                            <a href="<?php echo e($urlRecibido); ?>" target="_blank"
                               class="btn btn-sm" style="background:#25D366; color:#fff; border-radius:8px;">
                                <i class="fab fa-whatsapp me-1"></i>📩 Notificar Recibido
                            </a>
                            <a href="<?php echo e($urlListo); ?>" target="_blank"
                               class="btn btn-sm" style="background:#25D366; color:#fff; border-radius:8px;">
                                <i class="fab fa-whatsapp me-1"></i>📩 Notificar Listo/Entregado
                            </a>
                        </div>
                        <div style="font-size:11px; color:#9ca3af; margin-top:4px;">
                            📞 <?php echo e($reparacion->cliente->telefono ?? '—'); ?>

                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="d-flex gap-2 justify-content-end">
                        <a href="<?php echo e(route('reparaciones.show', $reparacion)); ?>" class="btn btn-outline-secondary px-4">Cancelar</a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-save me-2"></i>Guardar Cambios
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
function toggleMarcaInputEdit(select) {
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
let patronPuntosEdit = [];

function togglePatronInputEdit(select) {
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
        limpiarPatronEdit();
    } else {
        dibujo.style.display = 'none';
        valorInput.style.display = 'block';
        valorInput.placeholder = 'Valor del PIN o patrón';
        limpiarPatronEdit();
    }
}

function togglePuntoEdit(el) {
    const container = el.closest('.col-md-4');
    const pos = parseInt(el.dataset.pos);
    const idx = patronPuntosEdit.indexOf(pos);

    if (idx === -1) {
        patronPuntosEdit.push(pos);
        el.style.background = 'linear-gradient(135deg, #a855f7, #ec4899)';
        el.style.color = '#fff';
        el.style.borderColor = 'transparent';
        el.style.transform = 'scale(1.1)';
        el.textContent = patronPuntosEdit.length;
    } else {
        patronPuntosEdit.splice(idx, 1);
        el.style.background = '#f8f5ff';
        el.style.color = '#a855f7';
        el.style.borderColor = '#a855f7';
        el.style.transform = 'scale(1)';
        patronPuntosEdit.forEach((p, i) => {
            const punto = container.querySelector(`.patron-punto[data-pos="${p}"]`);
            if (punto) punto.textContent = i + 1;
        });
    }

    actualizarPatronTextoEdit(container);
}

function limpiarPatronEdit() {
    patronPuntosEdit = [];
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

function actualizarPatronTextoEdit(container) {
    const texto = container.querySelector('.patron-texto');
    const hidden = container.querySelector('.patron-secuencia');
    if (patronPuntosEdit.length === 0) {
        texto.textContent = 'Ningún punto seleccionado';
        hidden.value = '';
    } else {
        const secuencia = patronPuntosEdit.join('-');
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\crm-gestion-tienda-celulares\resources\views/reparaciones/edit.blade.php ENDPATH**/ ?>