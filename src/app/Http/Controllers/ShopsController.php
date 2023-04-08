<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Http\Requests\ShopRequest;
use Illuminate\Support\Facades\Redirect;

class ShopsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shops = Shop::orderBy('created_at', 'desc')->get();
        return view('shops.index', [
            'shops' => $shops,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('shops.create');
    }

    /**
     * Confirm input.
     *
     * @param  \App\Http\Requests\ShopRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function confirm(ShopRequest $request)
    {
        return view('shops.confirm', [
            'inputs' => $request->all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ShopRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShopRequest $request)
    {
        if ($request->has('back')) {
            return Redirect::route('shops.create')->withInput($request->all());
        }

        Shop::create($request->all());
        return view('shops.complete')->with('status', 'shops-stored');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop)
    {
        return view('shops.show', ['shop' => $shop]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function edit(Shop $shop)
    {
        return view('shops.edit', ['shop' => $shop]);
    }

    /**
     * Confirm input.
     *
     * @param  \App\Http\Requests\ShopRequest  $request
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function updateConfirm(ShopRequest $request, Shop $shop)
    {
        return view('shops.confirm', [
            'shop' => $shop,
            'inputs' => $request->all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ShopRequest  $request
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function update(ShopRequest $request, Shop $shop)
    {
        if ($request->has('back')) {
            return Redirect::route('shops.edit', $shop)->withInput($request->all());
        }

        $shop->update($request->all());
        return view('shops.complete')->with('status', 'shops-updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop)
    {
        $shop->delete();
        return Redirect::route('shops.index')->with('status', 'shops-deleted');
    }
}
