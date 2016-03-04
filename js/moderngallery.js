console.log("Loading modern gallery script");

var mg = {
    AJAX_URL: '/wp-admin/admin-ajax.php',
    connected: false,
    cache: [],
    connect: function () {
        var deferred = $.Deferred();

        $.ajax(mg.AJAX_URL, {data: {action: 'test_connection'}, type: 'POST', dataType: 'JSON'})
            .done(function (data, textStatus, jqXHR) {
                if (textStatus == 'success' && data.result == 'success') {
                    mg.connected = true;
                    console.log('AJAX tested and working');
                    deferred.resolve(data);
                }
                else {
                    mg.connected = false;
                    console.log('AJAX connection issues detected.');
                    deferred.reject(data);
                }
            })
            .fail(function (data, textStatus, jqXHR) {
                mg.connected = false;
                console.log('AJAX connection issues detected.');
                deferred.reject(data);
            });

        return deferred.promise();
    },
    isCacheLoaded: false,
    loadCache: function() {
        var deferred = $.Deferred();

        $.ajax(mg.AJAX_URL, {data: {action: 'get_all_artwork'}, type: 'POST', dataType: 'JSON'})
            .done(function (data, textStatus, jqXHR) {
                console.log('Fetched all artwork fron database.');
                //console.log(data);
                mg.cache = data.artwork;

                // If there is more data than a single request can handle:
                if (data.data.number_of_pages > 1) {
                    for (page = 1; page < data.data.number_of_pages; page++) {
                        var data = {action: 'get_all_artwork', page: page};
                        $.ajax(mg.AJAX_URL, {data: data, type: 'POST', dataType: 'JSON'})
                            .done(function(additionalData) {
                                Array.push.apply(mg.cache, additionalData.artwork);
                                if (page == data.data.number_of_pages) {
                                    mg.isCacheLoaded = true;
                                    deferred.resolve(mg.cache);
                                }
                            })
                            .fail(function(data, responseText) { deferred.reject(responseText); })
                    }
                }
                else {
                    mg.isCacheLoaded = true;
                    deferred.resolve(mg.cache);
                }
            })
            .fail(function(data, responseText) {
                console.log('Unable to build cache.');
                console.log(data);
                console.log(responseText);
                deferred.reject(data);
            });

        return deferred.promise();
    },
    waitingForCache: [],
    cacheLoaded: function(callback) {
        if (mg.isCacheLoaded) {
            callback(mg.cache);
        }
        else {
            mg.waitingForCache.push(callback);
        }
    },
    getArtwork: function (post_id) {
        var deferred = $.Deferred();

        $.ajax(mg.AJAX_URL, {data: {action: 'get_artwork', post_id: post_id, type: 'POST', dataType: 'JSON'}})
            .done(function (data, textStatus, jqXHR) {
                console.log('Queried post:');
                console.log(data);
            });

        return deferred.promise();
    },
    toElement: function(artwork, delay) {
        console.log(artwork);
        var $tile = $('<div>', {id: artwork.title, class: 'grid-item', onclick: 'window.location = \'' + artwork.link + '\''});

        var $innerWrapper = $('<div>', {class: 'inner-wrapper'});
        $innerWrapper.append($('<img>', {src: artwork.image_url}));

        var $overlay = $('<div>', {class: 'overlay',});
        $overlay.append($('<span>', {class: 'centerXY', html: 'View →'}));
        $innerWrapper.append($overlay);

        var $outterWrapper = $('<div>', {class: 'outter-wrapper'});
        $outterWrapper.append($innerWrapper);

        $tile.append($outterWrapper);
        $tile.append($('<h1>', { html: artwork.title, class: 'title' }));

        return $tile;
    }
};

mg.connect()
    .done(function () {
        console.log('Downloading Cache');
        mg.loadCache()
            .done(function() {
                console.log('Cache loaded, fireing callbacks');
                while (mg.waitingForCache.length > 0) {
                    callback = mg.waitingForCache.pop();
                    callback(mg.cache);
                }
                console.log('callbacks have been called, now we go live.');
            })
    });




