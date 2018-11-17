@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
  
                <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">
                        @csrf

                        {{-- <div>
                            <label for="name">Found</label>
                            <input id="name" type="text" name="name" placeholder="User Name" class="validate" required>
                         </div> --}}

                        <div class="form-group row">
                            <label for="found" class="col-md-4 col-form-label text-md-right">{{ __('FOUND') }}</label>

                            <div class="col-md-6">
                                <input id="found" type="text" class="form-control{{ $errors->has('found') ? ' is-invalid' : '' }}" name="found" value="{{ old('found') }}" required autofocus>

                                @if ($errors->has('found'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('found') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                            <div class="form-group row">
                                    <label for="details" class="col-md-4 col-form-label text-md-right">{{ __('DESCRIPTION') }}</label>
        
                                    <div class="col-md-6">
                                        {{-- <input id="details" type="text" class="form-control{{ $errors->has('details') ? ' is-invalid' : '' }}" name="details" value="{{ old('details') }}" required autofocus>  --}}
                                        
                                        <textarea name="details" id="details" cols="10" rows="10" class="form-control{{ $errors->has('details') ? ' is-invalid' : '' }}" name="details" value="{{ old('details') }}" required autofocus></textarea>

                                        @if ($errors->has('details'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('details') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                        <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('IMAGE') }}</label>
            
                                        <div class="col-md-6">
                                            <input id="image" type="file" class="form-control{{ $errors->has('place') ? ' is-invalid' : '' }}" name="image" value="{{ old('image') }}" autofocus>
            
                                            @if ($errors->has('image'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('image') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                <div class="form-group row">
                                        <label for="contact" class="col-md-4 col-form-label text-md-right">{{ __('CONTACT') }}</label>
            
                                        <div class="col-md-6">
                                            <input id="contact" type="text" class="form-control{{ $errors->has('contact') ? ' is-invalid' : '' }}" name="contact" value="{{ old('contact') }}" required autofocus>
            
                                            @if ($errors->has('contact'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('contact') }}</strong>
                                                </span>
                                            @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                        <label for="place" class="col-md-4 col-form-label text-md-right">{{ __('PLACE') }}</label>
            
                                        <div class="col-md-6">
                                            <input id="place" type="text" class="form-control{{ $errors->has('place') ? ' is-invalid' : '' }}" name="place" value="{{ old('place') }}" required autofocus>
            
                                            @if ($errors->has('place'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('place') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                <div class="form-group row">
                                        <label for="lat" class="col-md-4 col-form-label text-md-right">{{ __('LATITUDE') }}</label>
            
                                        <div class="col-md-6">
                                            <input id="lat" type="text" class="form-control{{ $errors->has('lat') ? ' is-invalid' : '' }}" name="lat" value="{{ old('lat') }}" required autofocus>
            
                                            @if ($errors->has('lat'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('lat') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                            <label for="lng" class="col-md-4 col-form-label text-md-right">{{ __('LONGITUDE') }}</label>
                
                                            <div class="col-md-6">
                                                <input id="lng" type="text" class="form-control{{ $errors->has('lng') ? ' is-invalid' : '' }}" name="lng" value="{{ old('lng') }}" required autofocus>
                
                                                @if ($errors->has('lng'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('lng') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <head>
                                        <style>
                                                /* Always set the map height explicitly to define the size of the div
                                                 * element that contains the map. */
                                                #map {
                                                  height: 100%;
                                                }
                                                /* Optional: Makes the sample page fill the window. */
                                                html, body {
                                                  height: 100%;
                                                  margin: 0;
                                                  padding: 0;
                                                }
                                                #description {
                                                  font-family: Roboto;
                                                  font-size: 15px;
                                                  font-weight: 300;
                                                }
                                          
                                                #infowindow-content .title {
                                                  font-weight: bold;
                                                }
                                          
                                                #infowindow-content {
                                                  display: none;
                                                }
                                          
                                                #map #infowindow-content {
                                                  display: inline;
                                                }
                                          
                                                .pac-card {
                                                  margin: 10px 10px 0 0;
                                                  border-radius: 2px 0 0 2px;
                                                  box-sizing: border-box;
                                                  -moz-box-sizing: border-box;
                                                  outline: none;
                                                  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
                                                  background-color: #fff;
                                                  font-family: Roboto;
                                                }
                                          
                                                #pac-container {
                                                  padding-bottom: 12px;
                                                  margin-right: 12px;
                                                }
                                          
                                                .pac-controls {
                                                  display: inline-block;
                                                  padding: 5px 11px;
                                                }
                                          
                                                .pac-controls label {
                                                  font-family: Roboto;
                                                  font-size: 13px;
                                                  font-weight: 300;
                                                }
                                          
                                                #pac-input {
                                                  background-color: #fff;
                                                  font-family: Roboto;
                                                  font-size: 15px;
                                                  font-weight: 300;
                                                  margin-left: 12px;
                                                  padding: 0 11px 0 13px;
                                                  text-overflow: ellipsis;
                                                  width: 400px;
                                                }
                                          
                                                #pac-input:focus {
                                                  border-color: #4d90fe;
                                                }
                                          
                                                #title {
                                                  color: #fff;
                                                  background-color: #4d90fe;
                                                  font-size: 25px;
                                                  font-weight: 500;
                                                  padding: 6px 12px;
                                                }
                                              </style>
                                            </head>
                                            <body>
                                              <br>
                                              <div class="container">
                                                
                                                <div class="class-row">
                                                  
                                                  {{-- <input type="hidden" name="lat" id="lat">
                                                  <input type="hidden" name="lng" id="lng">
                                                  <input type="hidden" name="place" id="place"> --}}

                                                  <div class="form-group">
                                                        <label for="usr">Location:</label>
                                                        {{-- <input type="text" class="form-control" id="usr"> --}}
                                                     
                                                  <input id="pac-input" class="form-control" type="text" placeholder="Enter a location">
                                                </div>
                                                 
                                                <div class="container" id="map" style="height: 400px;width:600px"></div>
                                              
                                                  </div>
                                                </div>
                                               
                                               
                                                <script>
                                                        // This example requires the Places library. Include the libraries=places
                                                        // parameter when you first load the API. For example:
                                                        // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
                                                  
                                                        function initMap() {
                                                          var map = new google.maps.Map(document.getElementById('map'), {
                                                            center: {lat: -33.8688, lng: 151.2195},
                                                            zoom: 13
                                                          });
                                                          var input = /** @type {!HTMLInputElement} */(
                                                              document.getElementById('pac-input'));
                                                  
                                                          var types = document.getElementById('type-selector');
                                                          map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
                                                          map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);
                                                  
                                                          var autocomplete = new google.maps.places.Autocomplete(input);
                                                          autocomplete.bindTo('bounds', map);
                                                  
                                                          var infowindow = new google.maps.InfoWindow();
                                                          var marker = new google.maps.Marker({
                                                            map: map,
                                                            anchorPoint: new google.maps.Point(0, -29)
                                                          });
                                                  
                                                          autocomplete.addListener('place_changed', function() {
                                                            infowindow.close();
                                                            marker.setVisible(false);
                                                            var place = autocomplete.getPlace();
                                                            if (!place.geometry) {
                                                              // User entered the name of a Place that was not suggested and
                                                              // pressed the Enter key, or the Place Details request failed.
                                                              window.alert("No details available for input: '" + place.name + "'");
                                                              return;
                                                            }
                                                  
                                                            // If the place has a geometry, then present it on a map.
                                                            if (place.geometry.viewport) {
                                                              map.fitBounds(place.geometry.viewport);
                                                            } else {
                                                              map.setCenter(place.geometry.location);
                                                              map.setZoom(17);  // Why 17? Because it looks good.
                                                            }
                                                            marker.setIcon(/** @type {google.maps.Icon} */({
                                                              url: place.icon,
                                                              size: new google.maps.Size(71, 71),
                                                              origin: new google.maps.Point(0, 0),
                                                              anchor: new google.maps.Point(17, 34),
                                                              scaledSize: new google.maps.Size(35, 35)
                                                            }));
                                                            marker.setPosition(place.geometry.location);
                                                            marker.setVisible(true);
                                                  var item_Lat =place.geometry.location.lat();
                                                  var item_Lng= place.geometry.location.lng();
                                                  var item_Location = place.formatted_address;
                                                  //alert("Lat= "+item_Lat+"_____Lang="+item_Lng+"_____Location="+item_Location);
                                                  $("#lat").val(item_Lat);
                                                  $("#lng").val(item_Lng);
                                                  $("#place").val(item_Location);
                                                  
                                                  
                                                  
                                                            var address = '';
                                                            if (place.address_components) {
                                                              address = [
                                                                (place.address_components[0] && place.address_components[0].short_name || ''),
                                                                (place.address_components[1] && place.address_components[1].short_name || ''),
                                                                (place.address_components[2] && place.address_components[2].short_name || '')
                                                              ].join(' ');
                                                            }
                                                  
                                                            infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
                                                            infowindow.open(map, marker);
                                                          });
                                                  
                                                          // Sets a listener on a radio button to change the filter type on Places
                                                          // Autocomplete.
                                                          function setupClickListener(id, types) {
                                                            var radioButton = document.getElementById(id);
                                                            radioButton.addEventListener('click', function() {
                                                              autocomplete.setTypes(types);
                                                            });
                                                          }
                                                  
                                                          setupClickListener('changetype-all', []);
                                                          setupClickListener('changetype-address', ['address']);
                                                          setupClickListener('changetype-establishment', ['establishment']);
                                                          setupClickListener('changetype-geocode', ['geocode']);
                                                        }
                                                      </script>
                                                  
                                            <script src="https://maps.googleapis.com/maps/api/js?key=&libraries=places&callback=initMap"
                                                  async defer></script>
                                                  
                        <br><br>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('SUBMIT') }}
                                </button>
                            </div>
                        </div>
                    </form>


                </div>

            </div>
        </div>
    </div>
</div>
@endsection
