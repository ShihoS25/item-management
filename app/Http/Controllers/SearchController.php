<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * 検索画面
     */
    public function index()
    {
        return view('search.index');
    }

    /**
     * 検索結果出力
     */
    public function result(Request $request)
    {
        // 価格範囲の取得
        $priceRange = $request->input('priceRange', 20000);

        // カテゴリの取得
        $selectedCategories = $request->input('categories', []);

        // 検索処理
        $query = Auth::user()->items()
            ->where('price', '<=', $priceRange);

        // カテゴリが選択されている場合は絞り込む
        if (count($selectedCategories) > 0) {
            $query->whereIn('category', $selectedCategories);
        }

        $items = $query->get();

        return view('search.index', compact('items'));
    }
}
