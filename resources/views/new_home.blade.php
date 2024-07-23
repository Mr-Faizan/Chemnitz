@extends('layouts.main')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="content-box content-single">
                <article class="post-8 page type-page status-publish hentry">
                    <header>
                        <h1 class="entry-title">{{ request()->filled('search') || request()->filled('category') ? 'Search results' : 'All Locations' }}</h1></header>
                    <div class="entry-content entry-summary">
                        <div class="geodir-search-container geodir-advance-search-default" data-show-adv="default">
                            <form id="categoryForm" class="geodir-listing-search gd-search-bar-style" name="geodir-listing-search" action="{{ route('home') }}" method="get">
                                <div class="geodir-loc-bar">
                                    <div class="clearfix geodir-loc-bar-in">
                                        <div class="geodir-search">
                                            <div class='gd-search-input-wrapper gd-search-field-cpt gd-search-field-taxonomy gd-search-field-categories'>
                                                <select name="category" class="cat_select" onchange="submitForm()">
                                                    <option value="">Category</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->id }}"{{ old('category', request()->input('category')) == $category->id ? ' selected' : '' }}>{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class='gd-search-input-wrapper gd-search-field-search'> <span class="geodir-search-input-label"><i class="fas fa-search gd-show"></i><i class="fas fa-times geodir-search-input-label-clear gd-hide" title="Clear field"></i></span>
                                                <input class="search_text gd_search_text" name="search" value="{{ old('search', request()->input('search')) }}" type="text" placeholder="Search for" aria-label="Search for" autocomplete="off" />
                                            </div>
                                            <button class="geodir_submit_search" data-title="fas fa-search" aria-label="fas fa-search"><i class="fas fas fa-search" aria-hidden="true"></i><span class="sr-only">Search</span></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @if ($data->hasPages())
                            <ul class="pagination" style="list-style: none; display: inline-flex; align-items: center; float: right">
                                {{-- Previous Page Link --}}
                                @if ($data->onFirstPage())
                                    <li class="disabled" style="color: lightgrey"><span>{{ __('Prev') }}</span></li>
                                @else
                                    <li><a href="{{ $data->previousPageUrl() }}" rel="prev">{{ __('Prev') }}</a></li>
                                @endif

                                &nbsp;&nbsp; <small>{{ "Page " . $data->currentPage() . "  of  " . $data->lastPage() }}</small> &nbsp;&nbsp;

                                {{-- Next Page Link --}}
                                @if ($data->hasMorePages())
                                    <li><a href="{{ $data->nextPageUrl() }}" rel="next">{{ __('Next') }}</a></li>
                                @else
                                    <li class="disabled" style="color: lightgrey"><span>{{ __('Next') }}</span></li>
                                @endif
                            </ul>
                            <div style="clear: both; margin: 0; padding: 0"></div>
                        @endif

                        <div class="geodir-loop-container">
                            <ul class="geodir-category-list-view clearfix gridview_onethird geodir-listing-posts geodir-gridview gridview_onethird">
                                @foreach($data as $d)
                                    <li class="gd_place type-gd_place status-publish has-post-thumbnail">
                                        <div class="gd-list-item-left ">
                                            <div class="geodir-post-slider">
                                                <div class="geodir-image-container geodir-image-sizes-medium_large">
                                                    <div class="geodir-image-wrapper">
                                                        <ul class="geodir-post-image geodir-images clearfix">
                                                            <li style="height: 300px">
                                                                <div id="map-canvas-{{$d->id}}" data-color="{{$d->category->color ?? '#FFFFFF'}}" data-loc="{{$d->x . "," . $d->y}}" style="height: 300px; width: 100%; position: relative; overflow: hidden;">
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="gd-list-item-right ">
                                            <div class="geodir-post-title">
                                                <h2 class="geodir-entry-title" style="display: flex; align-items: center; justify-content: space-between;">
                                                    <a href="{{ route('global-data.show', $d->id) }}" title="View: {{ $d->designation }}" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                        {{ $d->designation ?? $d->carrier_sponsor }}
                                                    </a>
                                                    @auth()
                                                    <i class="fa fas fa-heart{{in_array($d->id, $favorites)? '' : '-o'}}" style="color: red; cursor:pointer" onclick="markFavorite('{{$d->id}}')"></i>
                                                    @endauth
                                                </h2>
                                            </div>
                                                <div class="gd-badge-meta gd-badge-alignleft" title="{{ $d->category->name ?? '' }}">
                                                    <div class="gd-badge" style="background-color:{{$d->category->color ?? '#000000'}};color:#ffffff;"><i class="fas fa-certificate"></i> <span class='gd-secondary'>{{ $category->name }}</span></div>
                                                </div>
                                            <div class="geodir-post-content-container">
                                                <div class="geodir_post_meta  geodir-field-post_content" style='height:20px;max-height:150;overflow:hidden;'>{{ $d->designation }} <a href='{{ route('global-data.show', $d->id) }}' class='gd-read-more  gd-read-more-fade'>Read more...</a></div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="clear"></div>
                        </div>

                        @if ($data->hasPages())
                            <ul class="pagination" style="list-style: none; display: inline-flex; align-items: center; float: right; font-variant: small-caps">
                                {{-- Previous Page Link --}}
                                @if ($data->onFirstPage())
                                    <li class="disabled" style="color: lightgrey"><span>{{ __('Prev') }}</span></li>
                                @else
                                    <li><a href="{{ $data->previousPageUrl() }}" rel="prev">{{ __('Prev') }}</a></li>
                                @endif

                                &nbsp;&nbsp; <small>{{ "Page " . $data->currentPage() . "  of  " . $data->lastPage() }}</small> &nbsp;&nbsp;

                                {{-- Next Page Link --}}
                                @if ($data->hasMorePages())
                                    <li><a href="{{ $data->nextPageUrl() }}" rel="next">{{ __('Next') }}</a></li>
                                @else
                                    <li class="disabled" style="color: lightgrey"><span>{{ __('Next') }}</span></li>
                                @endif
                            </ul>
                            <div style="clear: both; margin: 0; padding: 0"></div>
                        @endif
                    </div>
                    <footer class="entry-footer"></footer>
                </article>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
<script>
    function submitForm() {
        document.getElementById("categoryForm").submit();
    }
</script>

<script defer>
    // var map = L.map('map-canvas').setView([{{ $latitude }}, {{ $longitude }}], 14);
    var map = L.map('map-canvas').setView([{{ 50.8282 }}, {{ 12.9209 }}], 14);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 17,
        minZoom: 6
    }).addTo(map);

    var places = @json($mapData);

    for(place in places)
    {
        place = places[place];
        if(place.latitude && place.longitude)
        {
            const markerHtmlStyles = `
              background-color: ${place.color};
              width: 2rem;
              height: 2rem;
              display: block;
              left: -1.5rem;
              top: -1.5rem;
              position: relative;
              border-radius: 2rem 2rem 0;
              transform: rotate(45deg);
              border: 1px solid #FFFFFF
          `;

            const icon = L.divIcon({
                className: "my-custom-pin",
                iconAnchor: [0, 24],
                labelAnchor: [-6, 0],
                popupAnchor: [0, -36],
                html: `<span style="${markerHtmlStyles}" />`
            })

            var marker = L.marker([place.latitude, place.longitude], {
                icon: icon,
            }).addTo(map);
            marker.bindPopup(generateContent(place));
        }
    }

    function generateContent(place)
    {
        place.designation = place.designation ?? '';
        place.street      = place.street ?? '';
        var content = `
            <div class="gd-bubble" style="">
                <div class="gd-bubble-inside">
                    <div class="geodir-bubble_desc">
                    <div class="geodir-bubble_image">
                        <div class="geodir-post-slider">
                            <div class="geodir-image-container geodir-image-sizes-medium_large ">
                                <div id="geodir_images_5de53f2a45254_189" class="geodir-image-wrapper" data-controlnav="1">
                                    <ul class="clearfix" style="list-style: none">
                                        <li>
                                            <div class="geodir-post-title">
                                                <h4 class="geodir-entry-title">
                                                    <a href="{{ route('global-data.show', '') }}/`+place.id+`" title="View: `+place.designation+`">`+place.designation+`</a>
                                                </h4>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="geodir-bubble-meta-side">
                    <div class="geodir-output-location">
                    <div class="geodir-output-location geodir-output-location-mapbubble">
                        <div class="geodir_post_meta  geodir-field-address" itemscope="" itemtype="http://schema.org/PostalAddress">
                            <span class="geodir_post_meta_icon geodir-i-address"><i class="fas fa-map-marker-alt" aria-hidden="true"></i>
                            <span class="geodir_post_meta_title">Address: </span></span><span itemprop="streetAddress">`+place.street+`</span>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            </div>
            </div>
        `;

        return content;
    }

    $(document).ready(function () {
       $(`[id^='map-canvas-']`).each((id, mapMarkup) => {
           let color    = $(mapMarkup).attr('data-color');
           let loc      = $(mapMarkup).attr('data-loc').split(',');
           let lat      = loc[0];
           let lng      = loc[1];
           let mapId    = mapMarkup.getAttribute('id');
           let hasHomeAddress = false; //ToDo: Add Check Here;

           let map = L.map(mapId).setView([lat, lng], 17);
           L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
               maxZoom: 17,
               minZoom: 8
           }).addTo(map);

           if(hasHomeAddress){
               L.Routing.control({
                   waypoints: [
                       L.latLng(50.828032902010285, 12.923252354159501),
                       L.latLng(lat, lng)
                   ]
               }).addTo(map);
           }else{
               const markerHtmlStyles = `
              background-color: ${color};
              width: 2rem;
              height: 2rem;
              display: block;
              left: -1.5rem;
              top: -1.5rem;
              position: relative;
              border-radius: 2rem 2rem 0;
              transform: rotate(45deg);
              border: 1px solid #FFFFFF
          `;

               const icon = L.divIcon({
                   className: "my-custom-pin",
                   iconAnchor: [0, 24],
                   labelAnchor: [-6, 0],
                   popupAnchor: [0, -36],
                   html: `<span style="${markerHtmlStyles}" />`
               })

               let marker = L.marker([lat, lng], {
                   icon: icon
               }).addTo(map);
           }

       });
    });

    function markFavorite(id){
        let currentEle = event.target;
        let status     = Array.from(currentEle.classList).includes('fa-heart-o');

        $.ajax({
            type: "post",
            url: "{{route('mark-favorite')}}",
            data: {
                _token: "{{ csrf_token() }}",
                status: status,
                id: id,
            },
            success: (res) => {
                console.log(res);
                if(res.success){
                    if(res.status === true){
                        currentEle.classList.remove('fa-heart-o');
                        currentEle.classList.add('fa-heart');
                    }else{
                        currentEle.classList.remove('fa-heart');
                        currentEle.classList.add('fa-heart-o');
                    }
                }
                alert(res.message);
            }
        });
    }
</script>
@endsection
