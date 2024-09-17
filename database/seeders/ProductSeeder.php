<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // 禁用外键约束
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // 清空相关表
        Stock::query()->delete();
        Product::query()->delete();

        // 重置自增ID
        DB::statement('ALTER TABLE products AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE stocks AUTO_INCREMENT = 1;');

        // 启用外键约束
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 确保有类别和品牌可用
        $categories = Category::all();
        $brands = Brand::all();

        // 如果没有类别或品牌，创建一些示例数据
        if ($categories->isEmpty()) {
            $categories = Category::factory()->count(5)->create();
        }
        if ($brands->isEmpty()) {
            $brands = Brand::factory()->count(5)->create();
        }

        // 创建50个产品
        for ($i = 0; $i < 50; $i++) {
            $product = Product::create([
                'name' => '产品' . ($i + 1),
                'description' => '这是产品' . ($i + 1) . '的描述',
                'price' => rand(100, 10000) / 100,
                'category_id' => $categories->random()->id,
                'brand_id' => $brands->random()->id,
            ]);

            // 为每个产品创建库存记录
            Stock::create([
                'product_id' => $product->id,
                'quantity' => rand(0, 100),
            ]);
        }
    }
}