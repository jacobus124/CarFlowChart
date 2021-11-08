let map, infoWindow;
  //locationButton.addEventListener("click", () => {
    // Try HTML5 geolocation.
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(
        (position) => {
          const pos = {
            lat: position.coords.latitude,
            lng: position.coords.longitude,
          };
	    var marker = new google.maps.Marker({
			position: pos,
			map: map,
			title: 'You'
			});
          map.setCenter(pos);
          map.setZoom(5);
        },
        () => {
          handleLocationError(true, infoWindow, map.getCenter());
        }
      );
    } else {
      // Browser doesn't support Geolocation
      handleLocationError(false, infoWindow, map.getCenter());
    }
  //});
  google.maps.event.addListener(map, 'click', function(event) {
   placeMarker(event.latLng);
});


function placeMarker(location) {
    var marker = new google.maps.Marker({
        position: location, 
        map: map,
    });
    alert(location);
}
function handleLocationError(browserHasGeolocation, infoWindow, pos) {
  infoWindow.setPosition(pos);
  infoWindow.setContent(
    browserHasGeolocation
      ? "Error: The Geolocation service failed."
      : "Error: Your browser doesn't support geolocation."
  );
  infoWindow.open(map);
}