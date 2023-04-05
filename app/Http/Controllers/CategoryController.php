<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lang;
use App\Models\CategoryLang;

class CategoryController extends Controller
{
    public function index(string $lang = Lang::DEFAULT)
    {
        $langId = Lang::where('short_name', $lang)->value('id');

        return view('index', [
            'langs' => Lang::all(),
            'langId' => $langId,
            'categories' => CategoryLang::where('lang_id', $langId)->get()
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'lagId' => 'required|numeric',
            'category' => 'required|array',
            'category.*' => 'required|min:1|max:100|regex:/^[a-zA-Z0-9\s.]+$/u'
        ]);

        $categories = CategoryLang::where('lang_id', $request['langId'])
            ->where(function($query) use ($request){
                foreach($request['category'] as $id => $name){
                    $query->orWhere([
                        ['id', '=', $id],
                        ['name', '<>', $name]
                    ]);
                }

                return $query;
            })
            ->get();

        foreach($categories as $category){
            $category->name = $request['category'][$category->id];
            $category->update();
        }

        return redirect()->route('category', [
            'lang' => Lang::where('id', $request['langId'])->value('short_name')
        ]);
    }
}
