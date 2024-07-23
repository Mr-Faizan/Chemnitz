<?php

use App\Address;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate;

Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.users.profile')->with('status', session('status'));
    }

    return redirect()->route('admin.users.profile');
});

Route::get('/', 'HomeController@index')->name('home');
Route::get('shop/{shop}', 'HomeController@show')->name('shop');
// GlobalData
Route::resource('global-data', 'GlobalDataController');

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::post('profile/soft-delete', function () {
        $user = auth()->user();
       // $user = Auth::user(); // Get the authenticated user
        $user->delete(); // Soft delete the user
        

        return redirect('/home');
    });

    Route::post('mark-favorite', function (\Illuminate\Http\Request $request) {
        $user       = auth()->user();
        $favorites  = $user->favorites()->pluck('global_data.id')->toArray();

        $id     = $request->id;
        $status = $request->status === 'true';

        if ($status) {
            // For Allow To Add Multiple Favorites
            // $user->favorites()->attach($id);
            // $msg = "Successfully Added To Favorite";

            // Old working
            // For Allow To Add Single Favorite
            // if(count($favorites) === 0){
            //     //in_array($id, $favorites)
            //     $user->favorites()->attach($id);
            //     $msg = "Successfully Added To Favorite";
            // }else{
            //     $status = false;
            //     $msg = "Sorry You Already Have One Favorite Added";
            // }

            //New working
            // Check if the user has the 'power_user' permission
            // Check if the user has the 'power_user' permission
            if (Gate::denies('power_user')) {
                // For regular users, check if they already have a favorite
                if (count($favorites) === 0) {
                    $user->favorites()->attach($id);
                    $msg = "Successfully Added To Favorite";
                } else {
                    $status = false;
                    $msg = "Sorry, you already have one favorite added";
                }
            } else {
                // Allow power users to add more than one favorite
                $user->favorites()->attach($id);
                $msg = "Successfully Added To Favorite";
            }

            // Output the status and message
            $response = [
                'status' => $status,
                'message' => $msg,
                'success' => true,
            ];

            return response()->json($response);
        } else {
            $user->favorites()->detach($id);
            $msg = "Successfully Removed From Favorite";
        }

        $res = [
            'success' => true,
            'message' => $msg,
            'status'  => $status
        ];

        return response()->json($res);
    })->name('mark-favorite');

    Route::post('add-home', function (\Illuminate\Http\Request $request) {
        $is_edit = $request->has('address_id');

        $user       = auth()->user();
        $addresses  = $user->addresses;
        $is_default = $request->get('is_default') === 'on';

        if ($is_edit) {
            if ($request->get('is_default')) {
                foreach ($addresses as $address) {
                    $address->update([
                        'is_default' => false,
                    ]);
                }

                $address = Address::findorFail($request->get('address_id'));
                $address->update([
                    'is_default' => $is_default,
                ]);
            }
        } else {
            $address_data = [
                'user_id'       => $user->id,
                'address'       => $request->address,
                'latitude'      => $request->latitude,
                'longitude'     => $request->longitude,
                'is_default'    => count($addresses) === 0
            ];

            Address::create($address_data);
        }
        return redirect()->back();
    })->name('add-home');

    Route::get('remove-home/{id}', function ($id) {
        $address = Address::where('id', $id)->where('user_id', \auth()->id())->first();
        if ($address) {
            $address->delete();
        }
        return redirect()->back();
    })->name('remove-home');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::get('users/profile', 'UsersController@profile')->name('users.profile');
    Route::post('users/update-profile', 'UsersController@updateProfile')->name('users.profile.update');
    Route::resource('users', 'UsersController');

    // Categories
    Route::delete('categories/destroy', 'CategoriesController@massDestroy')->name('categories.massDestroy');
    Route::resource('categories', 'CategoriesController');

    Route::delete('POIs/destroy', 'POIsController@massDestroy')->name('POIs.massDestroy');
    Route::resource('POIs', 'POIsController');
});
Route::get('map', function () {
    return view('map');
});
