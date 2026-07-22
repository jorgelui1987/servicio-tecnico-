<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Ticket <?php echo e($venta->numero_venta); ?></title>
<style>
*{margin:0;padding:0}
body{font-family:'Lucida Console','Courier New',monospace;font-size:11px;line-height:1.3;color:#000;width:72mm;
    -webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;text-rendering:optimizeLegibility}
@page{size:80mm auto;margin:2mm}
.hdr{text-align:center}
.hdr .tienda{font-size:13px;font-weight:700;letter-spacing:-0.3px}
.hdr .inf{font-size:9px;letter-spacing:-0.2px}
.hdr .nro{font-size:14px;font-weight:700;letter-spacing:0.5px}
.det{font-size:11px}
.det .etq{font-size:8px;font-weight:700}
.prod{width:100%;border-collapse:collapse;font-size:10px}
.prod th{font-size:8px;text-align:left;font-weight:700;border-bottom:1.5px solid #000;text-transform:uppercase}
.prod th.c,.prod td.c{text-align:center}
.prod th.p,.prod td.p{text-align:right}
.prod td{padding:1px 0;vertical-align:top}
.prod td.n{font-weight:700;font-size:11px}
.prod td.d{font-size:8px;color:#555}
.tot .l{display:flex;justify-content:space-between;font-size:10px}
.tot .lt{display:flex;justify-content:space-between;font-weight:700;font-size:13px;border-top:1.5px solid #000;border-bottom:1.5px solid #000;padding:2px 0}
.not{font-size:9px}
.section{font-weight:700;margin-top:2px;font-size:10px}
.ftr{text-align:center;margin-top:2px;font-size:9px}
.ftr .gr{font-size:10px;font-weight:700}
hr{border:none;border-top:1.5px solid #000;margin:1px 0}

@media print{
    body{-webkit-print-color-adjust:exact;print-color-adjust:exact}
}
</style>
<body>
<div class="hdr">
<?php if($empresa && $empresa->logo): ?><img src="<?php echo e(asset($empresa->logo)); ?>" alt="" style="max-height:18px;max-width:35px"><?php endif; ?>
<div class="tienda"><?php echo e($empresa->nombre_tienda ?? 'CRM Celulares'); ?></div>
<div class="inf"><?php echo e($empresa->ruc ?? ''); ?><?php echo e(($empresa->ruc??'') && ($empresa->direccion??'') ? ' | ' : ''); ?><?php echo e($empresa->direccion ?? ''); ?></div>
<div class="inf"><?php echo e($empresa->telefono ?? ''); ?><?php echo e(($empresa->telefono??'') && ($empresa->email??'') ? ' | ' : ''); ?><?php echo e($empresa->email ?? ''); ?></div>
<div class="nro"><?php echo e($venta->numero_venta); ?></div>
<div><?php echo e(ucfirst($venta->estado)); ?> | <?php echo e($venta->fecha_venta->format('d/m/Y H:i')); ?></div>
</div>
<hr>
<div class="det"><span class="etq">CLIENTE </span><?php echo e($venta->cliente->nombre_completo ?? 'VENTA GENERAL'); ?><?php echo e($venta->cliente && $venta->cliente->telefono ? ' T:'.$venta->cliente->telefono : ''); ?><?php echo e($venta->cliente && $venta->cliente->email ? ' E:'.$venta->cliente->email : ''); ?></div>
<div class="det"><span class="etq">PAGO </span><?php echo e(ucfirst($venta->metodo_pago)); ?> | <?php echo e($venta->vendedor->name ?? '—'); ?></div>
<hr>
<table class="prod">
<thead><tr><th>Producto</th><th class="c">Cant</th><th class="p">P.U.</th><th class="p">Subt.</th></tr></thead>
<tbody>
<?php $__currentLoopData = $venta->detalles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $det): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
<td>
<span class="n"><?php echo e($det->producto->nombre ?? '—'); ?></span>
<?php if($det->producto && $det->producto->marca): ?><span class="d"> <?php echo e($det->producto->marca->nombre); ?></span><?php endif; ?>
<?php if($det->imei_vendido): ?><span class="d"> IMEI:<?php echo e($det->imei_vendido); ?></span><?php endif; ?>
<?php if($det->descuento > 0): ?><span class="d"> Desc:-S/<?php echo e(number_format($det->descuento,2)); ?></span><?php endif; ?>
</td>
<td class="c"><?php echo e($det->cantidad); ?></td>
<td class="p"><?php echo e(number_format($det->precio_unitario,2)); ?></td>
<td class="p"><?php echo e(number_format($det->subtotal,2)); ?></td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>
</table>
<div class="tot">
<div class="l"><span>Subtotal</span><span>S/ <?php echo e(number_format($venta->subtotal,2)); ?></span></div>
<?php if($venta->descuento > 0): ?><div class="l"><span>Descuento</span><span>-S/ <?php echo e(number_format($venta->descuento,2)); ?></span></div><?php endif; ?>
<div class="l"><span>IGV (18%)</span><span>S/ <?php echo e(number_format($venta->impuesto,2)); ?></span></div>
<div class="lt"><span>TOTAL</span><span>S/ <?php echo e(number_format($venta->total,2)); ?></span></div>
</div>
<?php if($venta->notas): ?><div class="not">Notas: <?php echo e($venta->notas); ?></div><?php endif; ?>
<?php if($empresa && $empresa->terminos_garantia): ?>
<hr>
<div class="section">GARANTÍA</div>
<div style="font-size:11px;font-weight:700;text-align:justify;"><?php echo e($empresa->terminos_garantia); ?></div>
<?php endif; ?>
<div class="ftr">
<div class="gr">Gracias por su preferencia!</div>
<div><?php echo e($venta->created_at->format('d/m/Y H:i')); ?></div>
</div>
<script>window.onload=function(){window.print()};window.onafterprint=function(){window.close()};</script>
</body>
</html>
<?php /**PATH C:\laragon\www\crm-gestion-tienda-celulares\resources\views/ventas/ticket.blade.php ENDPATH**/ ?>