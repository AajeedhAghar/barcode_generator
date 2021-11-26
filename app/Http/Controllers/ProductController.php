<?php
  
namespace App\Http\Controllers;
   
use Illuminate\Http\Request;
use App\Models\Product;
use Picqer;

  
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->paginate(5);
    
        return view('products.index',compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
     
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        Product::all();
        return view('products.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $product_code = rand(106890,1000000);

        $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
        $barcode = $generator->getBarcode('$product_code', $generator::TYPE_CODE_128);

        
        $products = new Product;
        $products -> product_code = $product_code;
        $products -> product_name = $request -> product_name;
        $products -> description = $request -> description;
        $products -> price = $request -> price;
        $products -> barcode = $barcode;
        $products->save();
    
        return redirect()->route('products.index')
                        ->with('success','Product created successfully.');
    }
     
    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show',compact('product'));
    } 
     
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit',compact('product'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $products)
    {
        $product_code = rand(10100, 100000);
        
   
        $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
        $barcode = $generator->getBarcode($product_code, 
        $generator::TYPE_STANDARD_2_5, 2, 60);


        
        $products = Product::find($products);
        $products -> product_code = $request ->product_code;
        $products -> product_name = $request->product_name;
        $products -> description = $request->description;
        $products -> price = $request->price;
        // $products -> barcode = $barcode;
        $products -> save();
        // $product->update($request->all());
    
        return redirect()->route('products.index')
                        ->with('success','Product updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
    
        return redirect()->route('products.index')
                        ->with('success','Product deleted successfully');
    }


    public function makeBarcode()
    { 
        // $number = rand(101700,1000000);
        $product_code = '12234';
        $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
        $barcode = $generator->getBarcode('$product_code', $generator::TYPE_CODE_128);
        return view('products.view', compact('product_code', 'barcode'));
    }

    
}