<?php

namespace App\Http\Controllers;

use App\Products;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
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
        $products = DB::table("products as p")
            ->join("categories as c", "p.categoryId", "=", "c.id")
            ->select("p.*", "c.name as categoryName")
            ->get();
        $categories = Category::all();

        return view("products", compact("products", "categories"));
    }

    public function getProducts(Request $request, int $id){
        $products = DB::table("products")->where("categoryId", "=", $id)->get();
        return response()->json($products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return "create";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request['actionType'] == 'Create') {
            $this->validateOBJ($request);
            try{
                $products = new Products;
                $products->fill($request->except(["actionType","id", "created_at", "updated_at"]));
                $products->save();
                $request->session()->flash('message','Products Created Successfully');
                return response()->json(['success' => true, 'result' => 'Products Created Successfully', 'products' => $products]);
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'result' => 'Some error appeared not create']);
            }
        }else{
            return $this->update($request,Products::findOrFail($request['id']));
        }
    }

    public function validateOBJ(Request $request){
        $request->validate([
            'name'=>'required|max:255',
            "amountInStock"=> "required",
            "categoryId"=> "required"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(Products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Products  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Products $product)
    {
        $this->validateOBJ($request);
        try{
            $product->fill($request->except(["actionType","id", "created_at", "updated_at"]));
            $product->save();
            $request->session()->flash('message','Products Updated Successfully');
            return response()->json(['success'=>true,'result'=>'Products Updated Successfully','category'=>$product]);
        } catch (\Exception $e) {
            $request->session()->flash('errorMessage', 'Some error appeared not update');
            return response()->json(['success' => false, 'result' => 'Some error appeared not update']);
        }
    }

    public function updateAmountInStock($id, $amount){
        $product = Products::findOrFail($id);
        $product->amountInStock -= $amount;
        return $product->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Products $product)
    {
        try{
            $product->delete();
            $request->session()->flash('message','Products Deleted Successfully');
        } catch (\Exception $e) {
            $request->session()->flash('errorMessage', 'Some error appeared not deleted');
        } finally {
            return redirect()->intended('/products');
        }
    }
}
