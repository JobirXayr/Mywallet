<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $income_categories = Category::where('type', 1)->get();
        $expense_categories = Category::where('type', -1)->get();

        return view('category.index', compact('income_categories', 'expense_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $imageName = "";
        if($request->hasFile('image')){
            $imageName = time().'_'.$request->image->getClientOriginalName();
            $request->image->move(public_path('/images'), $imageName);
        }

        Category::create([
            'name' => $request->category,
            'type' => $request->type,
            'path' => $imageName
        ]);

        return redirect()->route('categories.index')->with('message', "Категория успешно создана.");    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $category->name = $request->category;
        $category->type = $request->type;
        
        if ($request->hasFile('image')) {
            $imageName = time().'_'.$request->image->getClientOriginalName();
            $request->image->move(public_path('/images'), $imageName);
            $category->path = $imageName;
        }
        
        $category->save();
        
        return redirect()->route('categories.index')->with('message', 'Категория успешно сохранена.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::where('id', $id)->delete();

        return redirect()->route('categories.index')->with('message', 'Категория удалена.');
    }
}
