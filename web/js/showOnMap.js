// tento skript potrebuje k životu aby bol niekde v html: 
// link s triedou .showOnMap
if ($(".showOnMap").exists()) {
    dialog({html: '<div id="map-canvas" style="width:450px; height:300px;"></div>'});
    $(function() {        
        $(".showOnMap").click(function() {
            //console.log("click " + $(this).attr("id"));
            // ajax ktorý vytiahne geo marker podla jeho ID
            $.ajax({
                url: Routing.generate('geo_json'),
                type: 'POST',
                async: false,
                data: 'id=' + $(this).attr("id"),
                error: function() {
                    console.log("Ajax showOnMap.js error");
                },
                success: function(res) {
                    $("#dialog").dialog("open");
                    console.log(JSON.parse(res));
                    initialize(JSON.parse(res));

                }
            });

        });
    });

    function initialize(geo) {
        var myLatlng = new google.maps.LatLng(geo.latitude, geo.longtitude);
        var mapOptions = {
            zoom: 2,
            center: myLatlng
        };
        var map = new google.maps.Map(document.getElementById('map-canvas'),
                mapOptions);

        var marker = new google.maps.Marker({
            position: myLatlng,
            map: map,
            title: geo.title,
        });

    }
}