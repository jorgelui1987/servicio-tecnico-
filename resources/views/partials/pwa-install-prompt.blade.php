<!-- PWA Install Prompt -->
<div id="pwa-install-prompt" class="d-none" style="position:fixed;bottom:20px;left:20px;right:20px;z-index:9999;max-width:400px;margin:0 auto;">
    <div class="card shadow-lg border-0" style="border-radius:16px;background:linear-gradient(135deg,#1a0a3e,#2d1b69);">
        <div class="card-body p-3">
            <div class="d-flex align-items-center gap-3">
                <div style="width:50px;height:50px;background:linear-gradient(135deg,#a855f7,#ec4899);border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:24px;flex-shrink:0;">
                    📱
                </div>
                <div class="flex-grow-1">
                    <h6 class="text-white mb-0" style="font-size:14px;font-weight:600;">Instala la app</h6>
                    <p class="text-white-50 mb-0" style="font-size:12px;">Accede rápido desde tu celular</p>
                </div>
                <button id="pwa-install-btn" class="btn btn-sm px-3" style="background:linear-gradient(135deg,#a855f7,#ec4899);color:#fff;border-radius:20px;font-size:12px;font-weight:600;white-space:nowrap;">
                    Instalar
                </button>
                <button id="pwa-close-btn" class="btn btn-sm" style="color:rgba(255,255,255,0.5);border:none;background:transparent;font-size:18px;line-height:1;">×</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let deferredPrompt = null;
    const installPrompt = document.getElementById('pwa-install-prompt');
    const installBtn = document.getElementById('pwa-install-btn');
    const closeBtn = document.getElementById('pwa-close-btn');

    // Mostrar banner si viene de registro exitoso
    @if(session('pwa_install'))
        installPrompt.classList.remove('d-none');
    @endif

    // Escuchar evento beforeinstallprompt
    window.addEventListener('beforeinstallprompt', (e) => {
        e.preventDefault();
        deferredPrompt = e;
        // Mostrar banner si no se ha cerrado antes
        if (!localStorage.getItem('pwa-closed')) {
            installPrompt.classList.remove('d-none');
        }
    });

    // Botón instalar
    if (installBtn) {
        installBtn.addEventListener('click', async () => {
            if (deferredPrompt) {
                deferredPrompt.prompt();
                const result = await deferredPrompt.userChoice;
                if (result.outcome === 'accepted') {
                    console.log('PWA instalada');
                    installPrompt.classList.add('d-none');
                }
                deferredPrompt = null;
            } else {
                // Si no hay evento, mostrar instrucciones
                alert('Para instalar: abre el menú de Chrome (3 puntitos) → "Agregar a pantalla de inicio"');
            }
        });
    }

    // Botón cerrar
    if (closeBtn) {
        closeBtn.addEventListener('click', () => {
            installPrompt.classList.add('d-none');
            localStorage.setItem('pwa-closed', 'true');
        });
    }

    // Si el usuario ya instaló la PWA, ocultar
    window.addEventListener('appinstalled', () => {
        installPrompt.classList.add('d-none');
        localStorage.removeItem('pwa-closed');
        console.log('PWA instalada exitosamente');
    });
});
</script>