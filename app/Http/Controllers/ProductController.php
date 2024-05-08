<?php

namespace App\Http\Controllers;

use App\Enums\ProductStatusEnum;
use App\Models\Category;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $model;
    public function __construct()
    {
        $this->model = new Product();

        $routeName = Route::currentRouteName();
        $arr = explode('.', $routeName);
        $arr = array_map('ucfirst', $arr);
        $title = implode(' - ', $arr);

        View::share('title', $title);
    }
    public function index()
    {
        return view('product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::query()->get();
        $listStatus = ProductStatusEnum::getArrayStatus();
//        dd($listStatus);
        return view('product.create',[
            'categories'=>$categories,
            'listStatus'=>$listStatus,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
//        dd($request->images);
        $path = Storage::disk('public')->putFile('uploads', $request->file('thumb'));
        $arr = $request->validated();
        $arr['thumb'] = $path;
        $listImages = $request->images;
        $this->model::query()->create($arr);
        $product = $this->model::query()->where('slug', $request->slug)->first();
//        dd($product);
        foreach ($listImages as $image){
            $path = Storage::disk('public')->putFile('uploads', $image);
            $product->images()->create([
                'path' => $path,
            ]);
        }
        return redirect()->route('products.index')->with('Thêm sản phẩm thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {

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
    public function update(UpdateProductRequest $request, Product $product)
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
