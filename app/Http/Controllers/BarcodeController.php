<?php

namespace App\Http\Controllers;
use App\Models\Product;

use Illuminate\Http\Request;

class BarcodeController extends Controller
{
    //
    public function GetProductBarcodes()
    {
        $productsBarcode = Product::select('barcode','product_code')->get();
        return view('products.barcode.index', compact('productsBarcode'));
    }
}
