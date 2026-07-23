<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AppDownloadController extends Controller
{
    public function index()
    {
        return view('app-download');
    }

    public function download(Request $request)
    {
        $url = url('/'); // URL del sitio
        $packageName = 'com.crmcelulares.app';
        $appName = 'CRM Celulares';
        
        // Usar la API de PWABuilder para generar el APK
        try {
            $response = Http::timeout(120)->post('https://pwabuilder.com/api/v1/build', [
                'url' => $url,
                'packageId' => $packageName,
                'appName' => $appName,
                'appVersion' => '1.0.0',
                'signing' => [
                    'alias' => 'crmcelulares',
                    'password' => 'CrmCel2024!',
                    'validity' => '3650',
                    'dname' => 'CN=CRM Celulares, OU=Development, O=CRM Celulares, L=Lima, ST=Lima, C=PE'
                ]
            ]);

            if ($response->successful()) {
                $data = $response->json();
                if (isset($data['url'])) {
                    return redirect($data['url']);
                }
            }
        } catch (\Exception $e) {
            // Si falla la API, redirigir a PWABuilder manual
        }

        // Fallback: redirigir a PWABuilder
        return redirect('https://pwabuilder.com/create?url=' . urlencode($url));
    }
}