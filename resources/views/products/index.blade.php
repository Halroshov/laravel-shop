@extends('layouts.app')

@section('title', '产品列表')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">产品列表</h1>

    <div class="mb-4">
        <a href="{{ route('products.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 inline-block">添加新产品</a>
    </div>

    @if($products->isEmpty())
        <p class="text-gray-600">暂无产品</p>
    @else
        <div class="bg-white shadow-md rounded my-6">
            <table class="text-left w-full border-collapse">
                <thead>
                    <tr>
                        <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">名称</th>
                        <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">价格</th>
                        <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">类别</th>
                        <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">品牌</th>
                        <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">库存</th>
                        <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr class="hover:bg-grey-lighter">
                            <td class="py-4 px-6 border-b border-grey-light">{{ $product->name }}</td>
                            <td class="py-4 px-6 border-b border-grey-light">￥{{ number_format($product->price, 2) }}</td>
                            <td class="py-4 px-6 border-b border-grey-light">{{ $product->category->name }}</td>
                            <td class="py-4 px-6 border-b border-grey-light">{{ $product->brand->name }}</td>
                            <td class="py-4 px-6 border-b border-grey-light">{{ $product->stock->quantity }}</td>
                            <td class="py-4 px-6 border-b border-grey-light">
                                <a href="{{ route('products.show', $product->id) }}" class="text-blue-600 hover:text-blue-900 mr-2">查看</a>
                                <a href="{{ route('products.edit', $product->id) }}" class="text-green-600 hover:text-green-900 mr-2">编辑</a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('确定要删除这个产品吗？')">删除</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="mt-4">
            @if ($products->hasPages())
                <nav role="navigation" aria-label="分页导航" class="flex items-center justify-between">
                    <div class="flex justify-between flex-1 sm:hidden">
                        @if ($products->onFirstPage())
                            <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
                                上一页
                            </span>
                        @else
                            <a href="{{ $products->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                                上一页
                            </a>
                        @endif

                        @if ($products->hasMorePages())
                            <a href="{{ $products->nextPageUrl() }}" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                                下一页
                            </a>
                        @else
                            <span class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
                                下一页
                            </span>
                        @endif
                    </div>

                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700 leading-5">
                                显示第
                                <span class="font-medium">{{ $products->firstItem() }}</span>
                                到第
                                <span class="font-medium">{{ $products->lastItem() }}</span>
                                条，共
                                <span class="font-medium">{{ $products->total() }}</span>
                                条结果
                            </p>
                        </div>

                        <div>
                            {{ $products->links() }}
                        </div>
                    </div>
                </nav>
            @endif
        </div>
    @endif
</div>
@endsection