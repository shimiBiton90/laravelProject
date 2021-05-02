<?php

namespace App\Http\Controllers;

use App\Customers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomersController extends Controller
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
        $customers = DB::table("customers as c")
            ->join("users as u", "u.id", "=", "c.userId")
            ->join("products as p", "p.id", "=", "c.productId")
            ->join("categories as cat", "cat.id", "=", "p.categoryId")
            ->join("countries as cou", "cou.id", "=", "c.countryId")
            ->select("c.*", "u.name as userName", "cat.name as categoryName", "cat.id as categoryId", "p.name as productName", "p.amountInStock", "cou.name as countryName")
            ->get();

        return view("customers", compact("customers"));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        unset($request["categoryId"]);
        $request["userId"] = auth()->user()->getAuthIdentifier();
        $this->validateOBJ($request);

        DB::beginTransaction();

        try{
            if ($request['actionType'] == 'Create') {
                $oldAmount = 0;
                $customer = new Customers();
                $customer->fill($request->except(["actionType","id", "created_at", "updated_at"]));
                $customer->save();
                $request->session()->flash('message','Customer Created Successfully');
                $response =  response()->json(['success' => true, 'result' => 'Customer Created Successfully', 'customer' => $customer]);
            }else{
                $customer = Customers::findOrFail($request['id']);
                $oldAmount = $customer->amount;
                $response = $this->update($request, $customer);
            }
            // update amount in stock of products
            $productController = new ProductsController();
            $productController->updateAmountInStock($request["productId"], $request["amount"] - $oldAmount);
            DB::commit();
            return $response;
        } catch (\Exception $e) {
            DB::rollBack();
            $request->session()->flash('errorMessage', 'Some error appeared not create');
            return response()->json(['success' => false, 'result' => 'Some error appeared not create']);
        }

    }

    public function validateOBJ(Request $request){
        $request->validate([
            "productId"=> "required",
            "amount"=> "required",
            "countryId"=> "required",
            "userId"=> "required",
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customers  $customers
     * @return \Illuminate\Http\Response
     */
    public function show(Customers $customers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customers  $customers
     * @return \Illuminate\Http\Response
     */
    public function edit(Customers $customers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customers  $customers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customers $customers)
    {
        $this->validateOBJ($request);
        try{
            $customers->fill($request->except(["actionType","id", "created_at", "updated_at"]));
            $customers->save();
            $request->session()->flash('message','Customers Updated Successfully');
            return response()->json(['success'=>true,'result'=>'Customers Updated Successfully','customers'=>$customers]);
        } catch (\Exception $e) {
            DB::rollBack();
            $request->session()->flash('errorMessage', 'Some error appeared not update');
            return response()->json(['success' => false, 'result' => 'Some error appeared not update']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customers  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Customers $customer)
    {
        try{
            $customer->delete();
            $request->session()->flash('message','Customers Deleted Successfully');
        } catch (\Exception $e) {
            $request->session()->flash('errorMessage', 'Some error appeared not deleted');
        } finally {
            return redirect()->intended('/customers');
        }
    }
}
