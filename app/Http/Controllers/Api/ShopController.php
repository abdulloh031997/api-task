<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Http\Resources\ShopResource;
use App\Http\Resources\ShopCollection;
use App\Shop;
use Illuminate\Support\Facades\Validator;
class ShopController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = new ShopCollection(Shop::with('product')->paginate());
        return $this->sendResponse($data, 'Shop successfully.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:shops|max:6',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }
        if ($validator->passes()) {
            $shop = SHop::create([
                'name' => $request->name,
                'created_at' => date(now()),
            ]);
            $data = new ShopResource($shop);
            return $this->sendResponse($data, 'Shop successfully.');
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop)
    {
        $data = new ShopResource($shop);
        if(!empty($data))
        {
            return $this->sendResponse($data, $data->name.' '.'shop returned.');
        }
        else{
            return $this->sendError($shop ,'404 not found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $shop)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $shop = Shop::findOrFail($id);
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required|unique:shops|max:6.',
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }
        if ($validator->passes()) {
            $shop->fill($input)->save();
            $shop =  new ShopResource($shop);
            return $this->sendResponse($shop, 'Shop updated success.');
         }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop)
    {
        $shop->delete();
        return $this->sendResponse($shop->name, 'Shop  deleted success.');
    }
}
