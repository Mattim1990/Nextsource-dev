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

        var markers = {};
        var bounds = [];

        jules_dealer_locator_data.dealers.forEach(function(dealer) {
            if (dealer.lat && dealer.lon) {
                var marker = L.marker([dealer.lat, dealer.lon])
                    .bindPopup('<b>' + dealer.title + '</b><br>' + dealer.address);
                markers[dealer.id] = marker;
                bounds.push([dealer.lat, dealer.lon]);
            }
        });

        function updateMarkers(visibleDealerIds) {
            for (var dealerId in markers) {
                if (visibleDealerIds.includes(parseInt(dealerId))) {
                    markers[dealerId].addTo(map);
                } else {
                    markers[dealerId].remove();
                }
            }
        }

        function filterDealers() {
            var searchTerm = $('#dealer-search').val().toLowerCase();
            var selectedServices = [];
            $('.service-filters input:checked').each(function() {
                selectedServices.push(parseInt($(this).val()));
            });

            var visibleDealerIds = [];

            jules_dealer_locator_data.dealers.forEach(function(dealer) {
                var dealerTitle = dealer.title.toLowerCase();
                var dealerServices = dealer.services;
                var dealerId = dealer.id;

                var titleMatch = dealerTitle.includes(searchTerm);
                var serviceMatch = selectedServices.length === 0 || selectedServices.every(function(service) {
                    return dealerServices.includes(service);
                });

                if (titleMatch && serviceMatch) {
                    $('.dealer-item[data-id="' + dealerId + '"]').fadeIn();
                    visibleDealerIds.push(dealerId);
                } else {
                    $('.dealer-item[data-id="' + dealerId + '"]').fadeOut();
                }
            });

            updateMarkers(visibleDealerIds);
        }

        $('#dealer-search').on('keyup', filterDealers);
        $('.service-filters').on('change', 'input', filterDealers);

        // Initially show all markers
        var initial_dealers = jules_dealer_locator_data.dealers.map(function(d) { return d.id; });
        updateMarkers(initial_dealers);

        $('.dealer-item').on('click', function() {
            var dealerId = $(this).data('id');
            var marker = markers[dealerId];

            if (marker) {
                map.panTo(marker.getLatLng());
                marker.openPopup();
            }
        });

        $('#toggle-dealer-list').on('click', function() {
            var $content = $('.dealer-list-content');
            $content.toggleClass('collapsed');

            if ($content.hasClass('collapsed')) {
                $(this).text('+');
            } else {
                $(this).text('-');
            }
        });

        if (bounds.length > 0) {
            map.fitBounds(bounds);
        }
    });

})( jQuery );
