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
     * 検索結果表示
     */
    public function result(Request $request)
    {
        $priceRange = $request->input('priceRange', 20000);
        $selectedCategories = $request->input('categories', []);
        $keyword = $request->input('keyword');

        $query = Auth::user()->items()->where('price', '<=', $priceRange);

        if (count($selectedCategories) > 0) {
            $query->whereIn('category', $selectedCategories);
        }

        if (isset($keyword)) {
            $query->where('name', 'LIKE', '%'.$keyword.'%');
        }

        $items = $query->paginate(5);
        return view('search.index', compact('items'));
    }
}
