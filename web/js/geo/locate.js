/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function getLocation(mapInitFunction) {
        var x = document.getElementById("locate-info");
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(mapInitFunction, showError);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }
function showError(error) {
    var x = document.getElementById("locate-info");
        switch (error.code) {
            case error.PERMISSION_DENIED:
                x.innerHTML = "User denied the request for Geolocation."
                break;
            case error.POSITION_UNAVAILABLE:
                x.innerHTML = "Location information is unavailable."
                break;
            case error.TIMEOUT:
                x.innerHTML = "The request to get user location timed out."
                break;
            case error.UNKNOWN_ERROR:
                x.innerHTML = "An unknown error occurred."
                break;
        }
    }
