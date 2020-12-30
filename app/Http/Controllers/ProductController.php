<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Compound;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function view(){
        $product =Product::all();
        return view('pages.product_list',compact('product'));
    }
    public function index(){
//        $product =Product::all();
//        dd($product);

//   add1     $product = new Product();
//        $product->name = 'test prroduct';
//        $product->price = '10';
//        $product->image = 'image';
//        $product->save();
//
//   add2
//        $product =Product::create([
//            'name'=>'test2',
//            'price'=>'20$',
//            'image'=>'image'
//        ]);

        //update 1
//        $product =Product::find(3);
//        $product->name = 'Foam filling cotton slow rebound pillows ';
//        $product->save();
        //update 2
//        $product =Product::where('id','12')->update([
//            'name'=>'new',
//            'price'=>'10'
//        ]);

//        delete 1
//        $product =Product::find(12);
//        $product->delete();
//        delete 2     $product =Product::find(12)->delete();
//        delete 3
//        $product =Product::destroy(12);

//        $product =DB::table('products')->get();
      //  $product =Product::all();
        $product =Product::paginate(5);
        return view('Dashboard.product',compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $product = Product::all();
        return view('Dashboard.add_product',compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'price'=>'required',
            'image'=>'required|mimes:jpg,png,jepg'
        ]);

        $product =new Product();
        $product->name = $request->input('name');
        $product->price = $request->input('price');

        $image = $request->file('image');
        $fileName = time().'.'.$image->extension();
        $image->move();
        $product->save('image',$fileName);
        $product->image = $fileName;
        return redirect()->route('products.index')->with('success','added done');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('Dashboard.edit_product',compact('product'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->validate($request,[
            'name'=>'required',
            'price'=>'required',
            'image'=>'required|mimes:jpg,png,jepg'
        ]);

        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->image = $request->input('image');
        $product->save();

        return redirect()->route('products.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
       $product->delete();
        return redirect()->route('products.index');

    }
}
