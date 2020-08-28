<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Resources\CategoryResourceCollection;
use App\Http\Resources\ProductResourceCollection;
use App\Http\Resources\ProductResource;
use App\Http\Resources\StoreResource;
use App\Http\Resources\StoreResourceCollection;
use App\Product;
use Illuminate\Support\Str;
use App\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\TryCatch;

class StoreController extends Controller
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
            'name'                  => ['required', 'unique:stores', 'max:255', 'min:3'],
            'address'               => ['required'],
            'support_phone'         => ['nullable'],
            'theme_id'              => ['nullable'],
            'category_id'           => ['required'],
            'user_id'               => ['nullable'],
            'about_text'            => ['nullable'],
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return response()->json([
            'status' => 200,
            'data' => new StoreResourceCollection(Store::all())
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
        $request['user_id'] = auth('api')->user()->id;
        $request['slug'] = Str::slug($request['name']);
        $store = Store::create($request->all());
        return response()->json([
            'status' => 201,
            'message' => 'store created successfully',
            'data' => new StoreResource($store)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function products(Store $store)
    {
        return response()->json([
            'status' => 200,
            'data' => new ProductResourceCollection($store->products)
        ]);
    }

    public function productShow(Request $request, Store $store, Product $product)
    {
        foreach ($store->products as $value) {
            if ($value['id'] == $product['id']) {
                $request['store_product'] = $product;
            }
        }
        if ($request['store_product']) {
            return response()->json([
                'status' => 200,
                'data' => new ProductResource($product)
            ]);
        } else {
            return response()->json([
                'status'    => 404,
                'data'      => 'product not found in store'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store)
    {

        return response()->json([
            'status' => 200,
            'data' => new StoreResource($store)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Store $store)
    {
        $store->update($request->all());
        return response()->json([
            'status' => 200,
            'message' => 'store updated successfully',
            'data' => new StoreResource($store)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
        $store->delete();
        return response()->json(['status' => 200, 'message' => 'store deleted successfully']);
    }
}
