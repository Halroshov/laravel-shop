@extends('layouts.app')

@section('title', '产品详情：' . $product->name)

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">产品详情：{{ $product->name }}</h1>

    <div class="max-w-2xl mx-auto">
        @if($product->images->isNotEmpty())
            <div class="mb-6">
                <img src="{{ asset('storage/' . $product->images->first()->image_url) }}" alt="{{ $product->name }}" class="w-full h-auto">
            </div>
        @endif

        <div class="mb-4">
            <span class="font-bold">名称：</span> {{ $product->name }}
        </div>

        <div class="mb-4">
            <span class="font-bold">描述：</span> {{ $product->description }}
        </div>

        <div class="mb-4">
            <span class="font-bold">价格：</span> ￥{{ number_format($product->price, 2) }}
        </div>

        <div class="mb-4">
            <span class="font-bold">类别：</span> {{ $product->category->name }}
        </div>

        <div class="mb-4">
            <span class="font-bold">品牌：</span> {{ $product->brand->name }}
        </div>

        <div class="mb-4">
            <span class="font-bold">库存数量：</span> {{ $product->stock->quantity }}
        </div>

        <div class="mt-8 flex space-x-4">
            <a href="{{ route('products.edit', $product->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">编辑</a>
            <a href="{{ route('products.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">返回列表</a>
            
            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('确定要删除这个产品吗？');">删除</button>
            </form>
        </div>
    </div>
</div>
@endsection