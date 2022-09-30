<?php

namespace App\Http\Controllers;


use App\Http\Requests\Admin\Pruduct\ProductCreateValidation;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
=======
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $products = Product::paginate(15);
        return view('admin.product.index', compact('products'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.product.createOrUpdate');
    }

    /**
     * @param ProductCreateValidation $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProductCreateValidation $request)
    {
        $validate = $request->validated();
        unset($validate['photo_file']);
        # public/asd.jpg
        $photo = $request->file('photo_file')->store('public');
        # Explode => / => public/asd,jpg => ['public', 'asd.jpg']
        $validate['photo'] = explode('/', $photo)[1];

        Product::create($validate);
        return back()->with(['success' => true]);
    }

    /**
     * @param Product $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Product $product)
    {
        $breadcrumbs = [
            ['routeName' => 'welcome', 'name' => 'Главная страница'],
            ['routeName' => 'admin.product.index', 'name' => 'Все продукты'],
            ['name'=> $product->name]
        ];
        return view('admin.product.show', compact('product', 'breadcrumbs'));
    }

    /**
     * @param Product $product
     * @return void
>>>>>>> b955ab1 (Version 1.0.1)
     */
    public function edit(Product $product)
    {
        //
    }

    /**
<<<<<<< HEAD
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
=======
     * @param Request $request
     * @param Product $product
     * @return void
>>>>>>> b955ab1 (Version 1.0.1)
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
<<<<<<< HEAD
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
=======
     * @param Product $product
     * @return void
>>>>>>> b955ab1 (Version 1.0.1)
     */
    public function destroy(Product $product)
    {
        //
    }
}
