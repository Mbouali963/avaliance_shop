<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return response()->json($products, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $user = $this->authUser();

        $validator = Validator::make($data, [
            'name' => 'required',
            'sku' => 'required',
            'price' => 'required|numeric|min:1',
            'quantity' => 'required|numeric|min:1',
            'category_id' => 'required'
        ]);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 500);
            // return $this->sendError('Validation Error.', $validator->errors());
        }

        $product = Product::create($data);

        return response()->json($product, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product, 200);
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
        $data = $request->all();

        $user = $this->authUser();

        $validator = Validator::make($data, [
            'name' => 'required',
            'sku' => 'required',
            'price' => 'required|numeric|min:1',
            'quantity' => 'required|numeric|min:1',
            'category_id' => 'required'
        ]);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 500);
        }

        $product = Product::findOrFail($id);
        $product->name = $data['name'];
        $product->sku = $data['sku'];
        $product->price = $data['price'];
        $product->quantity = $data['quantity'];
        $product->save();

        return response()->json($product, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->authUser();

        $deleted = Product::destroy($id);

        return response()->json($deleted, 200);
    }
}
