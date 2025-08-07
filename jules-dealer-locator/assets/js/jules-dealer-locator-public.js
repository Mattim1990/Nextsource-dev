(function( $ ) {
    'use strict';

    $(function() {
        if ( typeof jules_dealer_locator_data === 'undefined' ) {
            return;
        }

        var map = L.map('jules-dealer-map').setView([0, 0], 2);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var markers = [];
        var bounds = [];

        jules_dealer_locator_data.dealers.forEach(function(dealer) {
            if (dealer.lat && dealer.lon) {
                var marker = L.marker([dealer.lat, dealer.lon])
                    .addTo(map)
                    .bindPopup('<b>' + dealer.title + '</b><br>' + dealer.address);
                markers.push(marker);
                bounds.push([dealer.lat, dealer.lon]);
            }
        });

        if (bounds.length > 0) {
            map.fitBounds(bounds);
        }
    });

})( jQuery );
