<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Season;


class ProductSeasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $map = [
            'キウイ' => ['秋','冬'],
            'ストロベリー' => ['春'],
            'オレンジ' => ['冬'],
            'スイカ' => ['夏'],
            'ピーチ' => ['夏'],
            'シャインマスカット' => ['夏','秋'],
            'パイナップル' => ['春','夏'],
            'ブドウ' => ['夏','秋'],
            'バナナ' => ['夏'],
            'メロン' => ['春','夏']
        ];

        foreach ($map as $productName => $seasonNames) {
            $product = Product::where('name', $productName)->first();
            if (!$product) continue;

            $seasonIds = Season::whereIn('name', $seasonNames)->pluck('id')->all();
            $product->seasons()->syncWithoutDetaching($seasonIds);
        }
    }
}
