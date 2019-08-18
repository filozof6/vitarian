 var map;
    var infowindow = new google.maps.InfoWindow({
        content: ""
    });
    
    // @param branches Array of JSON marker entities
    function setMarkers(branches, map, imgPath) {
        // načita sa json pole s markermi
        var marker = null;

        for (var i = 0; i < branches.length; i++) {
            var branch = branches[i];
            var myLatlngMarker = new google.maps.LatLng(branch.latitude, branch.longtitude);
            // pripravy obrazok ak je (GeoType)
            var img=null;
            if (branch.type) { 
                img = imgPath+branch.type.icon;
                console.log(img);
            }

            var marker = new google.maps.Marker({
                position: myLatlngMarker,
                map: map,
                title: branch.title,
                icon: img,
            });
            // spracovanie textu popisu ak má marker odkaz aj na ctLink
            // ak je img null jedná sa o odkaz na ctLink
            if (img==null) var scrap = "<a href='"+Routing.generate('catalog_link',{name:branch.title})+"'>"+branch.title+"</a>";
            else var scrap = branch.title;
            console.log(scrap);
            bindInfoWindow(marker, map, infowindow, '<h1 id="firstHeading" class="firstHeading">' + scrap + '</h1>' + branch.description);
        }
    }
    
    function initialize(jsonArray) {
        var mapOptions = {
            zoom: 2,
            center: new google.maps.LatLng(20, 30)
        };
         map = new google.maps.Map(document.getElementById('map-canvas'),
                mapOptions);
                
        setMarkers(jsonArray, map);


    }
   
    google.maps.event.addDomListener(window, 'load', initialize);