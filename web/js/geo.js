/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


// forward to controller
 /*   $.ajax({
        type: "POST",
        url: Routing.generate('geo_locations'),
        data: {show_id: parseInt($("#show_id").html()),
            seats: str.join(","), }
    })
            .done(function(msg) {
                alert(msg);
            });
 $.ajax({
        type: "POST",
        url: Routing.generate('geo_locations'),
        data: {id_user: 0 }
    })
            .done(function(msg) {
                alert(msg);
            });*/

function bindInfoWindow(marker, map, infowindow, html) {
        google.maps.event.addListener(marker, 'click', function() {
            infowindow.setContent(html);
            infowindow.open(map, marker);

        });
    }
    
