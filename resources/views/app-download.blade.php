<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Descargar App - CRM Celulares</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #1a0a3e 0%, #2d1b69 50%, #4c1d95 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .download-card {
            background: #fff;
            border-radius: 24px;
            padding: 48px 40px;
            max-width: 500px;
            width: 100%;
            box-shadow: 0 25px 60px rgba(0,0,0,.4);
            text-align: center;
        }
        .app-icon {
            width: 90px;
            height: 90px;
            background: linear-gradient(135deg, #a855f7, #ec4899);
            border-radius: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 42px;
            margin: 0 auto 16px;
            color: #fff;
        }
        h2 { font-weight: 700; color: #1e1b4b; font-size: 22px; }
        p.subtitle { color: #6b7280; font-size: 14px; margin-bottom: 28px; }
        .btn-download {
            background: linear-gradient(135deg, #a855f7, #ec4899);
            border: none;
            border-radius: 14px;
            padding: 14px;
            font-size: 16px;
            font-weight: 600;
            color: #fff;
            width: 100%;
            cursor: pointer;
            transition: all .3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        .btn-download:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(168,85,247,.4);
            color: #fff;
        }
        .btn-download:disabled {
            opacity: .6;
            cursor: not-allowed;
            transform: none;
        }
        .step {
            display: flex;
            align-items: center;
            gap: 14px;
            text-align: left;
            padding: 12px 16px;
            background: #f9fafb;
            border-radius: 12px;
            margin-bottom: 10px;
        }
        .step-number {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, #a855f7, #ec4899);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 700;
            font-size: 14px;
            flex-shrink: 0;
        }
        .step-text { font-size: 13px; color: #374151; }
        .step-text strong { color: #1e1b4b; }
        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 24px 0;
            color: #9ca3af;
            font-size: 12px;
        }
        .divider::before, .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e5e7eb;
        }
        .loading-spinner {
            display: none;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255,255,255,.3);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin .8s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }
        .btn-download.loading .loading-spinner { display: inline-block; }
        .btn-download.loading .btn-text { display: none; }
    </style>
</head>
<body>
    <div class="download-card">
        <div class="app-icon">📱</div>
        <h2>CRM Celulares</h2>
        <p class="subtitle">Descarga la app para gestionar tu tienda desde tu celular</p>

        @if(session('error'))
            <div class="alert alert-danger d-flex align-items-center gap-2 mb-3" style="border-radius:12px;font-size:13px;">
                <i class="bi bi-exclamation-circle"></i>
                {{ session('error') }}
            </div>
        @endif

        <a href="{{ route('app.download') }}" class="btn-download" id="downloadBtn">
            <i class="bi bi-phone"></i>
            <span class="btn-text">Descargar App Android</span>
            <span class="loading-spinner"></span>
        </a>

        <div class="divider">o</div>

        <div style="font-size:13px;color:#6b7280;margin-bottom:16px;">
            <strong>Instalación directa desde el navegador:</strong>
        </div>

        <div class="step">
            <div class="step-number">1</div>
            <div class="step-text">Abre el CRM en <strong>Chrome</strong> desde tu celular</div>
        </div>
        <div class="step">
            <div class="step-number">2</div>
            <div class="step-text">Toca el menú <strong>3 puntitos</strong> → <strong>"Agregar a pantalla de inicio"</strong></div>
        </div>
        <div class="step">
            <div class="step-number">3</div>
            <div class="step-text">Confirma y tendrás la app en tu pantalla <strong>sin descargar nada</strong></div>
        </div>

        <div class="mt-4" style="font-size:12px;color:#9ca3af;">
            <i class="bi bi-shield-check me-1"></i> App segura · Sin anuncios · Actualizaciones automáticas
        </div>

        <div class="mt-3">
            <a href="{{ url('/') }}" style="font-size:13px;color:#a855f7;text-decoration:none;">
                <i class="bi bi-arrow-left me-1"></i> Volver al inicio
            </a>
        </div>
    </div>

    <script>
        document.getElementById('downloadBtn').addEventListener('click', function(e) {
            this.classList.add('loading');
            // El enlace sigue funcionando normalmente
        });
    </script>
</body>
</html>