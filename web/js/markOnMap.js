// tento skript potrebuje k životu aby bol niekde v html: 
// link s id: markOnMap
if ($("#markOnMap").exists()) {
    dialog({html: '<div id="map-canvas" style="width:450px; height:300px;"></div>'});
    function markOnMap(idLat, idLong) {

        $("#markOnMap").click(function() {
            console.log("click");
            $("#dialog").dialog("open");
            initialize(idLat, idLong);
            document.onload = loadScript;
        });
    }
    function initialize(idLat, idLong) {
        var mapOptions = {
            zoom: 2,
            center: new google.maps.LatLng(20, 30)
        };
        var map = new google.maps.Map(document.getElementById('map-canvas'),
                mapOptions);
        google.maps.event.addListener(map, 'click', function(event) {
            console.log(event.latLng);
            if (confirm("Mark this place?")) {
                $(idLat).val(event.latLng.lat());
                $(idLong).val(event.latLng.lng());
                $("#dialog").dialog("close");
            }

        });
    }
}

