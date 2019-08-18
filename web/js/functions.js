// vytvory div #dialog a pripoji k nemu jQuery dialog funkcionalitu
function dialog(options) {
    if (!$("#dialog").exists()) {
            $('<div id="dialog"  title="Show on the map"></div>').appendTo("body");
            $("#dialog").html(options.html);
        }
        $("#dialog").dialog({
            autoOpen: false,
            width: 500,
            show: {
                
            },
            hide: {
                
            }
        });
}