@extends('layouts.app')

@section('title', '编辑产品：' . $product->name)

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">编辑产品：{{ $product->name }}</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="max-w-lg mx-auto">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">名称：</label>
            <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">描述：</label>
            <textarea id="description" name="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="mb-4">
            <label for="price" class="block text-gray-700 text-sm font-bold mb-2">价格：</label>
            <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}" step="0.01" max="9999999.99" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label for="category_id" class="block text-gray-700 text-sm font-bold mb-2">类别：</label>
            <select id="category_id" name="category_id" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="">选择类别</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="brand_id" class="block text-gray-700 text-sm font-bold mb-2">品牌：</label>
            <select id="brand_id" name="brand_id" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="">选择品牌</option>
                @foreach($brands as $brand)
                    <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>
                        {{ $brand->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="quantity" class="block text-gray-700 text-sm font-bold mb-2">库存数量：</label>
            <input type="number" id="quantity" name="quantity" value="{{ old('quantity', $product->stock->quantity) }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label for="image" class="block text-gray-700 text-sm font-bold mb-2">产品图片：</label>
            <input type="file" id="image" name="image" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @if($product->images->isNotEmpty())
                <p class="mt-2 text-sm text-gray-600">当前图片: {{ $product->images->first()->image_url }}</p>
            @endif
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                更新产品
            </button>
            <a href="{{ route('products.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                返回产品列表
            </a>
        </div>
    </form>
</div>
@endsection