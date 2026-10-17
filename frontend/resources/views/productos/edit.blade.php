<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10">
    <div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow">
        <h1 class="text-2xl font-bold mb-4">Editar Producto</h1>
        
        <form action="{{ route('productos.update', $producto['id']) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-gray-700">Nombre:</label>
                <input type="text" name="nombre" value="{{ $producto['nombre'] }}" class="w-full border p-2 rounded" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Proveedor:</label>
                <input type="text" name="proveedor" value="{{ $producto['proveedor'] }}" class="w-full border p-2 rounded" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Fecha Vencimiento:</label>
                <input type="date" name="fechaVencimiento" value="{{ $producto['fechaVencimiento'] }}" class="w-full border p-2 rounded" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Precio:</label>
                <input type="number" step="0.01" name="precio" value="{{ $producto['precio'] }}" class="w-full border p-2 rounded" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Stock:</label>
                <input type="number" name="stock" value="{{ $producto['stock'] }}" class="w-full border p-2 rounded" required>
            </div>
            <div class="flex justify-between">
                <a href="{{ route('productos.index') }}" class="text-gray-500 hover:underline mt-2">Cancelar</a>
                <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Actualizar</button>
            </div>
        </form>
    </div>
</body>
</html>