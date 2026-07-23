<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Configuracion;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ConfiguracionController extends Controller
{
    // ── Vista principal ─────────────────────────────────────────────────
    public function index()
    {
        $usuarios = User::where('rol', '!=', 'superadmin')->orderBy('rol')->orderBy('name')->get();
        $empresa  = Configuracion::empresa();
        return view('configuracion.index', compact('usuarios', 'empresa'));
    }

    // ── Guardar / Actualizar datos de la empresa ───────────────────────
    public function updateEmpresa(Request $request)
    {
        $validated = $request->validate([
            'nombre_tienda' => 'required|string|max:255',
            'ruc'           => 'nullable|string|max:20',
            'direccion'     => 'nullable|string|max:500',
            'telefono'      => 'nullable|string|max:20',
            'whatsapp'      => 'nullable|string|max:20',
            'email'         => 'nullable|email|max:255',
            'igv'           => 'required|numeric|min:0|max:100',
            'moneda'        => 'required|string|max:10',
            'simbolo_moneda'=> 'required|string|max:5',
            'terminos_garantia' => 'nullable|string|max:1000',
        ]);

        $data = $validated;

        // Subir logo si se envió uno nuevo
        if ($request->hasFile('logo')) {
            $request->validate([
                'logo' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            ]);

            $logoPath = $request->file('logo')->store('logos', 'public');
            $data['logo'] = 'storage/' . $logoPath;
        }

        $empresa = Configuracion::empresa();

        if ($empresa) {
            // Eliminar logo anterior si se reemplaza
            if ($request->hasFile('logo') && $empresa->logo) {
                $oldPath = str_replace('storage/', '', $empresa->logo);
                Storage::disk('public')->delete($oldPath);
            }
            $empresa->update($data);
        } else {
            // Crear nuevo registro
            Configuracion::create($data);
        }

        return back()->with('success', 'Datos de la empresa actualizados correctamente.');
    }

    // ── Usuarios ───────────────────────────────────────────────────────
    public function storeUsuario(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'rol'      => 'required|in:admin,vendedor,tecnico',
            'telefono' => 'nullable|string|max:20',
        ]);

        // Verificar límite de usuarios del plan
        $tenant = auth()->user()->tenant;
        if ($tenant && !$tenant->puedeAgregarUsuario()) {
            return back()->with('error', 'Has alcanzado el límite de usuarios de tu plan (' . $tenant->max_usuarios . ').');
        }

        User::create([
            'name'      => $validated['name'],
            'email'     => $validated['email'],
            'password'  => Hash::make($validated['password']),
            'rol'       => $validated['rol'],
            'telefono'  => $validated['telefono'] ?? null,
            'tenant_id' => auth()->user()->tenant_id,
        ]);

        return back()->with('success', 'Usuario creado correctamente.');
    }

    public function updateUsuario(Request $request, User $usuario)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email,' . $usuario->id,
            'rol'      => 'required|in:admin,vendedor,tecnico',
            'telefono' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $data = [
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'rol'      => $validated['rol'],
            'telefono' => $validated['telefono'] ?? null,
        ];

        if (!empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        $usuario->update($data);
        return back()->with('success', 'Usuario actualizado correctamente.');
    }

    public function toggleUsuario(User $usuario)
    {
        if ($usuario->id === auth()->id()) {
            return back()->with('error', 'No puedes desactivar tu propia cuenta.');
        }
        $usuario->update(['activo' => !$usuario->activo]);
        $estado = $usuario->activo ? 'activado' : 'desactivado';
        return back()->with('success', "Usuario {$estado} correctamente.");
    }

    public function destroyUsuario(User $usuario)
    {
        if ($usuario->id === auth()->id()) {
            return back()->with('error', 'No puedes eliminar tu propia cuenta.');
        }
        $usuario->delete();
        return back()->with('success', 'Usuario eliminado correctamente.');
    }
}