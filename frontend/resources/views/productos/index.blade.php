<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Productos - Minimarket</title>
    <!-- Usamos Tailwind CSS para que se vea bonito -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10">
    <div class="max-w-6xl mx-auto bg-white p-6 rounded-lg shadow">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Productos Activos</h1>
            <a href="{{ route('productos.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Nuevo Producto</a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
        @endif

        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-200 text-gray-700">
                    <th class="p-3 border">ID</th>
                    <th class="p-3 border">Nombre</th>
                    <th class="p-3 border">Proveedor</th>
                    <th class="p-3 border">Vencimiento</th>
                    <th class="p-3 border">Precio</th>
                    <th class="p-3 border">Stock</th>
                    <th class="p-3 border">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productos as $prod)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3">{{ $prod['id'] }}</td>
                    <td class="p-3">{{ $prod['nombre'] }}</td>
                    <td class="p-3">{{ $prod['proveedor'] }}</td>
                    <td class="p-3">{{ $prod['fechaVencimiento'] }}</td>
                    <td class="p-3">S/ {{ number_format($prod['precio'], 2) }}</td>
                    <td class="p-3">{{ $prod['stock'] }}</td>
                    <td class="p-3 flex gap-2">
                        <a href="{{ route('productos.edit', $prod['id']) }}" class="bg-yellow-500 text-white px-3 py-1 rounded text-sm hover:bg-yellow-600">Editar</a>
                        
                        <form action="{{ route('productos.destroy', $prod['id']) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este producto?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                
                @if(count($productos) === 0)
                <tr>
                    <td colspan="7" class="text-center p-5 text-gray-500">No hay productos activos.</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</body>
</html>