<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppDownloadController extends Controller
{
    public function index()
    {
        return view('app-download');
    }

    public function download(Request $request)
    {
        $url = url('/');
        // Redirigir a PWABuilder para generar el APK
        return redirect('https://pwabuilder.com/create?url=' . urlencode($url));
    }
}
