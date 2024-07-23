<?php

namespace App\Http\Controllers;

use App\Category;
use App\GlobalData;
use App\Shop;
use App\Utils\CustomHelper;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $category   = request()->has('category')? request()->get('category') : null;
        $search     = request()->has('search')? request()->get('search') : null;

        if(!empty($category) && !empty($search)){
            $data = GlobalData::where('category_id',$category)
                ->where(function($query) use ($search){
                  $query->where('designation', 'LIKE', "%$search%")
                      ->orWhere('short_designation', 'LIKE', "%$search%")
                      ->orWhere('street', 'LIKE', "%$search%")
                      ->orWhere('profile', 'LIKE', "%$search%")
                      ->orWhere('city_town', 'LIKE', "%$search%");
                })->paginate(12);
        }else if(!empty($search) || !empty($category)){
            $query = GlobalData::query();
            if(!empty($category)){
                $query = $query->where('category_id',$category);
            }
            if(!empty($search)){
                $query = $query->where(function($query) use ($search){
                    $query->where('designation', 'LIKE', "%$search%")
                        ->orWhere('short_designation', 'LIKE', "%$search%")
                        ->orWhere('street', 'LIKE', "%$search%")
                        ->orWhere('profile', 'LIKE', "%$search%")
                        ->orWhere('city_town', 'LIKE', "%$search%");
                });
            }
            $data = $query->paginate(12);
        }else{
            $data = GlobalData::whereNotNull('x')->paginate(12);
        }


                // Apply the same filtering for the map data
        $all_locations_query = GlobalData::query();
        if (!empty($category)) {
            $all_locations_query->where('category_id', $category);
        }
        $all_locations = $all_locations_query->get();

      //  $all_locations = GlobalData::whereNotNull('x')->orWhereNotNull('y')->get();

        // Initialize an empty array to store the mapped data
        $mapData = [];

        // Iterate through each item in the paginated collection
        foreach ($all_locations as $item) {
            // Build an array with 'id', 'x', and 'y' values for each item
            if($item->category){
                $mapData[] = [
                    'id'            => $item->id,
                    'latitude'      => $item->x,
                    'longitude'     => $item->y,
                    'designation'   => $item->designation,
                    'street'        => $item->street,
                    'color'         => $item->category->color
                ];
            }
        }

        $favorites  = [];
        if(auth()->check()){
            $favorites  = auth()->user()->favorites()->pluck('global_data.id')->toArray();
        }

        $latitude = $data->count() && (request()->filled('category') || request()->filled('search')) ? $data->average('x') : 50.828032902010285;
        $longitude = $data->count() && (request()->filled('category') || request()->filled('search')) ? $data->average('y') : 12.923252354159501;

        return view('new_home', compact('data','categories', 'mapData', 'favorites', 'latitude', 'longitude', 'all_locations'));
    }
}
