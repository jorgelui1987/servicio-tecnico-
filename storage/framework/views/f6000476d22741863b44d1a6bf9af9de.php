<?php $__env->startSection('title', 'Orden '.$reparacion->numero_orden); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('reparaciones.index')); ?>" style="color:#a855f7;">Reparaciones</a></li>
    <li class="breadcrumb-item active"><?php echo e($reparacion->numero_orden); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
.timeline-item { position:relative; padding-left:28px; margin-bottom:20px; }
.timeline-item::before { content:''; position:absolute; left:8px; top:20px; bottom:-20px; width:2px; background:#e5e7eb; }
.timeline-item:last-child::before { display:none; }
.timeline-dot { position:absolute; left:0; top:6px; width:18px; height:18px; border-radius:50%; display:flex; align-items:center; justify-content:center; }
@media print {
    .sidebar,.topbar,.breadcrumb,.btn-acciones { display:none!important; }
    .main-wrapper { margin-left:0!important; }
    .page-content { padding:0!important; }
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex align-items-center justify-content-between mb-4 btn-acciones">
    <div>
        <h4 class="mb-1 fw-bold"><?php echo e($reparacion->numero_orden); ?></h4>
        <p class="text-muted mb-0" style="font-size:13px;">
            Recibido el <?php echo e(optional($reparacion->fecha_recepcion)->format('d/m/Y H:i')); ?> ·
            Técnico: <strong><?php echo e($reparacion->tecnico->name ?? '—'); ?></strong>
        </p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?php echo e(route('reparaciones.ticket', $reparacion)); ?>" target="_blank" class="btn btn-outline-primary px-4">
            <i class="fas fa-receipt me-2"></i>Sticker 80mm
        </a>
        <button onclick="window.print()" class="btn btn-outline-secondary px-4">
            <i class="fas fa-print me-2"></i>Imprimir
        </button>
        <a href="<?php echo e(route('reparaciones.edit', $reparacion)); ?>" class="btn btn-primary px-4">
            <i class="fas fa-edit me-2"></i>Actualizar Estado
        </a>
    </div>
</div>

<div class="row g-4">
    
    <div class="col-lg-8">
        
        <div class="card mb-4">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-3"><i class="fas fa-mobile-alt me-2" style="color:#a855f7;"></i>Datos del Equipo</h6>
                <div class="row g-3" style="font-size:13.5px;">
                    <div class="col-md-3">
                        <span class="text-muted d-block" style="font-size:11px;">TIPO</span>
                        <strong><?php
                            $tipos = ['celular'=>'📱 Celular','tablet'=>'📟 Tablet','portatil'=>'💻 Portátil','otros'=>'🔧 Otros'];
                        ?>
                        <?php echo e($tipos[$reparacion->tipo_dispositivo] ?? $reparacion->tipo_dispositivo ?: '—'); ?></strong>
                    </div>
                    <div class="col-md-3">
                        <span class="text-muted d-block" style="font-size:11px;">DISPOSITIVO</span>
                        <strong><?php echo e($reparacion->dispositivo); ?></strong>
                    </div>
                    <div class="col-md-3">
                        <span class="text-muted d-block" style="font-size:11px;">🔐 PATRÓN / PIN</span>
                        <strong><?php
                            $tiposCodigo = ['patron'=>'🔓 Patrón','pin'=>'🔢 PIN'];
                            $tipoMostrar = $tiposCodigo[$reparacion->tipo_codigo] ?? '';
                        ?>
                        <?php if($reparacion->tipo_codigo === 'patron' && $reparacion->patron_secuencia): ?>
                            <?php echo e($tipoMostrar); ?>

                            <div style="display:flex; gap:2px; flex-wrap:wrap; max-width:130px; margin-top:4px;">
                                <?php for($i=1;$i<=9;$i++): ?>
                                    <?php
                                        $nums = explode('-', $reparacion->patron_secuencia);
                                        $pos = array_search($i, $nums);
                                        $esSeleccionado = $pos !== false;
                                    ?>
                                    <div style="width:30px; height:30px; border-radius:50%;
                                        <?php echo e($esSeleccionado ? 'background:linear-gradient(135deg,#a855f7,#ec4899);color:#fff;' : 'background:#f8f5ff;color:#a855f7;border:2px solid #a855f7;'); ?>

                                        display:flex; align-items:center; justify-content:center;
                                        font-size:11px; font-weight:600;">
                                        <?php echo e($esSeleccionado ? $pos + 1 : $i); ?>

                                    </div>
                                <?php endfor; ?>
                            </div>
                            <div style="font-size:10px; color:#6b7280; margin-top:2px;">Secuencia: <?php echo e($reparacion->patron_secuencia); ?></div>
                        <?php elseif($reparacion->tipo_codigo === 'pin'): ?>
                            <?php echo e($tipoMostrar); ?>: <?php echo e($reparacion->codigo_equipo ?: '—'); ?>

                        <?php else: ?>
                            —
                        <?php endif; ?>
                        </strong>
                    </div>
                    <div class="col-md-3">
                        <span class="text-muted d-block" style="font-size:11px;">MARCA / MODELO</span>
                        <strong><?php echo e($reparacion->marca ?: '—'); ?> <?php echo e($reparacion->modelo ? '/ '.$reparacion->modelo : ''); ?></strong>
                    </div>
                    <div class="col-md-3">
                        <span class="text-muted d-block" style="font-size:11px;">COLOR</span>
                        <strong><?php echo e($reparacion->color ?: '—'); ?></strong>
                    </div>
                    <?php if($reparacion->imei): ?>
                    <div class="col-md-3">
                        <span class="text-muted d-block" style="font-size:11px;">IMEI / SERIE</span>
                        <strong><?php echo e($reparacion->imei); ?></strong>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        
        <div class="card mb-4">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-3"><i class="fas fa-stethoscope me-2" style="color:#a855f7;"></i>Diagnóstico</h6>
                <div class="mb-3">
                    <div style="font-size:11px; color:#9ca3af; margin-bottom:4px;">FALLA REPORTADA POR EL CLIENTE</div>
                    <div class="p-3 rounded-3" style="background:#fef3c7; font-size:13.5px;">
                        <?php echo e($reparacion->falla_reportada); ?>

                    </div>
                </div>
                <?php if($reparacion->diagnostico): ?>
                <div class="mb-3">
                    <div style="font-size:11px; color:#9ca3af; margin-bottom:4px;">DIAGNÓSTICO TÉCNICO</div>
                    <div class="p-3 rounded-3" style="background:#e0f2fe; font-size:13.5px;">
                        <?php echo e($reparacion->diagnostico); ?>

                    </div>
                </div>
                <?php endif; ?>
                <?php if($reparacion->solucion): ?>
                <div>
                    <div style="font-size:11px; color:#9ca3af; margin-bottom:4px;">SOLUCIÓN APLICADA</div>
                    <div class="p-3 rounded-3" style="background:#d1fae5; font-size:13.5px;">
                        <?php echo e($reparacion->solucion); ?>

                    </div>
                </div>
                <?php endif; ?>
                <?php if($reparacion->notas): ?>
                <div class="mt-3 p-3 rounded-3" style="background:#f9fafb; font-size:13px; color:#6b7280;">
                    <i class="fas fa-sticky-note me-1"></i><?php echo e($reparacion->notas); ?>

                </div>
                <?php endif; ?>
            </div>
        </div>

        
        <div class="card">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-3"><i class="fas fa-dollar-sign me-2" style="color:#a855f7;"></i>Costos</h6>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="p-3 rounded-3" style="background:#f8f5ff; text-align:center;">
                            <div style="font-size:11px; color:#9ca3af; margin-bottom:4px;">PRESUPUESTO</div>
                            <div style="font-size:24px; font-weight:700; color:#7c3aed;">
                                S/ <?php echo e($reparacion->presupuesto ? number_format($reparacion->presupuesto, 2) : '0.00'); ?>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 rounded-3" style="background:#d1fae5; text-align:center;">
                            <div style="font-size:11px; color:#065f46; margin-bottom:4px;">COSTO FINAL</div>
                            <div style="font-size:24px; font-weight:700; color:#059669;">
                                S/ <?php echo e($reparacion->costo_final ? number_format($reparacion->costo_final, 2) : '0.00'); ?>

                            </div>
                        </div>
                    </div>
                    <?php if($reparacion->abono > 0): ?>
                    <div class="col-md-6">
                        <div class="p-3 rounded-3" style="background:#fef3c7; text-align:center;">
                            <div style="font-size:11px; color:#92400e; margin-bottom:4px;">ABONO RECIBIDO</div>
                            <div style="font-size:20px; font-weight:700; color:#92400e;">
                                S/ <?php echo e(number_format($reparacion->abono, 2)); ?>

                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if($reparacion->total > 0): ?>
                    <div class="col-md-6">
                        <div class="p-3 rounded-3" style="background:#fef3c7; text-align:center;">
                            <div style="font-size:11px; color:#92400e; margin-bottom:4px;">TOTAL</div>
                            <div style="font-size:20px; font-weight:700; color:#92400e;">
                                S/ <?php echo e(number_format($reparacion->total, 2)); ?>

                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if($reparacion->garantia): ?>
                    <div class="col-12">
                        <div class="p-3 rounded-3 d-flex align-items-center gap-3" style="background:#e0f2fe;">
                            <i class="fas fa-shield-alt" style="color:#0369a1; font-size:20px;"></i>
                            <div>
                                <div style="font-weight:600; color:#0369a1;">Garantía incluida</div>
                                <div style="font-size:12px; color:#0369a1;"><?php echo e($reparacion->dias_garantia); ?> días de garantía</div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-4">
        
        <div class="card mb-3">
            <div class="card-body p-4">
                
                <?php
                    $stColors = ['recibido'=>['#ede9fe','#6d28d9'],'en_diagnostico'=>['#e0f2fe','#0369a1'],'esperando_repuesto'=>['#fef9c3','#92400e'],'en_reparacion'=>['#dbeafe','#1d4ed8'],'listo'=>['#d1fae5','#065f46'],'entregado'=>['#f3f4f6','#374151'],'no_reparable'=>['#fee2e2','#991b1b']];
                    $sc = $stColors[$reparacion->estado] ?? ['#f3f4f6','#374151'];
                    $priCol = ['urgente'=>['#fee2e2','#991b1b','🔴'],'alta'=>['#ffedd5','#9a3412','🟠'],'media'=>['#fef9c3','#713f12','🟡'],'baja'=>['#d1fae5','#065f46','🟢']];
                    $pr = $priCol[$reparacion->prioridad] ?? ['#f3f4f6','#374151','⚪'];
                ?>

                <div class="text-center mb-3">
                    <span style="background:<?php echo e($sc[0]); ?>; color:<?php echo e($sc[1]); ?>; border-radius:20px; padding:8px 20px; font-size:13px; font-weight:600; display:inline-block;">
                        <?php echo e(str_replace('_',' ',ucfirst($reparacion->estado))); ?>

                    </span>
                </div>

                <div class="d-flex justify-content-between mb-2" style="font-size:13px;">
                    <span class="text-muted">Prioridad</span>
                    <span style="background:<?php echo e($pr[0]); ?>; color:<?php echo e($pr[1]); ?>; border-radius:20px; padding:2px 10px; font-size:12px;">
                        <?php echo e($pr[2]); ?> <?php echo e(ucfirst($reparacion->prioridad)); ?>

                    </span>
                </div>
                <div class="d-flex justify-content-between mb-2" style="font-size:13px;">
                    <span class="text-muted">Recibido</span>
                    <span><?php echo e(optional($reparacion->fecha_recepcion)->format('d/m/Y')); ?></span>
                </div>
                <?php if($reparacion->fecha_estimada): ?>
                <div class="d-flex justify-content-between mb-2" style="font-size:13px;">
                    <span class="text-muted">Fecha estimada</span>
                    <span><?php echo e($reparacion->fecha_estimada->format('d/m/Y')); ?></span>
                </div>
                <?php endif; ?>
                <?php if($reparacion->fecha_entrega): ?>
                <div class="d-flex justify-content-between mb-2" style="font-size:13px;">
                    <span class="text-muted">Entregado</span>
                    <span style="color:#059669; font-weight:600;"><?php echo e($reparacion->fecha_entrega->format('d/m/Y')); ?></span>
                </div>
                <?php endif; ?>

                <hr>
                <h6 class="fw-bold mb-2" style="font-size:13px;">Cliente</h6>
                <div style="font-weight:600; font-size:13.5px;"><?php echo e($reparacion->cliente->nombre_completo ?? '—'); ?></div>
                <div style="font-size:12px; color:#9ca3af;"><?php echo e($reparacion->cliente->telefono ?? ''); ?></div>
                <?php if($reparacion->cliente->email): ?>
                    <div style="font-size:12px; color:#9ca3af;"><?php echo e($reparacion->cliente->email); ?></div>
                <?php endif; ?>

                <div class="mt-3 d-grid gap-2">
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
                    <div class="d-grid gap-1">
                        <a href="<?php echo e($urlRecibido); ?>" target="_blank"
                           class="btn btn-sm" style="background:#25D366; color:#fff; border-radius:8px;">
                            <i class="fab fa-whatsapp me-1"></i>📩 Notificar Recibido
                        </a>
                        <a href="<?php echo e($urlListo); ?>" target="_blank"
                           class="btn btn-sm" style="background:#25D366; color:#fff; border-radius:8px;">
                            <i class="fab fa-whatsapp me-1"></i>📩 Notificar Listo/Entregado
                        </a>
                    </div>
                    <?php endif; ?>
                    <a href="<?php echo e(route('reparaciones.edit', $reparacion)); ?>" class="btn btn-primary btn-sm">
                        <i class="fas fa-edit me-1"></i>Actualizar Estado
                    </a>
                    <a href="<?php echo e(route('clientes.show', $reparacion->cliente_id)); ?>" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-user me-1"></i>Ver Cliente
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\crm-gestion-tienda-celulares\resources\views/reparaciones/show.blade.php ENDPATH**/ ?>