@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="content-box content-single">
                    <article class="post-180 gd_place type-gd_place status-publish hentry gd_placecategory-hotels">
                        <header><h1 class="entry-title">{{ $globalData->designation }}</h1></header>
                        <div class="entry-content entry-summary">
                            <div class="geodir-single-tabs-container">
                                <div class="geodir-tabs" id="gd-tabs">
                                    <dl class="geodir-tab-head">
                                        <dt></dt>
                                        <dd class=""><a data-tab="#post_content"
                                                                         data-status="enable"><i class="fas fa-home"
                                                                                                 aria-hidden="true"></i>About</a>
                                        </dd>
                                        <dt></dt>
                                        @if($globalData->x && $globalData->y)
                                            <dd class="geodir-tab-active"><a data-tab="#post_map" data-status="enable"><i
                                                            class="fas fa-globe-americas" aria-hidden="true"></i>Map</a>
                                            </dd>
                                            <dt></dt>
                                        @endif
                                    </dl>
                                    <ul class="geodir-tabs-content geodir-entry-content "
                                        style="z-index: 0; position: relative;">
                                        <li id="post_contentTab" style="display: none;">
                                            <span id="post_content"></span>
                                            <div id="geodir-tab-content-post_content" class="hash-offset"></div>
                                            <div class="geodir-post-meta-container">
                                                <div class="geodir_post_meta  geodir-field-post_content">
                                                    <table>
                                                        <tbody>
                                                        @if($globalData->street)
                                                            <tr>
                                                                <td>Address:</td>
                                                                <td>{{ $globalData->street }}</td>
                                                            </tr>
                                                        @endif
                                                        @if($globalData->email)
                                                            <tr>
                                                                <td>Email:</td>
                                                                <td><a href="mailto:{{$globalData->email}}">Send email</a></td>
                                                            </tr>
                                                        @endif
                                                        @if($globalData->telephone)
                                                            <tr>
                                                                <td>Telephone:</td>
                                                                <td><a href="tel:{{$globalData->telephone}}">{{$globalData->telephone}}</a></td>
                                                            </tr>
                                                        @endif
                                                        @if($globalData->fax)
                                                            <tr>
                                                                <td>Fax:</td>
                                                                <td><a href="fax:{{$globalData->fax}}">{{ $globalData->fax }}</a></td>
                                                            </tr>
                                                        @endif
                                                        @if($globalData->carrier_sponsor)
                                                            <tr>
                                                                <td>Carrier/Sponsor:</td>
                                                                <td>{{ $globalData->carrier_sponsor }}</td>
                                                            </tr>
                                                        @endif
                                                        @if($globalData->designation)
                                                            <tr>
                                                                <td>Designation:</td>
                                                                <td>{{ $globalData->designation }}</td>
                                                            </tr>
                                                        @endif
                                                        @if($globalData->short_designation)
                                                            <tr>
                                                                <td>Short Designation:</td>
                                                                <td>{{ $globalData->short_designation }}</td>
                                                            </tr>
                                                        @endif
                                                        @if($globalData->services)
                                                            <tr>
                                                                <td>Services:</td>
                                                                <td>{{ $globalData->services }} </td>
                                                            </tr>
                                                        @endif
                                                        @if($globalData->street)
                                                            <tr>
                                                                <td>Street:</td>
                                                                <td>{{ $globalData->street }} </td>
                                                            </tr>
                                                        @endif
                                                        @if($globalData->street_code)
                                                            <tr>
                                                                <td>Street Code:</td>
                                                                <td>{{ $globalData->street_code }} </td>
                                                            </tr>
                                                        @endif
                                                        @if($globalData->house_designation)
                                                            <tr>
                                                                <td>House Designation:</td>
                                                                <td>{{ $globalData->house_designation }} </td>
                                                            </tr>
                                                        @endif
                                                        @if($globalData->postal_code)
                                                            <tr>
                                                                <td>Postal Code:</td>
                                                                <td>{{ $globalData->postal_code }} </td>
                                                            </tr>
                                                        @endif
                                                        @if($globalData->city_town)
                                                            <tr>
                                                                <td>City:</td>
                                                                <td>{{ $globalData->city_town }} </td>
                                                            </tr>
                                                        @endif
                                                        @if($globalData->after_school_care)
                                                            <tr>
                                                                <td>After School Care:</td>
                                                                <td>{{ $globalData->after_school_care? 'Yes' : 'No' }} </td>
                                                            </tr>
                                                        @endif
                                                        @if($globalData->daycare)
                                                            <tr>
                                                                <td>Day Care:</td>
                                                                <td>{{ $globalData->daycare? 'Yes' : 'No' }} </td>
                                                            </tr>
                                                        @endif
                                                        @if($globalData->url)
                                                            <tr>
                                                                <td>URL:</td>
                                                                <td><a href="//{{ $globalData->url }} " target="_blank">Goto Link</a></td>
                                                            </tr>
                                                        @endif
{{--                                                        @if($globalData->type)--}}
{{--                                                            <tr>--}}
{{--                                                                <td>Type:</td>--}}
{{--                                                                <td>{{ $globalData->type }} </td>--}}
{{--                                                            </tr>--}}
{{--                                                        @endif--}}
                                                        @if($globalData->kind)
                                                            <tr>
                                                                <td>Kind:</td>
                                                                <td>{{ $globalData->kind }} </td>
                                                            </tr>
                                                        @endif
{{--                                                        @if($globalData->location_type)--}}
{{--                                                            <tr>--}}
{{--                                                                <td>Location Type:</td>--}}
{{--                                                                <td>{{ $globalData->location_type }} </td>--}}
{{--                                                            </tr>--}}
{{--                                                        @endif--}}
                                                        @if($globalData->additional_designation)
                                                            <tr>
                                                                <td>Additional Designation:</td>
                                                                <td>{{ $globalData->additional_designation }} </td>
                                                            </tr>
                                                        @endif
                                                        @if($globalData->profile)
                                                            <tr>
                                                                <td>Profile:</td>
                                                                <td>{{ $globalData->profile }} </td>
                                                            </tr>
                                                        @endif
                                                        @if($globalData->languages)
                                                            <tr>
                                                                <td>Languages:</td>
                                                                <td>{{ $globalData->languages }} </td>
                                                            </tr>
                                                        @endif
                                                        @if($globalData->website)
                                                            <tr>
                                                                <td>Website:</td>
                                                                <td><a href="//{{ $globalData->website }} " target="_blank">Link</a></td>
                                                            </tr>
                                                        @endif
                                                        @if($globalData->creator)
                                                            <tr>
                                                                <td>Creator:</td>
                                                                <td>{{ $globalData->creator }} </td>
                                                            </tr>
                                                        @endif
                                                        @if($globalData->editor)
                                                            <tr>
                                                                <td>Editor:</td>
                                                                <td>{{ $globalData->editor }} </td>
                                                            </tr>
                                                        @endif
                                                        @if($globalData->edit_date)
                                                            <tr>
                                                                <td>Edit Date:</td>
                                                                <td>{{ $globalData->edit_date }} </td>
                                                            </tr>
                                                        @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </li>
                                        @if($globalData->x && $globalData->y)
                                            <li id="post_mapTab" style="display: none;">
                                                <div id="map-canvas"
                                                     style="height: 425px; width: 100%; position: relative; overflow: hidden;">
                                                </div>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
    <script type="text/javascript">
        if (window.location.hash && window.location.hash.indexOf('&') === -1 && jQuery(window.location.hash + 'Tab').length) {
            hashVal = window.location.hash;
        } else {
            hashVal = jQuery('dl.geodir-tab-head dd.geodir-tab-active').find('a').attr('data-tab');
        }
        openTab(hashVal);

        jQuery('dl.geodir-tab-head dd a').click(function () {
            openTab(jQuery(this).data('tab'))
        });

        function openTab(hashVal) {
            jQuery('dl.geodir-tab-head dd').each(function () {
                var tab = '';
                tab = jQuery(this).find('a').attr('data-tab');
                jQuery(this).removeClass('geodir-tab-active');
                if (hashVal != tab) {
                    jQuery(tab + 'Tab').hide();
                }
            });
            jQuery('a[data-tab="' + hashVal + '"]').parent().addClass('geodir-tab-active');
            jQuery(hashVal + 'Tab').show();
        }

        $(function () {
            $('.bxslider').bxSlider({
                mode: 'fade',
                slideWidth: 600
            });
        });
    </script>
    @if($globalData->x && $globalData->y)
        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
        <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
        <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
        <script defer>
            let latitude  = @json($globalData->x);
            let longitude = @json($globalData->y);
            let homeAddress = @json($address);

            const map = L.map('map-canvas').setView([latitude, longitude], 14);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',{
                maxZoom: 17,
                minZoom: 6
            }).addTo(map);

            if(homeAddress){
                L.Routing.control({
                    waypoints: [
                        L.latLng(homeAddress.latitude, homeAddress.longitude),
                        L.latLng(latitude, longitude)
                    ]
                }).addTo(map);
            }else{
                let marker = L.marker([latitude, longitude]).addTo(map);
            }
        </script>
    @endif
@endsection