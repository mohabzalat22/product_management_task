<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(10)->withQueryString();
        return $this->successResponse(message:'Fetched Products Successfully.', data:$products, status_code:200);
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
    public function store(CreateProductRequest $request)
    {
        $validated = $request->validated();
        
        // create new product
        $createdProduct = Product::create([
            'user_id' => Auth::user()->id,
            'name' => $validated['name'],
            'description' =>$validated['description'],
            'price' => $validated['price'],
            'quantity' => $validated['quantity'],
        ]);

        return $this->successResponse(message:'Product Created Successfully.', data:$createdProduct, status_code:201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $productById = Product::find($id);
        return $this->successResponse(message:'Fetched Specific Product Successfully.', data:$productById, status_code:200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id)
    {
        $validated = $request->validated();
        $product = Product::find($id);

        if($product){
            $updatedProduct = $product->update([
                'name' => $validated['name'],
                'description' =>$validated['description'],
                'price' => $validated['price'],
                'quantity' => $validated['quantity'],
            ]);

            if($updatedProduct){
                return $this->successResponse(message:'Product Updated Successfully.', data:$product, status_code:200);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deletedProduct = Product::find($id);

        if($deletedProduct){
            $deletedProduct->delete();
            return $this->successResponse(message:'Product Deleted Successfully.', data:$deletedProduct, status_code:200);
        }

        return $this->errorResponse(message:'Unable To Delete Product', data:[], status_code:422, errors:[]);
    }
}
