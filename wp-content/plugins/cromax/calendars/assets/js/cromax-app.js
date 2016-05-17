jQuery(document).ready(function($) {

	/** This is the main JQuery file for the plugin.
		It handles the small functions needed and also binds our larger.
		Editing these files wihtout a good knowledge of Javascript & JQuery can Render your Theme useless.
	**/ 





    $('.cromaxModal').each(function() {
        $(this).detach().prependTo('.cromax_videopouch');
    });

    $(".cromax_videodiv").click(function() {
        var mystr = $(this).attr('rel');
        var mylighboxstring = '.cromaxModal[rel="' +  mystr  + '"]';
        $(mylighboxstring).foundation('reveal', 'open');
    });

    $('.close-reveal-modal').click(function() {
        $(this).foundation('reveal', 'close');
    });

    /**  Tabs code **/

    $('.cro_tab_container').each(function() {
        var firstactiveli = $(this).find('li:first');
        var firstactivediv = $(this).find('.tab-pane:first');

        firstactiveli.addClass('cro_activeli');
        firstactivediv.addClass('cro_activediv');
    });

    $('ul.nav-tabs li').click(function() {
        var divvie = $(this).find('a').attr('href');
        $(this).parent('ul').find('.cro_activeli').removeClass('cro_activeli');
        $(this).addClass('cro_activeli');
        $(this).parents('.cro_tab_container').find('.cro_activediv').removeClass('cro_activediv');
        $(divvie).addClass('cro_activediv');
        return false;

    });

    $('.accordion-pane').click(function() {
        if ($(this).parents('.cro_activepane').length === 0) {
            $(this).parents('.cro_accordion_container').find('.cro_activepane').find('.accordion-cnt').slideUp('slow');
            $(this).parents('.cro_accordion_container').find('.cro_activepane').removeClass('cro_activepane');
            $(this).parents('.cro_accordion_single').addClass('cro_activepane');
            $(this).parents('.cro_accordion_single').find('.accordion-cnt').slideDown('slow');
        } 
    });


    if ($('#map-div').length != 0  ) {
        var streetaddress   = $('#map-div').data('addr'),
            lt              = $('#map-div').data('lt'),
            lg              = $('#map-div').data('lg'),
            zoom            = $('#map-div').data('zoom'),
            mapsIcon        = $('#map-div').data('icon'),
            geocoder,styledMap,myLatlng,
            MPstyles        = [{
                                stylers: [
                                    { hue: 0 },
                                    { saturation: 0 }
                                ]},{
                                featureType: "road",
                                elementType: "geometry",
                                stylers: [
                                    { lightness: 100 }
                                ]},{
                                    featureType: "road",
                                    elementType: "labels"
                                }];


        if ( lt == "" ||  lg == ""){
            geocoder        = new google.maps.Geocoder();
            styledMap       = new google.maps.StyledMapType(MPstyles,{name: "Styled Map"});

            geocoder.geocode( { 'address': streetaddress}, function(results, status) {

                if (status == google.maps.GeocoderStatus.OK) {

                    var mapOptions = { 
                            zoom: zoom, 
                            mapTypeId: google.maps.MapTypeId.ROADMAP,
                            mapTypeControlOptions: {
                                mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
                           }

                        };
                    var map = new google.maps.Map(document.getElementById('map-div'), mapOptions);
                    map.setCenter(results[0].geometry.location);
                    var marker = new google.maps.Marker({
                        map: map,
                        position: results[0].geometry.location,
                        icon: mapsIcon
                    });
                    map.mapTypes.set('map_style', styledMap);
                    map.setMapTypeId('map_style');

                } else {
                    alert("geocode of "+ streetaddress +" failed:"+status);
                }
            });
        } else {

            styledMap       = new google.maps.StyledMapType(MPstyles,{name: "Styled Map"});
            myLatlng        = new google.maps.LatLng(parseFloat(lt),parseFloat(lg));


            var mapOptions  = { 
                                zoom: zoom, 
                                mapTypeId: google.maps.MapTypeId.ROADMAP,
                                center: myLatlng,
                                mapTypeControlOptions: {
                                mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
                                }
                            };
            var map         = new google.maps.Map(document.getElementById('map-div'), mapOptions);
            
            var marker      = new google.maps.Marker({
                                map: map,
                                position: myLatlng,
                                icon: mapsIcon
                            });

            map.mapTypes.set('map_style', styledMap);
            map.setMapTypeId('map_style');
            
        }
    }


    if ($('#map-drv').length != 0  ) {
        var streetaddress   = $('#map-drv').data('addr'),
            lt              = $('#map-drv').data('lt'),
            lg              = $('#map-drv').data('lg'),
            mapContainer    = document.getElementById("map-drv"),
            dirContainer    = document.getElementById("dir-container"),
            fromInput       = document.getElementById("from-input"),
            toInput         = document.getElementById("to-input"),
            map;

        if ( lt == "" ||  lg == ""){
            
            geocoder        = new google.maps.Geocoder();
            geocoder.geocode( { 'address': streetaddress}, function(results, status) {

                var mapOptions = { 
                            zoom: 16, 
                            center: results[0].geometry.location,
                            mapTypeId: google.maps.MapTypeId.ROADMAP
                    };
                map = new google.maps.Map(mapContainer, mapOptions);

                var marker = new google.maps.Marker({
                    position: results[0].geometry.location, 
                    map: map
                }); 


                $('#cro_driveclick').click(function() {
                    getDirections();
                }); 


                function getDirections() {
                    var fromStr             = fromInput.value,
                        toStr               = toInput.value,
                        directionsService   = new google.maps.DirectionsService(),
                        directionsDisplay   = new google.maps.DirectionsRenderer(),
                        dirRequest  = {
                            origin: fromStr,
                            destination: toStr,
                            travelMode: google.maps.DirectionsTravelMode.DRIVING,
                            unitSystem: google.maps.DirectionsUnitSystem.METRIC,
                            provideRouteAlternatives: true
                        };
                    directionsService.route(dirRequest, function(result, status) {
                        if (status == google.maps.DirectionsStatus.OK) {
                            directionsDisplay.setDirections(result);
                            directionsDisplay.setPanel(dirContainer);
                            directionsDisplay.setMap(map);
                        }
                    });

                }
                           
            });


        } else {

            myLatlng        = new google.maps.LatLng(parseFloat(lt),parseFloat(lg));
            geocoder        = new google.maps.Geocoder();

            geocoder.geocode( { 'address': streetaddress}, function(results, status) {

                var mapOptions = { 
                            zoom: 16, 
                            center: myLatlng,
                            mapTypeId: google.maps.MapTypeId.ROADMAP
                    };
                map = new google.maps.Map(mapContainer, mapOptions);

                var marker = new google.maps.Marker({
                    position: myLatlng, 
                    map: map
                }); 


                $('#cro_driveclick').click(function() {
                    getDirections();
                }); 


                function getDirections() {
                    var fromStr             = fromInput.value,
                        toStr               = toInput.value,
                        directionsService   = new google.maps.DirectionsService(),
                        directionsDisplay   = new google.maps.DirectionsRenderer(),
                        dirRequest  = {
                            origin: myLatlng,
                            destination: toStr,
                            travelMode: google.maps.DirectionsTravelMode.DRIVING,
                            unitSystem: google.maps.DirectionsUnitSystem.METRIC,
                            provideRouteAlternatives: true
                        };
                    directionsService.route(dirRequest, function(result, status) {
                        if (status == google.maps.DirectionsStatus.OK) {
                            directionsDisplay.setDirections(result);
                            directionsDisplay.setPanel(dirContainer);
                            directionsDisplay.setMap(map);
                        }
                    });

                }
                           
            });

        }
    }

    if ($('#map-str').length != 0  ) {
        var lts              = $('#map-str').data('lt'),
            lgs              = $('#map-str').data('lg'),
            azoom           = $('#map-str').data('zoom'),
            orient          = $('#map-str').data('orient'),
            myLatlng        = new google.maps.LatLng(lts,lgs),
            panoramaOptions = {
                                addressControl: false,
                                position: myLatlng,
                                pov: {
                                    heading: orient,
                                    pitch: 0,
                                },
                                zoom: azoom
                            };


        panorama = new  google.maps.StreetViewPanorama(document.getElementById("map-str"), panoramaOptions);
        panorama.setVisible(true);
    }

});