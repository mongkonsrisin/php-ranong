<!-- css -->
<?php require_once('./head.php') ?>

<!-- database -->
<?php require_once('./db_config.php') ?>

<style>
 /*style the box which holds the text of the information window*/
 #map {
    height: 1050px;
    width: 100%;
    text-align: left;
    margin-top: 0px;
    margin-left: 25px;
}
 .gm-style-iw {
  width: 220px ;
  top: 15px !important;
  left: 0px !important;
  background-color: #fff;
  box-shadow: 0 1px 6px rgba(178, 178, 178, 0.6);
  border: 1px solid #29B6F6;
  border-radius: 10px 10px 10px 10px;
  padding: 10px;
}
#iw-container {
  margin-bottom: 10px;
}
#iw-container .iw-title {
  font-family: 'Open Sans Condensed', sans-serif;
  font-size: 22px;
  font-weight: 400;
  padding: 10px;
  background-color: #48b5e9;
  color: white;
  margin: 0;
  border-radius: 2px 2px 0 0;
}
#iw-container .iw-content {
  font-size: 13px;
  line-height: 18px;
  font-weight: 400;
  margin-right: 1px;
  padding: 15px 5px 20px 15px;
  max-height: 140px;
  overflow-y: auto;
  overflow-x: hidden;
}
.iw-content img {
  float: right;
  margin: 0 5px 5px 10px;
}
.iw-subTitle {
  font-size: 16px;
  font-weight: 700;
  padding: 5px 0;
}
.iw-bottom-gradient {
  position: absolute;
  width: 326px;
  height: 25px;
  bottom: 10px;
  right: 18px;
  background: linear-gradient(to bottom, rgba(255,255,255,0) 0%, rgba(255,255,255,1) 100%);
  background: -webkit-linear-gradient(top, rgba(255,255,255,0) 0%, rgba(255,255,255,1) 100%);
  background: -moz-linear-gradient(top, rgba(255,255,255,0) 0%, rgba(255,255,255,1) 100%);
  background: -ms-linear-gradient(top, rgba(255,255,255,0) 0%, rgba(255,255,255,1) 100%);
}

@media (max-width: 575px){
  #map {
    height: 350px;
    width: 100%;
    text-align: left;
    margin-left: 0px;
    top:-70px;
}
}
</style>


<script type="text/javascript">
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-7243260-2']);
_gaq.push(['_trackPageview']);
(function() {
var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})(
);

</script>





<!-- section left -->
<div class="content" style="margin-top:135px;">
  <div class="row">
    <div class="col-12 col-sm-6 col-md-6 col-lg-4">
      <div class="to">
      <?php 

      $sql = "SELECT * FROM tbl_poi WHERE poi_show = 1";
      $result = mysqli_query($con,$sql);
      $i =1;
      while($row = mysqli_fetch_assoc($result)) {
        
          ?>

      <div class="carousel-item <?php echo ($i==1)?'active':'';?>">

      </div>

      <?php $i++;  } ?>

        <div id="map"></div>

        <script>
        var marker;
        var map;
        var infowindow;

        var directionsService;
        var directionsDisplay;
        var firstLat;
        var firstLng;
        var lastLat;
        var lastLng;
        var locationArray = new Array();

        function initMap(lat,lng,title) {
			locationArray = new Array();
			directionsService = new google.maps.DirectionsService;
			directionsDisplay = new google.maps.DirectionsRenderer({
            polylineOptions: {
              strokeColor: "red",
              strokeWeight: 8,
              strokeOpacity: 0.6
            }
          });

          var locationstart = {lat: 9.962533, lng: 98.640371}; //Start location
          if (lat == null ||  lng == null) {
          var location = {lat: 9.962533, lng: 98.640371}; //Start location
          } else {
            var location = {lat: lat, lng: lng}; //Start location
          }
          if (title == null) {
          var titletext ="คุณอยู่ที่นี่"; //Start location
          } else {
            var titletext = title; //Start location
          }
          map = new google.maps.Map(document.getElementById('map'), {
            zoom: 11,
            center: location,
            zoomControl: true,
            zoomControlOptions: {
              position: google.maps.ControlPosition.RIGHT_CENTER
            },
            mapTypeControl: true,
            mapTypeControlOptions: {
              style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
              position: google.maps.ControlPosition.RIGHT_CENTER
            },
            scaleControl: true,
            streetViewControl: true,
            streetViewControlOptions: {
              position: google.maps.ControlPosition.RIGHT_CENTER
            },
            rotateControl: true,
            rotateControlOptions: {
              position: google.maps.ControlPosition.RIGHT_CENTER
            },
            fullscreenControl: true,
            fullscreenControlOptions: {
              position: google.maps.ControlPosition.RIGHT_CENTER
            }
          });

            $('.gm-style-iw').css({
                width:'50px'
            });
          infowindow = new google.maps.InfoWindow({
            content : '<div style="color:#ff0000; font-weight:bold;">'+titletext+'</div>',
            position:  location,
            map: map
          });
          var marker = new google.maps.Marker({
            position: locationstart,
            map: map,
            title: 'จุดเริ่มต้น',
            animation: google.maps.Animation.DROP
          });

          var icon = {url:'assets/img/pin/pin0.png',
          scaledSize: new google.maps.Size(68, 60), // scaled size
          origin: new google.maps.Point(0,0), // origin
          anchor: new google.maps.Point(34, 60) // anchor
        };
        marker.setIcon(icon);
        directionsDisplay.setMap(map);
        directionsDisplay.setOptions({suppressMarkers: true});

        setLocation();

        google.maps.event.addListener(infowindow, 'domready', function() {

// Reference to the DIV that wraps the bottom of infowindow
var iwOuter = $('.gm-style-iw');

/* Since this div is in a position prior to .gm-div style-iw.
* We use jQuery and create a iwBackground variable,
* and took advantage of the existing reference .gm-style-iw for the previous div with .prev().
*/
var iwBackground = iwOuter.prev();

// Removes background shadow DIV
iwBackground.children(':nth-child(2)').css({'display' : 'none'});

// Removes white background DIV
iwBackground.children(':nth-child(4)').css({'display' : 'none'});

// Moves the infowindow 115px to the right.
// iwOuter.parent().parent().css({left: '115px'});

// Moves the shadow of the arrow 76px to the left margin.
iwBackground.children(':nth-child(1)').attr('style', function(i,s){ return s + 'left: 76px !important;'});

// Moves the arrow 76px to the left margin.
iwBackground.children(':nth-child(3)').attr('style', function(i,s){ return s + 'left: 76px !important;'});

// Changes the desired tail shadow color.
iwBackground.children(':nth-child(3)').find('div').children().css({'box-shadow': 'rgba(72, 181, 233, 0.6) 0px 1px 6px', 'z-index' : '1'});

// Reference to the div that groups the close button elements.
var iwCloseBtn = iwOuter.next();

// Apply the desired effect to the close button
iwCloseBtn.css({opacity: '1', right: '30px', top: '3px'});

// If the content of infowindow not exceed the set maximum height, then the gradient is removed.
if($('.iw-content').height() < 140){
$('.iw-bottom-gradient').css({display: 'none'});
}

// The API automatically applies 0.7 opacity to the button after the mouseout event. This function reverses this event to the desired value.
iwCloseBtn.mouseout(function(){
$(this).css({opacity: '1'});
});
});
      }

      function showContent(id){
        window.location='<?= $viewfile ?>?id='+id;
      }

      function setLocation() {
        $.ajax({
        type:"GET",
        data:{cat:<?= $cat ?>,type:<?= $type ?>},
        url: "ajax/get_category.php"
      }).done(function(text){

        var json = $.parseJSON(text);
        for(var i = 0 ;i<json.length;i++){
          var latitude = json[i].poi_lat;
          var longtitude = json[i].poi_lng;
          var poi_id = json[i].poi_id;
          var poi_type = json[i].poi_type;
          var poi_pin = json[i].poi_pin;
          var marker_label=poi_id.toString();
          var poi_photo = "assets/img/poi/s/"+poi_id+".png";
          /* if(!fileExists(poi_photo))
          poi_photo = "assets/assets/photo/poi/no_image.jpg"; */

          firstLat = json[0].poi_lat;
          firstLng = json[0].poi_lng;
		  if(json[i].poi_skip_map!=1)
		 {
			  lastLat = json[i].poi_lat;
			  lastLng = json[i].poi_lng;
			  var myLatlng = new google.maps.LatLng(lastLat,lastLng);
			  locationArray.push(myLatlng);
		 }

          var poi_name = json[i].poi_name;
          if (latitude!="" && longtitude != "") {
            //Have location
            var latlng = new google.maps.LatLng(latitude,longtitude);
            var img = "<a href='#' onClick=showContent('"+poi_id+"');><img width='200'  height='200' src="+poi_photo+" style='border-radius:50%; padding:10px;'></a>";
            var marker_icon = {url:'assets/img/pin/pin'+poi_pin+'.png',
            scaledSize: new google.maps.Size(68, 60), // scaled size
            origin: new google.maps.Point(0,0), // origin
            anchor: new google.maps.Point(34, 60) // anchor
          };
          var markeroption = {map:map, html:img+'<br>'+"<a href='#' onClick=showContent('"+poi_id+"');><div align='center' style='width:200px;margin:0 auto;text-align:center;padding:10px;'><div style='display:block; background-color:rgba(226, 226, 226,0.4);padding: 10px; border:1px solid #c6c4c4;' ><b>"+poi_name+"</b></div></div></a>", position:latlng, title: poi_name, animation: google.maps.Animation.DROP, icon:marker_icon };
          marker = new google.maps.Marker(markeroption);
          //marker.setAnimation(google.maps.Animation.BOUNCE);

          google.maps.event.addListener(map, 'click', function() {
          infowindow.close();
          });

          google.maps.event.addListener(marker,'click',function(e){
            infowindow.setContent(this.html);
            infowindow.open(map,this);

            if (this.getAnimation() != null) {
              this.setAnimation(null);
            } else {
              this.setAnimation(google.maps.Animation.BOUNCE);
            }
      });

        }
      } // end of for
      calculateAndDisplayRoute(directionsService, directionsDisplay,firstLat,firstLng,lastLat,lastLng,locationArray);
      //	});
    });
  }

    function calculateAndDisplayRoute(directionsService, directionsDisplay,firstLat,firstLng,lastLat,lastLng,locationArray) {
      var waypts = [];
      for (var i = 1; i < locationArray.length-1; i++) {
        waypts.push({
          location: locationArray[i],
          stopover: true
        });
      }
      directionsService.route({
        origin: new google.maps.LatLng(firstLat, firstLng),
        destination: new google.maps.LatLng(lastLat, lastLng),
        waypoints: waypts,
        optimizeWaypoints: true,
        travelMode: 'DRIVING'
      }, function(response, status) {
        if (status === 'OK') {
          directionsDisplay.setDirections(response);
          var route = response.routes[0];
        } else {
          //window.alert('Directions request failed due to ' + status);
        }
      });
    }

    function markerAnimate(lat,lng,title) {
      initMap(lat,lng,title);
    }

    </script>
          <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAQ-XpyAMjXsb1EZavQisc29WdL7ywx58Y&callback=initMap&language=th&libraries=places">
    </script>
    </div>
    </div>

    
