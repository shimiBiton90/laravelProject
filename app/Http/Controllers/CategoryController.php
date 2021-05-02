<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view("categories", compact("categories"));
    }

    public function getCategories()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request['actionType'] == 'Create') {
            $this->validateOBJ($request);
            try {
                $category = new Category;
                $category->fill($request->except(["actionType", "id"]));
                $category->save();
                $request->session()->flash('message', 'Category Created Successfully');
                return response()->json(['success' => true, 'result' => 'Category Created Successfully', 'category' => $category]);
            } catch (\Exception $e) {
                $request->session()->flash('errorMessage', 'Some error appeared not create');
                return response()->json(['success' => false, 'result' => 'Some error appeared not create']);
            }
        } else {
            return $this->update($request, Category::findOrFail($request['id']));
        }
    }

    public function validateOBJ(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->validateOBJ($request);
        try {
            $category->fill($request->except(["actionType", "id"]));
            $category->save();
            $request->session()->flash('message', 'Category Updated Successfully');
            return response()->json(['success' => true, 'result' => 'Category Updated Successfully', 'category' => $category]);
        } catch (\Exception $e) {
            $request->session()->flash('errorMessage', 'Some error appeared not update');
            return response()->json(['success' => false, 'result' => 'Some error appeared not update']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Category $category)
    {
        try {
            $category->delete();
            $request->session()->flash('message', 'Category Deleted Successfully');
        } catch (\Exception $e) {
            $request->session()->flash('errorMessage', 'Some error appeared not deleted');
        } finally {
            return redirect()->intended('/categories');
        }
    }
}
