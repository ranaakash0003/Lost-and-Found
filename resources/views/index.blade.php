<!DOCTYPE html>
<html lang="en">
<head>
  <title>result</title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>    
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
  </style>
</head>
<body>
    <style>
        table, td, th {    
            border: 1px solid #ddd;
            text-align: left;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            padding: 15px;
        }

        .column1{
            float: left;
            width: 20%;
            
            height: 180px; 
        }
        .column2{
            float: left;
            width: 25%;
            padding: 10px;
            height: 150px; 
        }
         .column3{
            float: left;
            width: 30%;
            padding: 10px;
            height: 150px; 

        }
        
        .vl {
              border-left: 1px solid black;
              height: 120px;
          }

          hr{
            color: black;
            background-color: black
          }
}
       
      
    </style>
<div class="container-fluid">
        
        <p>Showing result</p>
        <div class="row">

          <div class="col-sm-7 jumbotron" style="background-color:#c6e6c3;">
          
           {{-- <table class="table.table-hover"> --}}

                    @php
                        //  $postAll = $postAll;
                         $posts = json_encode($postAll, true);

                         echo '<div id="data" style="display:none">' .$posts. '</div>';
                         
                    @endphp
                   
                   {{-- {{$posts}} --}}

                  @foreach ($post as $post)
                   

                      <div class="row" style="background-color:#68d162;">

                          <div class="column1">
                            <img src="{{ $post->image }}" alt="{{ $post->title }}" height="180" width="180">
                          </div><br>

                          <div class="column2" style="background-color:#68d162;">
                            -<i>found by</i> <b>{{$post->user->name}}</b></b><br><br>
                            <b>Found: </b> {{$post->found}}<br>
                            <b>Contact: </b>{{$post->contact}}<br>
                            <b>Date: </b> {{$post->created_at->diffForHumans()}}

                          </div>

                          <div class="column3 vl" style="background-color:#68d162;">
                            <b>Location: </b><br>{{$post->place}}<br><br>
                            <a href="#" class="btn btn-primary">Claim!</a>
                             
                              
                          </div>
                      </div>
                      <hr>


        
                    
               @endforeach 
               
            

          </div>
          
        
          
          <div class="col-sm-5" style="background-color:#68d162;">
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
                             
                                
                                <div class="class-row">
                                  
                                  {{-- <input type="hidden" name="lat" id="lat">
                                  <input type="hidden" name="lng" id="lng">
                                  <input type="hidden" name="place" id="place"> --}}
                          
                              <div class="form-group">
                                    
                                  <input id="pac-input" class="form-control" type="text" placeholder="Enter a location">
                                </div>
                                 
                                 
                                <div class="container" id="map" style="height: 1000px;width:900px"></div>
                              
                                  </div>
                                
                               
                               
                                <script>
                                        // This example requires the Places library. Include the libraries=places
                                        // parameter when you first load the API. For example:
                                        // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">



                                          var cureentpos;
                                          var map ;
                                          var geocoder; 
                                       

                                            function initMap() {
                                              var map = new google.maps.Map(document.getElementById('map'), {
                                                center: {lat: -34.397, lng: 150.644},
                                                zoom: 12
                                              });

                                         
                                                      // Try HTML5 geolocation.
                                                      if (navigator.geolocation) {
                                                                navigator.geolocation.getCurrentPosition(function(position) {
                                                                  cureentpos = {
                                                                    lat: position.coords.latitude,
                                                                    lng: position.coords.longitude
                                                                  };

                                                                  infoWindow.setPosition(cureentpos);
                                                                  infoWindow.setContent('Location found.');
                                                                  infoWindow.open(map);
                                                                  map.setCenter(cureentpos);
                                                                }, function() {
                                                                  handleLocationError(true, infoWindow, map.getCenter());
                                                                });
                                                              } else {
                                                                // Browser doesn't support Geolocation
                                                                handleLocationError(false, infoWindow, map.getCenter());
                                                              }
 


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
                                              position: cureentpos
                                            });
                                    

                                          // var data =document.getElementById('data').innerHTML;
                                          // console.log(JSON.parse(data));



                                          var data = JSON.parse(document.getElementById('data').innerHTML);
                                          geocoder = new google.maps.Geocoder();
                                          codeAddress(data);
                                          

                                          


                                           function codeAddress(data) {
                                              var infoWind = new google.maps.InfoWindow;
                                            Array.prototype.forEach.call(data, function(data){
                                                 var content = document.createElement('div');
                                                 var strong = document.createElement('strong');
                                                 var img = document.createElement('img');

                                                  
                                                  img.style.width = '70px';
                                                  img.src = data.image;
                                                  content.appendChild(img);

                                                 strong.textContent = data.details;
                                                 content.appendChild(strong);

                                                 var address = data.found + ' ' + data.place;
                                                  
                                                  geocoder.geocode( { 'address': address}, function(results, status) {
                                                    if (status == 'OK') {
                                                      map.setCenter(results[0].geometry.location);
                                                      var points = {};
                                                      points.id = data.id;
                                                      points.lat = map.getCenter().lat();
                                                      points.lng = map.getCenter().lng();
                                                      console.log(data.lat,data.lng);

                                                       var marker = new google.maps.Marker({
                                                        map: map,
                                                        position: new google.maps.LatLng(data.lat , data.lng)
                                                      });

                                                        marker.addListener('mouseover' , function(){
                                                                  infoWind.setContent(content);
                                                                  infoWind.open(map,marker);
                                                        });

                                                        //   tableRow.addListener('mouseover' , function(){
                                                        //           infoWind.setContent(content);
                                                        //           infoWind.open(map,marker);
                                                        // });
                                                    } 

                                                    else{
                                                      alert('Geocode was not successful for the following reason: ' + status);
                                                      console.log('Geocode was not successful for the following reason: ' + status);
                                                    }

                                                  });


                                                   

                                                });
                                                }



    



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
                                  
                            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCR5PFyvraK8Cqbu-vQu7UAR-NkcABHNuw&libraries=places&callback=initMap"async defer></script>

          
          </div>
          
          
        </div>
      </div>

</body>
</html>