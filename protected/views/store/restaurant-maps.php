
<div class="sections section-order-history">

<div class="container bruncherry-container section-recent-orders">
<div class="store-topbar">
    <div class="resto-info">
      <div class="trim-text text-center"><a class="pull-left" href="/profile"><i class="ion-ios-arrow-back"></i></a>Nearby Restaurants</div>
    </div>
</div>
<div id="map" style="height:100%;"></div>
<script type="text/javascript">
  var markLocations = function(position, locations) {
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        center: new google.maps.LatLng(position.coords.latitude, position.coords.longitude),
        mapTypeId: google.maps.MapTypeId.ROADMAP
      });

      var noPoi = [
        {
          featureType: "poi.business",
          elementType: "labels",
          stylers: [
            { visibility: "off" }
          ]
        }
      ];

      map.setOptions({styles: noPoi});

      var infowindow = new google.maps.InfoWindow();

      var marker, i;

      if (locations) {
        //  Create a new viewpoint bound
        var bounds = new google.maps.LatLngBounds ();
        for (i = 0; i < locations.length; i++) { 
          var latLng = new google.maps.LatLng(locations[i]["latitude"], locations[i]["lontitude"]); 
          marker = new google.maps.Marker({
            position: latLng,
            map: map
          });

          //  And increase the bounds to take this point
          bounds.extend(latLng);

          google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
              infowindow.setContent(locations[i]["restaurant_name"]);
              infowindow.open(map, marker);
              window.location.href = "/menu-" + locations[i]['restaurant_slug'];
            }
          })(marker, i));
        }
        map.fitBounds(bounds);
        zoomChangeBoundsListener = 
          google.maps.event.addListenerOnce(map, 'bounds_changed', function(event) {
            if (this.getZoom()){
              this.setZoom(16);
            }
        });
        setTimeout(function(){google.maps.event.removeListener(zoomChangeBoundsListener)}, 2000);
      }
  }

  var showLocationMarker = function(position) {
    var userLat = position.coords.latitude;
    var userLng = position.coords.longitude;
    busy(true);
    $.ajax({    
      type: "POST",
      url: ajax_url,
      data: "action=getNearbyRestaurants&lat="+userLat+"&lng="+userLng,
      dataType: 'json',       
      success: function(data){
        console.log(data);
        busy(false);      
        markLocations(position, data.details);
      }, 
      error: function(){	        	    	
        busy(false);
        markLocations(position);
      }	
    });
  }

  var apiGeolocationSuccess = function(position) {
      // alert("API geolocation success!\n\nlat = " + position.coords.latitude + "\nlng = " + position.coords.longitude);
      showLocationMarker(position);
  };

  var tryAPIGeolocation = function() {
    <?php $apikey=getOptionA('google_geo_api_key');?>
    jQuery.post( "https://www.googleapis.com/geolocation/v1/geolocate?key=<?php echo $apikey?>", function(success) {
          apiGeolocationSuccess({coords: {latitude: success.location.lat, longitude: success.location.lng}});
    })
    .fail(function(err) {
      // alert("API Geolocation error! \n\n"+err);
      apiGeolocationSuccess({coords: {latitude: '19.210831', longitude: '72.874741'}});
    });
  };

  var browserGeolocationSuccess = function(position) {
      // alert("Browser geolocation success!\n\nlat = " + position.coords.latitude + "\nlng = " + position.coords.longitude);
      showLocationMarker(position);
  };

  var browserGeolocationFail = function(error) {
    switch (error.code) {
      case error.TIMEOUT:
        alert("Browser geolocation error !\n\nTimeout.");
        break;
      case error.PERMISSION_DENIED:
        if(error.message.indexOf("Only secure origins are allowed") == 0) {
          tryAPIGeolocation();
        }
        break;
      case error.POSITION_UNAVAILABLE:
        alert("Browser geolocation error !\n\nPosition unavailable.");
        break;
    }
  };

  var tryGeolocation = function() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(
        browserGeolocationSuccess,
        browserGeolocationFail,
        {maximumAge: 50000, timeout: 20000, enableHighAccuracy: true});
    }
  };

  tryGeolocation();
</script>