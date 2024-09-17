@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">品牌列表</h1>
    <a href="{{ route('brands.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 inline-block mb-4">创建新品牌</a>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <table class="w-full bg-white shadow-md rounded mb-4">
        <thead>
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left">ID</th>
                <th class="py-3 px-6 text-left">名称</th>
                <th class="py-3 px-6 text-center">操作</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
            @foreach ($brands as $brand)
            <tr class="border-b border-gray-200 hover:bg-gray-100">
                <td class="py-3 px-6 text-left whitespace-nowrap">{{ $brand->id }}</td>
                <td class="py-3 px-6 text-left">{{ $brand->name }}</td>
                <td class="py-3 px-6 text-center">
                    <a href="{{ route('brands.edit', $brand) }}" class="text-blue-600 hover:text-blue-900 mr-2">编辑</a>
                    <form action="{{ route('brands.destroy', $brand) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('确定要删除这个品牌吗？')">删除</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection