<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Services\ItemService;

class ItemController extends Controller
{
    protected $ItemService;

    public function __construct(ItemService $ItemService)
    {
        $this->ItemService = $ItemService;
    }

    // 商品一覧
    public function index()
    {
        $items = Auth::user()->items()->sortable()->latest()->paginate(5);
        return view('item.index', compact('items'));
    }

    // 商品登録
    public function add(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'name' => 'required|string|max:100',
                'item_number' => 'required|string|max:10|unique:items',
                'category' => 'required|in:アウター,トップス,ボトムス,シューズ,小物',
                'size' => 'required|in:S,M,L,XL,F',
                'material' => 'nullable|string|max:50',
                'price' => 'required|integer|min:0|max:20000',
                'stock' => 'required|integer|min:0|max:500',
                'description' => 'nullable|string|max:500'
            ]);

            $this->ItemService->createItem($request);
            return redirect('/items')->with('success', '登録が完了しました。');
        }

        return view('item.add');
    }

    // 商品編集
    public function edit($id)
    {
        $item = Item::findOrFail($id);
        return view('item.edit', compact('item'));
    }

    // 更新
    public function update(Request $request, $id)
    {
        $item = Item::findOrFail($id);

        $this->validate($request, [
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:100',
            'item_number' => 'required|string|max:10|unique:items,item_number,' . $item->id,
            'category' => 'required|in:アウター,トップス,ボトムス,シューズ,小物',
            'size' => 'required|in:S,M,L,XL,F',
            'material' => 'nullable|string|max:50',
            'price' => 'required|integer|min:0|max:20000',
            'stock' => 'required|integer|min:0|max:500',
            'description' => 'nullable|string|max:500'
        ]);

        $this->ItemService->editItem($id, $request);
        return redirect('/items')->with('success', '商品情報を更新しました。');
    }

    // 商品削除
    public function delete($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();
        return redirect('/items')->with('success', '該当商品を削除しました。');
    }

    // 商品検索
    public function search()
    {
        return view('item.search');
    }

    // 検索結果
    public function result(Request $request)
    {
        $items = $this->ItemService->searchItems($request);
        $request->session()->put('exportItems', $items);
        return view('item.search', compact('items'))->with('exportItems');
    }

    // 検索結果CSV出力
    public function export(Request $request)
    {
        $items = $request->session()->get('exportItems');

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="search_results.csv"',
        ];

        $callback = function () use ($items) {
            $file = fopen('php://output', 'w');
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            fputcsv($file, ['ID', '商品名', '品番', 'カテゴリー', 'サイズ', '素材', '価格', '在庫', '商品説明', '登録日', '更新日'], ',', '"');

            foreach ($items as $item) {
                fputcsv($file, [
                    $item->id,
                    $item->name,
                    $item->item_number,
                    $item->category,
                    $item->size,
                    $item->material,
                    $item->price,
                    $item->stock,
                    strip_tags($item->description),
                    date_format($item->created_at, 'Y-m-d'),
                    date_format($item->updated_at, 'Y-m-d'),
                ], ',', '"');
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
