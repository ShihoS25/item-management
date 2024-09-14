<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;

class ItemController extends Controller
{
    /**
     * 商品一覧
     */
    public function index()
    {
        // 商品一覧取得
        $items = Item::all();
        return view('item.index', compact('items'));
    }

    /**
     * 商品登録
     */
    public function add(Request $request)
    {
        // POSTリクエストのとき
        if ($request->isMethod('post')) {
            // バリデーション
            $this->validate($request, [
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'name' => 'required|string',
                'item_number' => 'required|string|unique:items,item_number',
                'category' => 'required|in:アウター,トップス,ボトムス,シューズ,小物',
                'size' => 'required|in:S,M,L,XL,F',
                'price' => 'required|string',
                'stock' => 'required|integer|min:0|max:50',
                'detail' => 'nullable|string'
            ]);

            // 画像をbase64エンコード
            $imageData = base64_encode(file_get_contents($request->file('image')->getRealPath()));

            // 商品登録
            Item::create([
                'user_id' => Auth::user()->id,
                'image' => $imageData,
                'name' => $request->name,
                'item_number' => $request->item_number,
                'category' => $request->category,
                'size' => $request->size,
                'price' => $request->price,
                'stock' => $request->stock,
                'detail' => $request->detail,
            ]);

            return redirect('/items');
        }

        return view('item.add');
    }

    /**
     * 商品編集
     */
    public function edit($id)
    {
        $item = Item::findOrFail($id);
        return view('item.edit', compact('item'));
    }

    /**
     * 商品情報更新
     */
    public function update(Request $request, $id)
    {
        $item = Item::findOrFail($id);

        $this->validate($request, [
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string',
            'item_number' => 'required|string|unique:items,item_number,' . $item->id,
            'category' => 'required|in:アウター,トップス,ボトムス,シューズ,小物',
            'size' => 'required|in:S,M,L,XL,F',
            'price' => 'required|string',
            'stock' => 'required|integer|min:0|max:50',
            'detail' => 'nullable|string'
        ]);

        // 画像が変更された場合
        if ($request->hasFile('image')) {
            $imageData = base64_encode(file_get_contents($request->file('image')->getRealPath()));
            $item->image = $imageData;
        }

        $item->name = $request->name;
        $item->item_number = $request->item_number;
        $item->category = $request->category;
        $item->size = $request->size;
        $item->price = $request->price;
        $item->stock = $request->stock;
        $item->detail = $request->detail;
        $item->save();

        return redirect('/items');
    }
}
