<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', '产品管理系统')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-4">
            <div class="flex flex-wrap justify-between items-center">
                <a href="{{ route('dashboard') }}" class="text-xl font-bold text-gray-800">产品管理系统</a>
                <div class="flex flex-wrap items-center">
                    <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-gray-800 mx-2 my-1">仪表板</a>
                    <a href="{{ route('products.index') }}" class="text-gray-600 hover:text-gray-800 mx-2 my-1">产品管理</a>
                    <a href="{{ route('categories.index') }}" class="text-gray-600 hover:text-gray-800 mx-2 my-1">类别管理</a>
                    <a href="{{ route('brands.index') }}" class="text-gray-600 hover:text-gray-800 mx-2 my-1">品牌管理</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-4 py-8">
        @yield('content')
    </main>

    <footer class="bg-white shadow-md mt-8">
        <div class="container mx-auto px-4 py-4">
            <p class="text-center text-gray-600">&copy; 2023 产品管理系统. 保留所有权利。</p>
        </div>
    </footer>
</body>
</html>