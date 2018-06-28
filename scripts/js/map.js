function initMap() {
    var loc = {lat: 40.029888, lng: -76.746105};
    var map = new google.maps.Map(
    document.getElementById('map'), {zoom: 18, center: loc});
    
    var mark = new google.maps.Marker({position: loc, map: map})
}