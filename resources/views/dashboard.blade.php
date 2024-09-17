@extends('layouts.app')

@section('title', '产品管理仪表板')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">产品管理仪表板</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-xl font-semibold mb-2">总产品数</h2>
            <p class="text-3xl font-bold">{{ $totalProducts }}</p>
        </div>
        <!-- 如果需要，在这里添加更多摘要卡片 -->
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-xl font-semibold mb-4">最新产品</h2>
            <ul>
                @foreach($latestProducts as $product)
                    <li class="mb-2">
                        <a href="{{ route('products.show', $product) }}" class="text-blue-600 hover:underline">{{ $product->name }}</a>
                        <span class="text-gray-500 text-sm">￥{{ number_format($product->price, 2) }}</span>
                    </li>
                @endforeach
            </ul>
            <a href="{{ route('products.index') }}" class="mt-4 inline-block text-blue-600 hover:underline">查看所有产品</a>
        </div>

        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-xl font-semibold mb-4">快速操作</h2>
            <a href="{{ route('products.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 inline-block mb-2">添加新产品</a>
            <a href="{{ route('products.index') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 inline-block">管理产品</a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-xl font-semibold mb-4">类别</h2>
            <ul>
                @foreach($categories as $category)
                    <li class="mb-2">{{ $category->name }} <span class="text-gray-500">({{ $category->products_count }} 个产品)</span></li>
                @endforeach
            </ul>
        </div>

        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-xl font-semibold mb-4">品牌</h2>
            <ul>
                @foreach($brands as $brand)
                    <li class="mb-2">{{ $brand->name }} <span class="text-gray-500">({{ $brand->products_count }} 个产品)</span></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection