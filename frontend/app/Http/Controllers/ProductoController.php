<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductoController extends Controller
{
    // URL base de nuestra API
    private $apiUrl;

    public function __construct()
    {
        $this->apiUrl = env('API_BACKEND_URL', 'http://localhost:8080/api');
    }

    // 1. LISTAR (GET)
    public function index()
    {
        $response = Http::get($this->apiUrl . '/productos');
        $productos = $response->successful() ? $response->json() : [];
        
        return view('productos.index', compact('productos'));
    }

    // 2. MOSTRAR FORMULARIO DE CREAR
    public function create()
    {
        return view('productos.create');
    }

    // 3. GUARDAR NUEVO (POST)
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'proveedor' => 'required',
            'fechaVencimiento' => 'required|date',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        Http::post($this->apiUrl . '/productos', [
            'nombre' => $request->nombre,
            'proveedor' => $request->proveedor,
            'fechaVencimiento' => $request->fechaVencimiento,
            'precio' => $request->precio,
            'stock' => $request->stock,
        ]);

        return redirect()->route('productos.index')->with('success', 'Producto creado exitosamente.');
    }

    // 4. MOSTRAR FORMULARIO DE EDITAR
    public function edit($id)
    {
        $response = Http::get($this->apiUrl . '/productos/' . $id);
        
        if ($response->failed()) {
            return redirect()->route('productos.index')->with('error', 'Producto no encontrado.');
        }

        $producto = $response->json();
        return view('productos.edit', compact('producto'));
    }

    // 5. ACTUALIZAR (PUT)
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'proveedor' => 'required',
            'fechaVencimiento' => 'required|date',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        Http::put($this->apiUrl . '/productos/' . $id, [
            'nombre' => $request->nombre,
            'proveedor' => $request->proveedor,
            'fechaVencimiento' => $request->fechaVencimiento,
            'precio' => $request->precio,
            'stock' => $request->stock,
        ]);

        return redirect()->route('productos.index')->with('success', 'Producto actualizado.');
    }

    // 6. ELIMINAR LÓGICAMENTE (DELETE)
    public function destroy($id)
    {
        Http::delete($this->apiUrl . '/productos/' . $id);
        return redirect()->route('productos.index')->with('success', 'Producto eliminado.');
    }
}