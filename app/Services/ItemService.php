<?php

namespace App\Services;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemService
{
    public function createItem(Request $request)
    {
        $imageData = base64_encode(file_get_contents($request->file('image')->getRealPath()));

        Item::create([
            'user_id' => Auth::user()->id,
            'image' => $imageData,
            'name' => $request->name,
            'item_number' => $request->item_number,
            'category' => $request->category,
            'size' => $request->size,
            'material' => $request->material,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
        ]);
    }

    public function editItem($id, Request $request)
    {
        $item = Item::findOrFail($id);
        
        if ($request->hasFile('image')) {
            $imageData = base64_encode(file_get_contents($request->file('image')->getRealPath()));
            $item->image = $imageData;
        }

        $item->name = $request->name;
        $item->item_number = $request->item_number;
        $item->category = $request->category;
        $item->size = $request->size;
        $item->material = $request->material;
        $item->price = $request->price;
        $item->stock = $request->stock;
        $item->description = $request->description;
        $item->save();
    }

    public function searchItems(Request $request)
    {
        $priceRange = $request->input('priceRange', 20000);
        $categories = $request->input('categories', []);
        $lowStock = $request->input('lowStock');
        $keyword = $request->input('keyword');

        $query = Auth::user()->items()->sortable()->where('price', '<=', $priceRange);

        if (count($categories) > 0) {
            $query->whereIn('category', $categories);
        }

        if (!empty($lowStock)) {
            $query->where('stock', '<=', '50');
        }

        if (!empty($keyword)) {
            $query->where(function($q) use ($keyword) {
                $q->where('name', 'LIKE', '%'.$keyword.'%')
                ->orWhere('item_number', 'LIKE', '%'.$keyword.'%');
            });
        }

        return $query->paginate(10);
    }
}