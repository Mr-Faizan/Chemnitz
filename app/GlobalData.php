<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GlobalData extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeSearchResults($query)
    {
        return $query->when(request()->filled('search'), function($query) {
                $query->where(function($query) {
                    $search = request()->input('search');
                    if($search !== ''){
                        $query->where('designation', 'LIKE', "%$search%")
                            ->orWhere('short_designation', 'LIKE', "%$search%")
//                        ->orWhere('city', 'LIKE', "%$search%")
                            ->orWhere('street', 'LIKE', "%$search%");
                    }
                });
            });
    }

}
