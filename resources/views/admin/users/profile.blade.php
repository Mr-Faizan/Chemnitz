@extends('layouts.admin')
@section('styles')
 <!-- Leaflet CSS -->
 <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

<!-- Leaflet Control Geocoder CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />

<style>
    .address-input {
        width: 300px;
        padding: 8px;
        font-size: 14px;
    }
    .address-list {
        list-style-type: none;
        padding: 0;
    }
    .address-list-item {
        cursor: pointer;
        padding: 8px;
        background-color: #f0f0f0;
        border: 1px solid #ccc;
        margin-bottom: 5px;
    }
    .address-list-item:hover {
        background-color: #e0e0e0;
    }
    .no-results {
        font-style: italic;
        color: #888;
        margin-top: 5px;
    }
</style>

<style>
    .custom-select-container {
        position: relative;
    }

    #custom-select-input {
        width: 100%;
        box-sizing: border-box;
    }

    .custom-select-dropdown {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        max-height: 200px;
        overflow-y: auto;
        border: 1px solid #ccc;
        background-color: #fff;
        z-index: 1000;
    }

    .custom-select-option {
        padding: 10px;
        cursor: pointer;
    }

    .custom-select-option:hover {
        background-color: #f0f0f0;
    }
</style>
@endsection

@section('content')
<div class="card">
    <div class="card-header bg-dark">
        My Profile
    </div>

    <div class="card-body">
        <form action="{{route('admin.users.profile.update')}}" method="post">
            @csrf()
            <div class="container">
                <div class="row">
                    <div class="form-group col-6">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" placeholder="i.e John" value="{{old('name') ?? auth()->user()->name}}">
                    </div>
                    <div class="form-group col-6">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control" placeholder="i.e john@example.com" value="{{old('email') ?? auth()->user()->email}}">
                    </div>
                    <div class="form-group col-6">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="i.e Password">
                    </div>
                </div>
                <input type="submit" class="btn btn-primary float-right" value="Update">
            </div>
        </form>
    </div>
</div>
<div class="card">
    <div class="card-header bg-dark">
        My Addresses
    </div>
    <div class="card-body">
        <form action="{{route('add-home')}}" method="post" style="clear: both">
            @csrf()

            <input type="hidden" id="latitude" name="latitude" class="form-control">
            <input type="hidden" id="longitude" name="longitude" class="form-control">

            <div class="row">
                <div class="form-group col-12">
                    <label>Home Address</label>
                    <div class="custom-select-container">
                        <input type="text" name="address" required id="addressInput" class="form-control" placeholder="Search...">
                        <ul id="addressList" class="address-list"></ul>
                        <p id="noResultsMessage" class="no-results" style="display: none;">Address not found.</p>
                    </div>
                </div>
            </div>
            <input type="submit" class="btn btn-primary float-right" value="Add">


        </form>
        <br>
        <br>
        <table class="table">
            <thead class="bg-dark">
                <tr>
                    <th>Address</th>
                    <th>Is Default?</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse(auth()->user()->addresses as $address)
                <tr>
                    <td>{{$address->address}}</td>
                    <td>
                        <form id="address_form_{{$address->id}}" action="{{route('add-home')}}" method="post">
                            @csrf()
                            <input type="hidden" name="address_id" value="{{$address->id}}">
                            <input type="checkbox" name="is_default" id="" class="form-check" {{$address->is_default? 'checked' : ''}}>
                        </form>
                    </td>
                    <td width="10%">
                        <button type="submit" class="btn btn-primary" form="address_form_{{$address->id}}" title="Update"><i class="fas fa-floppy-o"></i></button>
                        <a href="{{route('remove-home', $address->id)}}" class="btn btn-danger" title="Delete"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3">
                        <p class="text-center text-muted"><small>No Data To Show</small></p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="card">
    <div class="card-header bg-dark">
        My Favorites
    </div>
    <div class="card-body">
        @foreach(auth()->user()->favorites as $globalData)
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
                @if($globalData->type)
                <tr>
                    <td>Type:</td>
                    <td>{{ $globalData->type }} </td>
                </tr>
                @endif
                @if($globalData->kind)
                <tr>
                    <td>Kind:</td>
                    <td>{{ $globalData->kind }} </td>
                </tr>
                @endif
                @if($globalData->location_type)
                <tr>
                    <td>Location Type:</td>
                    <td>{{ $globalData->location_type }} </td>
                </tr>
                @endif
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
                <tr>
                    <td colspan="2">
                        <a href="{{ route('global-data.show', $globalData->id) }}" class="btn btn-light float-right">GoTo Map</a>
                    </td>
                </tr>
            </tbody>
        </table>
        <hr>
        
        @endforeach
    </div>
</div>
@endsection
@section('scripts')
-- Leaflet JavaScript -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<!-- Leaflet Control Geocoder JavaScript -->
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

<script>
    var geocoder = L.Control.Geocoder.nominatim();

    document.getElementById('addressInput').addEventListener('input', function() {
        var query = this.value.trim();
        if (query.length > 2) {
            geocoder.geocode(query, function(results) {
                displayAddressResults(results);
            });
        } else {
            clearAddressList();
            hideNoResultsMessage();
        }
    });

    function displayAddressResults(results) {
        clearAddressList();

        var addressList = document.getElementById('addressList');
        if (results.length === 0) {
            showNoResultsMessage();
        } else {
            hideNoResultsMessage();
            results.forEach(function(result) {
                var li = document.createElement('li');
                li.textContent = result.name;
                li.className = 'address-list-item';
                li.addEventListener('click', function() {
                    setAddress(result);
                });
                addressList.appendChild(li);
            });
        }
    }

    function clearAddressList() {
        var addressList = document.getElementById('addressList');
        addressList.innerHTML = '';
    }

    function showNoResultsMessage() {
        document.getElementById('noResultsMessage').style.display = 'block';
    }

    function hideNoResultsMessage() {
        document.getElementById('noResultsMessage').style.display = 'none';
    }

    function setAddress(result) {
        document.getElementById('addressInput').value = result.name;
        document.getElementById('latitude').value = result.center.lat;
        document.getElementById('longitude').value = result.center.lng;
        console.log('Coordinates:', result.center);
        clearAddressList();
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById('custom-select-input');
        const dropdown = document.getElementById('custom-select-dropdown');
        const latitude = document.getElementById('latitude');
        const longitude = document.getElementById('longitude');

        input.addEventListener('input', function() {
            const query = input.value;

            latitude.value = '';
            longitude.value = '';


            if (query.length >= 3) { // Only send request if query is at least 3 characters long
                fetchNames(query);
            } else {
                dropdown.innerHTML = ''; // Clear dropdown if query is too short
            }
        });

        function fetchNames(query) {
            const url = `http://fsp.test/api/fetch-name?q=${encodeURIComponent(query)}`; // Update with your API endpoint

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    console.log({
                        data
                    });
                    populateDropdown(data);
                })
                .catch(error => {
                    console.error('Error fetching names:', error);
                });
        }

        function populateDropdown(places) {
            dropdown.innerHTML = ''; // Clear previous results

            places.forEach(place => {
                const option = document.createElement('div');
                option.className = 'custom-select-option';
                option.textContent = place.display_name;
                option.addEventListener('click', () => {
                    input.value = place.display_name;
                    dropdown.innerHTML = '';

                    latitude.value = parseFloat(place.lat);
                    longitude.value = parseFloat(place.lon);

                });
                dropdown.appendChild(option);
            });
        }
    });
</script>
@endsection