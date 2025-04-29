<?php

namespace App\Http\Controllers;

use App\Models\Product;

use Illuminate\Http\Request;
use App\Models\Partnership;
use App\Models\ProductDetails;
use App\Models\Tag;
use App\Models\Voucher;
use Illuminate\Support\Facades\DB;



class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Return a list of products
            return Product::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //



    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'nullable|numeric|max:255',
            'subcategory' => 'nullable|numeric|max:255',
            'logo' => 'nullable|string|max:2048',
            'discount' => 'nullable|string',
            'discountText' => 'nullable|string|max:255',
            'promoCode' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'tags' => 'nullable|array',
            'tags.*' => 'nullable|string|max:255',
            'storeAddress' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'facebook' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'hasMap' => 'nullable|string|string',
            'url' => 'nullable|string|max:255',
            'isPopular' => 'nullable|boolean',
            'states' => 'nullable|numeric',
            'subcategory' => 'nullable|numeric'
            
        ]);

        
        try {
            DB::transaction(function () use ($request) {
                $partnership = Partnership::create([
    
                    'is_popular' => $request->input('isPopular') == true ? 1 : 0,
    
                ]);
    
    
                $productDetail = ProductDetails::create([
             
                    'facebook_link' => $request->input('facebook'),
                    'website_link' => $request->input('website'),
                    'instagram_link' => $request->input('instagram'),
                    'email_link' => $request->input('email'),
                    'phone_number' => $request->input('phone'),
                    'maps_link' => $request->input('hasMap'),
                    'url' => $request->input('url')
                    
                ]);
    
              
    
                if ($request->has(['discount', 'discountText', 'promoCode'])) {
                    $voucher = Voucher::create([
                        'discount' => $request->input('discount'),
                        'discount_text' => $request->input('discountText'),
                        'code' => $request->input('promoCode'),
                    ]);
    
                }
    
               
                $voucherId = optional($voucher)->id;
    
                $productDetailId = $productDetail->id;
    
                $partnershipId = $partnership->id;
    
                $product = Product::create([

                'name' => $request->input('name'),
                'store_address' => $request->input('storeAddress'),
                'description' => $request->input('description'),
                'partnership_id' => $partnershipId,
                'product_detail_id' => $productDetailId,
                'voucher_id' => $voucherId,
                'category_id' => $request->input('category'),
                'subcategory_id' => $request->input('subcategory'),
                'state_id' => $request->input('states'),
                'img' => $request->input('logo')

                ]);

          
              
                $productId = $product->id;
                  
                if ($request->has('tags')) {
                    foreach ($request->input('tags') as $tag) {
                        if (!empty($tag)) {
                            Tag::create([
                                'name' => $tag,
                                'product_id' => $productId // Mengasosiasikan tag dengan produk
                            ]);
                        }
                    }
                }
    
    
    
            });
           
            
        } catch (\Throwable $th) {
            return response()->json([$th]);
        }
      

        return response()->json(['message' => 'Product created successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
