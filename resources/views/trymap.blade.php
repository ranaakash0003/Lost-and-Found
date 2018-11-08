<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Lost and Found') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
     <link href="{{ asset('css/app.css') }}" rel="stylesheet">
     {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"> --}}

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
        <div class="row"><div class="col-lg-6 alert alert-info">Google Map autocomplete Example</div></div>
        <form method="post" action="">
          <div class="row">
                    <div class="col col-lg-6">
                        Name
                        <input type="text" name="name" class="form-control"><br>
      
                       <input type="hidden" name="lat" id="lat">
                       <input type="hidden" name="lng" id="lng">
                       <input type="hidden" name="location" id="location">
      
                        <input id="pac-input" class="controls" type="text"
                    placeholder="Enter a location">
                <div id="type-selector" class="controls">
                  <input type="radio" name="type" id="changetype-all" checked="checked">
                  <label for="changetype-all">All</label>
      
                  
                </div>
                <div id="map" style="height: 400px;width: 600px"></div>
      
                <input type="submit" name="submit" value="Save" class="form-control btn btn-primary">
                  </div>
            </div><!--End of row-->
        </form>
      </div><!--End of container-->
      <script>
            // This example requires the Places library. Include the libraries=places
            // parameter when you first load the API. For example:
            // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places"> 
            var bd = {lat: 23.6850, lng: 90.3563};
            function initMap() {
              var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 23.6850, lng: 90.3563},
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
                position: bd
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
      alert("Lat= "+item_Lat+"_____Lang="+item_Lng+"_____Location="+item_Location);
      $("#lat").val(item_Lat);
      $("#lng").val(item_Lng);
      $("#location").val(item_Location);
      
      
      
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
          <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCR5PFyvraK8Cqbu-vQu7UAR-NkcABHNuw&libraries=places&callback=initMap"
              async defer></script>
      </body>
      </html>
      
    {{-- </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAFQ-M775EPUmkez2Yxy4fWVueysRgL5mY&libraries=places&callback=initMap"
        async defer></script>
  </body>
</html> --}}