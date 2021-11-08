<?php 
    require_once('Connections/riddelsql.php');
    require_once('GetSql.php');
    require_once('logincheck.php');
    require_once('GetCompany.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Places Search Box</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <link href="amadevcss.css?0.11" rel="stylesheet" type="text/css"/>
    <style type="text/css">
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
        width:70%;
        left:30%;
        background-color:rgb(21, 32, 43);
      }

      /* Optional: Makes the sample page fill the window. */
      html,
      body {
        height:100%;
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
      #title {
        color: #fff;
        background-color: #4d90fe;
        font-size: 25px;
        font-weight: 500;
        padding: 6px 12px;
      }

      #target {
        width: 345px;
      }
      .detaillist{
        position:absolute;
        width:30%;
        height:100%;
        font-size: 15px;
        font-weight:100;
        color:white;
        list-style:none;
      }
      .Opskrifte{
        margin:5px;
      }
      ul{
        list-style:none;
      }
      .dertig
      {
        width:300px !important;
        border:none !important;
      }
      #mainentry span
{
    font-weight:0;
    font-size:20px;
}
#mainentry span{
    margin:0 5px 0 0;
}
.SubmitAllClass
{
  margin:0 !important;
}

.menubar
{
	width:29%;
	margin:0 10px 10px 0;
	padding:0;
	top:0px;
	list-style:none;
	position:fixed;
  background-color:rgb(21, 32, 43);
	border-bottom:solid #b81d15 1px ;
	z-index:999;
	-webkit-font-smoothing: antialiased;
    font-family: "Google Sans",Arial,sans-serif;
    font-weight: normal;
}
.menubar li
{
	line-height:60px;
	text-align:center;
	width:170px;
	height:5%;
	color:white;
	font-size:20px;
	min-height:50px;
	cursor:pointer;
	float:left;
    -webkit-font-smoothing: antialiased;
    font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Ubuntu, "Helvetica Neue", sans-serif;
    font-weight: normal;
}
.menubar a
{
	text-decoration:none;	
	color:white;
}
.menubar a:hover
{
	color:#cf2118;
}
#new
{
  color:#b81d15
}
    </style>
    <script>
      // This example adds a search box to a map, using the Google Place Autocomplete
      // feature. People can enter geographical searches. The search box will return a
      // pick list containing a mix of places and predicted search terms.
      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
      function initAutocomplete() {
        const map = new google.maps.Map(document.getElementById("map"), {
          center: { lat: -25, lng: 26 },
          zoom:5,
          mapTypeId: "roadmap",
        });
        // Create the search box and link it to the UI element.
        const input = document.getElementById("pac-input");
        const searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP].push(input);
        // Bias the SearchBox results towards current map's viewport.
        map.addListener("bounds_changed", () => {
          searchBox.setBounds(map.getBounds());
        });
        let markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener("places_changed", () => {
          const places = searchBox.getPlaces();

          if (places.length == 0) {
            return;
          }
          // Clear out the old markers.
          markers.forEach((marker) => {
            marker.setMap(null);
          });
          markers = [];
          // For each place, get the icon, name and location.
          const bounds = new google.maps.LatLngBounds();
          places.forEach((place) => {
            if (!place.geometry || !place.geometry.location) {
              console.log("Returned place contains no geometry");
              return;
            }
            const icon = {
              url: place.icon,
              size: new google.maps.Size(71, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(25, 25),
            };
            // Create a marker for each place.
            markers.push(
              new google.maps.Marker({
                map,
                title: place.name,
                position: place.geometry.location,
              })
            );
            document.getElementById('AppLocation').value = place.geometry.location;
            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
          });
          map.fitBounds(bounds);
        });
        
      }
    </script>
    <script>
        function Addsql(AppName,AppRep,AppDate, AppLocation)
        {
          if(AppName.length>0 && AppRep.length>0 && AppLocation.length>0)
          {
            var xmlhttp = new XMLHttpRequest();
		        xmlhttp.open("GET", "sqlinlees.php?q=<?php echo $com?>||" + AppName + "||" + AppRep + "||" + AppLocation + "||" + AppDate, true);
		        //alert("sqlinlees.php?q=" + AppName + "||" + AppRep + "||" + AppLocation + "||" + AppDate);
            xmlhttp.send();
          }
          else
          {
            if(AppName.length==0 || AppRep.length==0)
            {
              alert("Fill in the required fields");
            }
            else if(AppLocation.length==0)
            {
              alert("Choose a location");
            }
            else
            {
              alert("Something went wrong. Try again later");
            }
          }

          
  }
    </script>
  </head>
  <body>
  <div class="detaillist" id="detaillist">
      <ul id="mainentry12">
        <li><span class="Opskrifte">Location Name</span></br><input type="text" id="AppName" name="AppName" class="dertig"/></li>
        <li><span class="Opskrifte">Employee</span></br><input type="text" id="AppRep" name="AppRep" class="dertig"/></li>
        <li><span class="Opskrifte">Date</span></br><input type="datetime-local" id="AppDate" name="AppDate"class="dertig"/></li>
        <li hidden></br><input type="text" id="AppLocation" name="AppLocation" class="dertig"/></li>
        <li><input type="Submit" value="Submit" onClick="Addsql(AppName.value,AppRep.value,AppDate.value,AppLocation.value)" class="SubmitAllClass"/></li>
      </ul>
  </div>
    <input
      id="pac-input"
      class="dertig"
      type="text"
      placeholder="Search Box"
      style="position:fixed;
        top:0;
        left:110%"
    />
    <div id="map"></div>

    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAa4lavKgkCW4glgDCXFOuW1CrsUomCTSw&callback=initAutocomplete&libraries=places&v=weekly"
      async
    ></script>
    
  </body>
</html>