(function( $ ) {
    'use strict';

    $(function() {
        $('#geocode_address').on('click', function() {
            var address = $('#dealer_address').val();
            var $status = $('#geocode_status');

            if ( ! address ) {
                $status.text('Please enter an address.');
                return;
            }

            $status.text('Geocoding...');

            $.get('https://nominatim.openstreetmap.org/search', {
                q: address,
                format: 'json',
                limit: 1
            }, function(data) {
                if (data.length > 0) {
                    $('#dealer_latitude').val(data[0].lat);
                    $('#dealer_longitude').val(data[0].lon);
                    $status.text('Geocoding successful!');
                } else {
                    $status.text('Could not find coordinates for this address.');
                }
            });
        });
    });

})( jQuery );
