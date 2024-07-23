<?php

namespace App\Http\Controllers;

use App\Helpers\TransliterationHelper;
use App\Models\SKUCategory;
use Illuminate\Http\Request;

class TypeGoodsController extends Controller
{
    public function index()
    {
        $categories = SKUCategory::with('children')->whereNull('parent_id')->get();

        return view('type-goods.index', compact('categories'));
    }

    public function store(Request $request)
    {

        $validatedData = $this->validate($request, [
            'name'      => 'required|min:3|max:255|string',
            'parent_id' => 'sometimes|nullable|numeric'
        ]);

        $category = SKUCategory::create($validatedData);
        $category->key = TransliterationHelper::transliterate($category->name) . $category->id;
        $category->save();

        return redirect()->route('type-goods.index')->withSuccess('You have successfully created a Category!');
    }

    public function update(Request $request, $id)
    {

        $validatedData = $this->validate($request, [
            'name'  => 'required|min:3|max:255|string',
            'parent_id' => 'sometimes|nullable|numeric',
        ]);

        $skuCategory = SKUCategory::findOrFail($id);
        $skuCategory->key = TransliterationHelper::transliterate($request->name) . $id;
        $skuCategory->update($validatedData);

        return redirect()->route('type-goods.index')->withSuccess('You have successfully updated a Category!');
    }

    private function slugify($string) {
        $string = transliterator_transliterate("Any-Latin; NFD; [:Nonspacing Mark:] Remove; NFC; [:Punctuation:] Remove; Lower();", $string);
        //$string = preg_replace('/[-\s]+/', '-', $string);
        //trim($string, '-');
        return $string;
    }
}
