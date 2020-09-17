<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Support\Collection;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = Product::all();
        $_db = new Product();
        // $page = $_db::latest()->paginate(8);
        $newproducts = $_db->newProduct();
        $topproducts = $_db->topProduct();
        $pagenewpd = (new Collection($newproducts))->paginate(4);
        $pagetoppd = (new Collection($topproducts))->paginate(4);

        return response()->json(['products' => $products, 'pagenew' => $pagenewpd, 'pagetop' => $pagetoppd]);
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
        //
        $this->validate($request, [
            'name' => 'required|string',
            'price' => 'required|integer',
        ]);
        $fileName = '';
        if ($request->file('image')) {
            $fileName = $request->file('image')->store('', 'public');
            $request->file('image')->move(public_path('images/product/'), $fileName);
        }
        Product::create([
            'name' => $request['name'],
            'description' => $request['description'] == 'null' ? null : $request['description'],
            'category' => $request['category'],
            'product_type' => $request['product_type'],
            'price' => $request['price'],
            // 'promotion_price' => $request['promotion_price'],
            'photo' => $fileName
        ]);
        return response()->json('Created success Product ');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
        $this->validate($request, [
            'name' => 'required|string',
            'price' => 'required|integer',
        ]);
        $product = Product::findOrFail($id);
        $fileName = $product->photo;
        if ($request->file('image') && $fileName != $request->photo) {
            $fileName = $request->file('image')->store('', 'public');
            $request->file('image')->move(public_path('images/product/'), $fileName);
        }
        if ($fileName != $product->photo) {
            @unlink(public_path('images/product/') . $product->photo);
        }
        $product->name = $request['name'];
        $product->description = $request['description'] == 'null' ? null : $request['description'];
        $product->category = $request['category'];
        $product->product_type = $request['product_type'];
        $product->price = $request['price'];
        // $product->promotion_price = $request['promotion_price'];
        $product->photo = $fileName;

        $product->save();
        return ['message' => 'Updated success Product'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $product = Product::findOrFail($id);
        $photo = public_path('images/product/') . $product->photo;
        @unlink($photo);
        $product->delete();
        return ['message' => 'Product deleted'];
    }
}