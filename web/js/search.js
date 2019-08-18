$(document).ready(function() {
    $("#form_search").selectize({
        plugins: ['remove_button'],
        delimiter: ' ',
      // preload:true,
        //openOnFocus: true,
        labelField: "name",
        valueField: "name",
        searchField: "name",
        persist: false,
        create: false,
        
        renderOptions: function(data, escape) {
            return '<div>' + data.name + '</div>';
        },
        load: function(query, callback) {
            if (!query.length)
                return callback();
            $.ajax({
                url: Routing.generate('search_results'),
                type: 'POST',
                data: 'input=' + query,
                error: function() {
                    callback();
                },
                success: function(res) {
                    console.log(res);
                    callback(res);
                }
            });
        },
    });
});