<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Str;
use App\Product;
use App\StoreFiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Get a validator for an incoming request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'title'                 => ['required', 'unique:products', 'max:255', 'min:5'],
            'price'                 => ['required', 'min:0.01'],
            'discount_type'         => ['min:0.01'],
            'discount'              => ['min:0.01'],
            'sku'                   => ['min:3'],
            'collection_id'         => ['nullable'],
            'description'           => ['min:10'],
            'category_id'           => ['integer'],
            'status'                => ['min:0.01'],
            'seo_title'             => ['nullable', 'min:5'],
            'seo_description'       => ['nullable', 'min:10'],
            'social_title'          => ['nullable', 'min:5'],
            'social_description'    => ['nullable', 'min:10'],
            'files'                 => 'required',
            'files.*'               => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'status' => 200,
            'data' => new ProductCollection(Product::all())
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeItems()
    {
        return response()->json([
            'status' => 200,
            'data' => new ProductCollection(Product::all())
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validator($request->all())->validate();
        $request['slug'] = Str::slug($request['title']);
        $request['user_id'] = auth('api')->user()->id;
        $product = Product::create($request->all());
        if ($request->hasfile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('public/products');
                StoreFiles::create([
                    'path'          => Str::of($path)->replaceFirst('public', '/storage'),
                    'type'          => $file->extension(),
                    'size'          => $file->getSize(),
                    'product_id'    => $product->id
                ]);
            }
        }
        return response()->json([
            'status' => 201,
            'message' => 'product created successfully',
            'data' => new Product($product)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return response()->json([
            'status' => 200,
            'data' => new ProductResource($product)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request['slug'] = Str::slug($request['title']);
        $product->update($request->all());
        foreach ($request->file('files') as $file) {
            $path = $file->store('products');
            StoreFiles::create([
                'path'          => $path,
                'type'          => $file->extension(),
                'size'          => $file->getSize(),
                'product_id'    => $product->id
            ]);
        }
        return response()->json([
            'status' => 201,
            'message' => 'product updated successfully',
            'data' => new ProductResource($product)
        ]);
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
        return response()->json(['status' => 200, 'message' => 'product deleted successfully']);
    }
}
