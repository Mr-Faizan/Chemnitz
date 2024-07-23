<?php

namespace App\Http\Controllers;

use App\Category;
use App\GlobalData;
use App\Utils\CustomHelper;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GlobalDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $categories = Category::all();
        $data = GlobalData::where('category_id',1)->searchResults()->paginate(21);

        $mapData = [];

        $latitude = $data->count() && (request()->filled('category') || request()->filled('search')) ? $data->average('x') : 12.887276265842;
        $longitude = $data->count() && (request()->filled('category') || request()->filled('search')) ? $data->average('y') : 50.792274910244;

        return view('new_home', compact('data', 'categories', 'latitude', 'longitude', 'mapData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return Application|Factory|View|Response
     */
    public function show($id)
    {
        $globalData = GlobalData::findOrFail($id);
        $address    = null;
        if(auth()->check()){
            $address  = auth()->user()->addresses()->where('is_default', true)->first();
        }
        $globalData['additional_details'] = CustomHelper::fetchLocDetails($globalData->x, $globalData->y);

        return view('global_data.show', compact('globalData', 'address'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GlobalData  $globalData
     * @return Response
     */
    public function edit(GlobalData $globalData)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GlobalData  $globalData
     * @return Response
     */
    public function update(Request $request, GlobalData $globalData)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GlobalData  $globalData
     * @return Response
     */
    public function destroy(GlobalData $globalData)
    {
        //
    }
}
