<?
//현재 날씨 정보 출력하기
if (isset($where_act)) {
    $where_act;
    list($geo_1, $geo_2) = explode('&&', $where_act);
    $url = "http://www.kma.go.kr/wid/queryDFS.jsp?gridx=" . $geo_1 . "&gridy=" . $geo_1;
    $result = simplexml_load_file($url);
    $list = array();

    $location = iconv("UTF-8", "euc-kr", $result->header->title); //예보지역
    $results = $result->body;
    $bl_data = '';
    foreach ($results->data as $item) {
        if (!$bl_data) {
            $temp = $item->temp; //현재온도
            $sky = iconv("UTF-8", "UTF-8", $item->wfKor); //날씨상태(맑음,구름조금,구름많음,흐림,비,눈/비,눈)
            $wind = iconv("UTF-8", "UTF-8", $item->wdKor); //바람(맑음,구름조금,구름많음,흐림,비,눈/비,눈)
            $bl_data = true;
        }
    }
}

?>
<?
if (isset($where_act)) {
    ?>
    <div id=map_info>
        <!-- 활동 지역정보 들어가기-->
        <!-- google map 관련-->
        <script src='https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&sensor=false'></script>
        <script>
            var ZERO_INDEX = 0;
            var FIRST_INDEX = 1;
            var geocoder;
            var map;
            var geo_origin = '<?echo $where_act;?>';
            var geo_split = geo_origin.split('&&');
            var geo_1 = geo_split[0];
            var geo_2 = geo_split[1];
            var geo_position = '(' + geo_1 + ', ' + geo_2 + ')';
            // place 추가.
            var infowindow;
            var placer;
            var places = <?echo $map_places;?>;
            var autocomplete_input;
            var place_markers = Array();
            var MARKER_BASE_ZINDEX = 100;
            var defaultZoom = 13;
            //alert(geo_position);
            function initialize() {
                geocoder = new google.maps.Geocoder();
                var latlng = new google.maps.LatLng(geo_1, geo_2);

                //줌 상태 등 설정
                var mapOptions = {
                    zoom: defaultZoom,
                    maxZoom: defaultZoom,
                    center: latlng,
                    draggable: false,
                    scrollwheel: false,
                    panControl: true,
                    streetViewControl: false,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                }
                map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

                /*
                var marker = new google.maps.Marker({
                    position: latlng,
                    map: map,
                    title: 'Project Area',
                    zIndex: MARKER_BASE_ZINDEX
                });

                place_markers[zero_input.id] = marker;
                */

                var zero_input = getInputElement(ZERO_INDEX);
                var first_input = getInputElement(FIRST_INDEX);
                var zero_place = {'lat': geo_1, 'lng': geo_2, 'title': zero_input.value, 'input': zero_input};
                var first_place = {'lat': geo_1, 'lng': geo_2, 'title': first_input.value, 'input': first_input};
                if (places) {
                    places.splice(ZERO_INDEX, 0, zero_place);
                    places[FIRST_INDEX].input = first_input;
                } else {
                    places = Array();
                    places[ZERO_INDEX] = zero_place;
                    places[FIRST_INDEX] = first_place;
                }

                var zeroPlacer = createPlacer(latlng, zero_input.value, 0);
                zeroPlacer.setVisible(true);
                createAutocomplete(zero_input, ZERO_INDEX);

                var firstPlacer = createPlacer(latlng, first_input.value, 1);
                firstPlacer.setVisible(false);
                createAutocomplete(first_input, FIRST_INDEX);

                // 이동지역 기능
                var types = document.getElementById('type-selector');
                map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(types);

                infowindow = new google.maps.InfoWindow();
                placer = new google.maps.Marker({
                    map: map,
                    anchorPoint: new google.maps.Point(0, -29),
                    draggable: true,
                    zIndex: 1000
                });
                infowindow.close();
                placer.setVisible(false);

                google.maps.event.addListener(placer, 'drag', function () {
                    infowindow.close();
                });
                google.maps.event.addListener(placer, 'dragend', function () {
                    var latlng = placer.getPosition();
                    geocoder.geocode({
                        'latLng': latlng
                    }, callback);
                });

                function callback(results, status) {

                    if (status == google.maps.GeocoderStatus.OK) {
                        var address = '';
                        var place_name = '';
                        for (var i = 0; i < results.length; i++) {
                            var place = results[i];
                            if (place.formatted_address && i === 0) {
                                autocomplete_input.value = place.formatted_address;
                                //place_name = place_name + ':' + place.types.join('-');
                                address = place.formatted_address;
                            }
                            if (place.address_components && i === 0) {
                                for (var key in place.address_components) {
                                    var item = place.address_components[key];
                                    console.log(item.types);
                                    if (item.types.indexOf('sublocality') >= 0) {
                                        place_name = item.long_name;
                                        break;
                                    }
                                }
                            }
                        }
                        infowindow.setContent('<div><strong>' + place_name + '</strong><br>' + address + '</div>');
                        infowindow.open(map, placer);
                        //createMarker(results[i]);
                    }
                }

                for (var i = 2; i < places.length; i++) {
                    var l_place = places[i];
                    var l_latlng = new google.maps.LatLng(l_place.lat, l_place.lng);
                    var l_placer = createPlacer(l_latlng, l_place.title, i);
                    l_placer.setVisible(true);
                    var l_input = plusPlace(true);
                    l_input.value = l_place.title;
                    places[i].input = l_input;
                    createAutocomplete(l_input, i);
                }

                if (places.length > 2) {
                    firstPlacer.setVisible(true);
                    refreshMap();
                }
            }

            function setAutocompleteInput(input) {
                autocomplete_input = input;
            }

            function createPlacer(latlng, title, index) {
                var addPlacer = place_markers[index];
                if (index > 0) {
                    var icon_url = getPlacerIconUrl(index);
                    if (addPlacer) {
                        addPlacer.position = latlng;
                        addPlacer.icon = icon_url;
                        addPlacer.title = title;
                        addPlacer.zIndex = MARKER_BASE_ZINDEX + index;
                        addPlacer.setVisible(true);
                    } else {
                        addPlacer = new google.maps.Marker({
                            position: latlng,
                            map: map,
                            icon: icon_url,
                            shadow: 'https://chart.googleapis.com/chart?chst=d_map_pin_shadow',
                            title: title,
                            zIndex: (MARKER_BASE_ZINDEX + index)
                        });
                        place_markers[index] = addPlacer;
                    }
                } else {
                    if (addPlacer) {
                        addPlacer.position = latlng;
                        addPlacer.setVisible(true);
                    } else {
                        addPlacer = new google.maps.Marker({
                            position: latlng,
                            map: map,
                            title: title,
                            zIndex: MARKER_BASE_ZINDEX
                        });
                        place_markers[index] = addPlacer;
                    }
                }

                return addPlacer;
            }

            function createAutocomplete(input, index) {
                autocomplete_input = input;
                var autocomplete = new google.maps.places.Autocomplete(input);
                autocomplete.bindTo('bounds', map);

                google.maps.event.addListener(autocomplete, 'place_changed', function () {
                    console.log('place_changed');
                    var marker = place_markers[index];
                    if (marker) {
                        marker.setVisible(false);
                    }
                    infowindow.close();
                    placer.setVisible(false);
                    var place = autocomplete.getPlace();
                    if (!place.geometry) {
                        input.value = "";
                        return;
                    }

                    // If the place has a geometry, then present it on a map.
                    if (place.geometry.viewport) {
                        map.fitBounds(place.geometry.viewport);
                    } else {
                        map.setCenter(place.geometry.location);
                        map.setZoom(defaultZoom); // Why 17? Because it looks good.
                    }
                    placer.setIcon(/** @type {google.maps.Icon} */ ({
                        url: 'http://maps.gstatic.com/mapfiles/place_api/icons/geocode-71.png',//place.icon,
                        size: new google.maps.Size(71, 71),
                        origin: new google.maps.Point(0, 0),
                        anchor: new google.maps.Point(17, 34),
                        scaledSize: new google.maps.Size(35, 35)
                    }));
                    placer.setPosition(place.geometry.location);
                    placer.setVisible(true);
                    console.log(place.icon);

                    var address = '';
                    if (place.address_components) {
                        address = [
                            (place.address_components[0] && place.address_components[0].short_name || ''), (place.address_components[1] && place.address_components[1].short_name || ''), (place.address_components[2] && place.address_components[2].short_name || '')].join(' ');
                    }

                    infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address + '</div>');
                    infowindow.open(map, placer);
                    input.style.color = "red";
                });

                // Sets a listener on a radio button to change the filter type on Places
                // Autocomplete.
                function setupClickListener(id, types) {
                    var radioButton = document.getElementById(id);
                    google.maps.event.addDomListener(radioButton, 'click', function () {
                        autocomplete.setTypes(types);
                    });
                }

                var btn_add = $('.btn_add_array').get(index);
                $(btn_add).click(function() {
                    addPlace(input, index);
                });

                var btn_del = $('.btn_del_array').get(index);
                $(btn_del).click(function() {
                    delPlace(input, index);
                });
            }

            function plusPlace(isInit) {
                /*
                 <div id='input_area1' class='input_area_st input_area_start'>
                 <img src='/img/circle_num1.png'>
                 <input id="input_title1" name="input_title" class="title" type="text" onfocus="this.className='focus_area'" onblur="if (this.value.length==0) {this.className='title';}else {this.className='focus_area';}" value="<?echo $div1_name;?>"/>
                 </div>
                 */
                if (places.length < getInputLength()) {
                    var input = getInputElement(getInputLength() - 1);
                    input.focus();
                    return;
                }
                console.log(places.length + ',' + getInputLength());
                var place_count = $('#input_form tr').length;
                if (place_count == 1) {
                    var zero_place = places[ZERO_INDEX];
                    if (zero_place) {
                        var first_input = getInputElement(FIRST_INDEX);
                        places[FIRST_INDEX] = zero_place;
                        places[FIRST_INDEX].input = first_input;
                        var first_marker = place_markers[FIRST_INDEX];
                        first_marker.position = new google.maps.LatLng(zero_place.lat, zero_place.lng);
                        first_marker.title = zero_place.title;
                        first_input.value = zero_place.title;
                        first_marker.setVisible(true);
                        place_markers[ZERO_INDEX].setVisible(false);
                    }
                    $('#input_form_orig').css("display", "none");
                    $('#input_form').css("display", "table");
                }
                place_count++;

                infowindow.close();
                placer.setVisible(false);
                var input_id = 'geo_txt'+place_count;
                var btn_id = 'btn_'+input_id;
                var input_area = $("<tr/>", {
                    'id': 'input_area'+place_count,
                    'class': 'geo_tr_array'
                });

                $("<td style='text-align: left; width: 50px;'></td>").append($("<img>", {
                    'src': getNumberIconUrl(place_count),
                    'class': 'geo_icon_array'
                })).appendTo(input_area);
                //input_area.append("<img src='/img/circle_num"+place_count+".png'>");

                $("<td style='text-align: left;'></td>").append($("<input/>", {
                    //'id': input_id,
                    'name': input_id,
                    'class': 'focus_area geo_txt_array',
                    'type': 'text',
                    'onfocus': 'inputFocus(this);',
                    'onblur': 'inputBlur(this);',
                    'placeholder': 'location'
                })).appendTo(input_area);

                $("<td valign=top style='text-align: right; width: 90px;'></td>").append($("<buton/>", {
                    'id': btn_id,
                    'class': 'btn btn-inverse btn_add_array',
                    text: '추가'
                }).prepend("<img src='/img/icon/icon_map_w.png' style='width:16px; margin-right: 5px;' valign='middle'>")).appendTo(input_area);

                $("<td valign=top style='text-align: right; width: 80px;'></td>").append($("<buton/>", {
                    'class': 'btn btn-inverse btn_del_array',
                    text: '삭제'
                }).prepend("<img src='/img/icon/icon_map_w.png' style='width:16px; margin-right: 5px;' valign='middle'>")).appendTo(input_area);

                $('#input_form').append(input_area);

                var input = getInputElement(place_count);// document.getElementById(input_id);
                if (!isInit) {
                    input.style.color = "red";
                    createAutocomplete(input, place_count);
                    setAutocompleteInput(input);
                }

                return input;
            }

            function delPlace(input, index) {
                infowindow.close();
                placer.setVisible(false);
                if (index == 0) {
                    $('#input_location').val('');
                    $('#geo_txt').val('');
                } else {
                    var geo_tr_array = $('.geo_tr_array');
                    var geo_tr = geo_tr_array.get(index);
                    $(geo_tr).remove();
                    if (index < places.length) {
                        var geo_icon_array = $('.geo_icon_array');
                        places.splice(index, 1);
                        place_markers[index].setMap(null);
                        place_markers.splice(index, 1);
                        for (var i = 0; i < place_markers.length; i++) {
                            var marker = place_markers[i];
                            marker.icon = getPlacerIconUrl(i);
                            marker.zIndex = MARKER_BASE_ZINDEX + i;
                            marker.setMap(map);
                            place_markers[i] = marker;
                            if (i > 0) {
                                var icon = geo_icon_array.get(i);
                                icon.src = getNumberIconUrl(i);
                            }
                        }
                    }
                }

                if (index == 1) {
                    var zero_input = getInputElement(ZERO_INDEX);
                    places[ZERO_INDEX] = places[index];
                    places[ZERO_INDEX].input = zero_input;
                    zero_input.value = places[index].title;

                    var place = places[ZERO_INDEX];
                    var input_location = document.getElementById('input_location');
                    input_location.value = place.lat + '&&' + place.lng;

                    var marker = place_markers[ZERO_INDEX];
                    marker.position = new google.maps.LatLng(place.lat, place.lng);
                    marker.title = place.title;
                    marker.setMap(map);
                    place_markers[ZERO_INDEX] = marker;
                }

                console.log('length:'+getTrLength()+','+place_markers[ZERO_INDEX].getVisible());

                if (getTrLength() == 2 && !place_markers[ZERO_INDEX].getVisible()) {
                    place_markers[ZERO_INDEX].setVisible(true);
                    place_markers[FIRST_INDEX].setVisible(false);
                    $('#input_form_orig').css("display", "table");
                    $('#input_form').css("display", "none");
                }

                refreshMap();
            }

            function addPlace(input, index) {
                if (placer.getVisible()) {
                    infowindow.close();
                    placer.setVisible(false);
                    var zero_input = getInputElement(ZERO_INDEX);
                    var first_input = getInputElement(FIRST_INDEX);
                    var latlng = placer.getPosition();
                    places[index] = {'lat': latlng.lat(), 'lng': latlng.lng(), 'title': input.value, 'input': input};
                    if (index == 0) {
                        places[FIRST_INDEX] = places[index];
                        places[FIRST_INDEX].input = first_input;
                        first_input.value = input.value;
                    } else if (index == 1) {
                        places[ZERO_INDEX] = places[index];
                        places[ZERO_INDEX].input = zero_input;
                        zero_input.value = input.value;
                    }
                    if (index == 0 || index == 1) {
                        var input_location = document.getElementById('input_location');
                        input_location.value = places[ZERO_INDEX].lat + '&&' + places[ZERO_INDEX].lng;
                    }
                    createPlacer(latlng, input.value, index);
                    input.style.color = "black";
                } else {
                    input.focus();
                }
            }

            function refreshMap() {
                var latLngBound = new google.maps.LatLngBounds();
                for (var key in places) {
                    var place = places[key];
                    var pcLatLng = new google.maps.LatLng(place.lat, place.lng);
                    latLngBound.extend(pcLatLng);
                }
                map.fitBounds(latLngBound);
                console.log('zoom:'+defaultZoom+','+map.getZoom());
                map.setCenter(latLngBound.getCenter());
            }

            function inputBlur(input) {
                console.log(input);
                if (!placer.getVisible()) {
                    var index = getInputIndex(input);
                    console.log(index);
                    console.log(places[index]);
                    if(!places[index] || (input.value != places[index].title)) {
                        input.style.color = "red";
                    }
                }
            }

            function inputFocus(input) {
                setAutocompleteInput(input);
            }

            function getInputLength() {
                var geo_txt_array = $('.geo_txt_array');
                return geo_txt_array.length;
            }

            function getInputIndex(input) {
                var geo_txt_array = $('.geo_txt_array');
                return geo_txt_array.index(input);
            }

            function getInputElement(index) {
                var geo_txt_array = $('.geo_txt_array');
                return geo_txt_array.get(index);
            }

            function getTrLength() {
                var geo_tr_array = $('.geo_tr_array');
                return geo_tr_array.length;
            }

            function getTrElement(index) {
                var geo_tr_array = $('.geo_tr_array');
                return geo_tr_array.get(index);
            }

            function getInputArray() {
                var geo_txt_array = $('.geo_txt_array');
                return geo_txt_array.toArray();
            }

            function getPlacerIconUrl(index) {
                return 'https://chart.googleapis.com/chart?chst=d_map_pin_letter&chld=' + index + '|FFFF42|000000';
            }

            function getNumberIconUrl(index) {
                return '/img/circle_num'+index+'.png';
            }

            google.maps.event.addDomListener(window, 'load', initialize);
        </script>
        <style>
            html, body, #map-canvas {
                height: 400px;
                width: 100%;
                margin: 0px;
                padding: 0px
            }

            #panel {
                position: absolute;
                top: 5px;
                left: 50%;
                margin-left: -180px;
                z-index: 30;
                background-color: #fff;
                padding: 5px;
                border: 1px solid #999;
            }

            #now_weather {
                width: 100%;
                margin-bottom: 10px;
            }
        </style>
        <!-- google map 관련-->
        <? if ($temp) { ?>
            <div id='now_weather'>
                <ul>
                    <li>
                        현재 날씨 : 온도 :<? echo $temp; ?>&nbsp;&nbsp;날씨 ::<? echo $sky; ?>&nbsp;&nbsp;바람 ::<? echo $wind; ?>
                    </li>
                </ul>
            </div>
        <? } ?>
        <div id='map-canvas'></div>
        <div id='geo_now' style='display: none;'></div>
    </div>
<?
}
?>