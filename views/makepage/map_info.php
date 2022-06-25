<?
//현재 날씨 정보 출력하기
if (isset($where_act)) {
    $check_txt = 'title::';
    //print_r($geo_info_exp);
    if(strpos($where_act, $check_txt) !== false) { 
        //where info 변수에 title값도 같이 있음
        $geo_info_exp = explode('#!', $where_act);
        $title_row = str_replace("title::", "", $geo_info_exp[0]);
        $lat_row = str_replace("lat::", "", $geo_info_exp[1]);
        $lng_row = str_replace("lng::", "", $geo_info_exp[2]);

        $where_act_geo = $lat_row."&&".$lng_row;
    }else{
        //title값이 없이 좌표값만 있음
        list($lat_row, $lng_row) = explode('&&', $where_act);

    }
    
    $where_act_geo = $lat_row."&&".$lng_row;

    //'title::'.$city.'#!lat::'.$lat.'#!lng::'.$lng;
    $url = "http://www.kma.go.kr/wid/queryDFS.jsp?gridx=" .$lat_row. "&gridy=" .$lng_row;
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
if (isset($where_act_geo)) {
    ?>
    <div id='map_info'>
    <!-- 활동 지역정보 들어가기-->
    <!-- google map 관련-->
    <script src='https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCwr1lkjDfxyvphRgSR11SxtWpAHixTjxA&libraries=places&sensor=false'></script>
    <script type="text/javascript" >
    var ZERO_INDEX = 0;
    var FIRST_INDEX = 1;
    var geocoder;
    var map;
    var geo_origin = '<?echo $where_act_geo;?>';
    var geo_split = geo_origin.split('&&');
    var geo_1 = geo_split[0];
    var geo_2 = geo_split[1];
    var geo_position = '(' + geo_1 + ', ' + geo_2 + ')';
    var geo_title = '<?if(isset($geo_txt)) echo $geo_txt;?>';
    // place 추가.
    var infowindow;
    var placer;
    var places = Array();
    var places_arr = Array();
    var places_origin = '<?if(isset($map_places)) echo $map_places; else echo '';?>';
    var autocomplete_input;
    var place_markers = Array();
    var MARKER_BASE_ZINDEX = 100;
    var defaultZoom = 13;
    var maxZoom = 18;


    //alert(geo_position);
    function initialize() {
        geocoder = new google.maps.Geocoder();
        var latlng = new google.maps.LatLng(geo_1, geo_2);

        //줌 상태 등 설정
        var mapOptions = {
            zoom: defaultZoom,
            maxZoom: maxZoom,
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

        // 이동지역 기능
        var types = document.getElementById('type-selector');
        map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(types);

        var zero_input = getInputElement(ZERO_INDEX);
        if (zero_input) {
            //outline에서 호출할 경우
            var first_input = getInputElement(FIRST_INDEX);
            var zero_place = {'lat': geo_1, 'lng': geo_2, 'title': zero_input.value, 'input': zero_input};
            var first_place = {'lat': geo_1, 'lng': geo_2, 'title': first_input.value, 'input': first_input};
            
            if (places_origin) {
                //alert(print_r(places));
                places_sp = places_origin.split('&&');
                pla_len = places_sp.length;

                for (var i = 0; i < pla_len; i++) {
                    var places_sp2 = places_sp[i].split('#!');
                    var title_sp = places_sp2[0].split('::');
                    var lat_sp = places_sp2[1].split('::');
                    var lng_sp = places_sp2[2].split('::');

                    var title_val = title_sp[1];
                    var lat_val = lat_sp[1];
                    var lng_val = lng_sp[1];
                    var next_val = i+1;
                    //alert(i+'-'+next_val);
                    places_arr[next_val] = {'lat': lat_val, 'lng': lng_val, 'title': title_val, 'input': next_val};
                    //alert(places_arr[0]);

                }
                places = places_arr;
                //places.splice(ZERO_INDEX, 0, zero_place);
                //places[FIRST_INDEX].input = first_input;
            } else {
                places = Array();
                places[ZERO_INDEX] = zero_place;
                places[FIRST_INDEX] = first_place;

                //제로 파서는 위치값이 하나일때만 출력되도록..
                var zeroPlacer = createPlacer(latlng, zero_input.value, 0);
                zeroPlacer.setVisible(true);
                createAutocomplete(zero_input, ZERO_INDEX);
            }


           

            var firstPlacer = createPlacer(latlng, first_input.value, 1);
            firstPlacer.setVisible(false);
            createAutocomplete(first_input, FIRST_INDEX);

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
        }else{
            //openpage에서 호출할 경우
            var zero_input = getInputElement(ZERO_INDEX);
            //멀티맵의 경우
            if (places_origin) {
                //alert(print_r(places));
                places_sp = places_origin.split('&&');
                pla_len = places_sp.length;

                for (var i = 0; i < pla_len; i++) {
                    var places_sp2 = places_sp[i].split('#!');
                    var title_sp = places_sp2[0].split('::');
                    var lat_sp = places_sp2[1].split('::');
                    var lng_sp = places_sp2[2].split('::');

                    var title_val = title_sp[1];
                    var lat_val = lat_sp[1];
                    var lng_val = lng_sp[1];
                    var next_val = i+1;
                    //alert(i+'-'+next_val);
                    places_arr[next_val] = {'lat': lat_val, 'lng': lng_val, 'title': title_val, 'input': next_val};
                    //alert(places_arr[0]);

                    //지도 리스트 출력하기
                    $("#map_location_texts").append('<li>'+title_val+'<input type="hidden" class="geo_txt_array" value="'+title_val+'"</li>');
                }
                places = places_arr;
                //places.splice(ZERO_INDEX, 0, zero_place);
                //places[FIRST_INDEX].input = first_input;
            }

            var geo_txt = '<?if(isset($geo_txt)){ echo $geo_txt;}?>';
            var first_input = getInputElement(FIRST_INDEX);
            var zero_place = {'lat': geo_1, 'lng': geo_2, 'title': geo_txt, 'input': zero_input};
            var first_place = {'lat': geo_1, 'lng': geo_2, 'title': geo_txt, 'input': first_input};

            //멀티맵이 아닌 경우
            if (!places_origin) {
                //제로 파서는 위치값이 하나일때만 출력되도록..
                var zeroPlacer = createPlacer(latlng, geo_txt, 0);
                zeroPlacer.setVisible(true);
                //createAutocomplete(geo_txt, 0);
            }else{
                //멀티맵의 경우
                if(first_input){
                   var firstPlacer = createPlacer(latlng, first_input.value, 1);
                }else{
                   var firstPlacer = createPlacer(latlng, geo_txt, 1);
                }
                firstPlacer.setVisible(false);
                createAutocomplete(first_input, FIRST_INDEX);

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
            }


           

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

            if (places_origin) {
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
            
            /*
            if (places.length > 1) {
                var location_texts = $('#map_location_texts');
                for (var i = 0; i < places.length; i++) {
                    var l_place = places[i];
                    var l_latlng = new google.maps.LatLng(l_place.lat, l_place.lng);
                    var l_placer = createPlacer(l_latlng, l_place.title, Number(l_place.index));
                    l_placer.setVisible(true);
                    $("<li></li>", {
                        text: l_place.title
                    }).appendTo(location_texts);
                }
            } else {
                geo_title = geo_title ? geo_title : '활동지역';
                var zeroPlacer = createPlacer(latlng, geo_title, 0);
                zeroPlacer.setVisible(true);
            }
            refreshMap();
            */
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
            alert('상세 주소를 검색한 주소 뒤에 입력한 후 추가 버튼을 클릭해주세요.');ㅣ
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

        //기존 추가 버튼 안보이도록 변경하기.
        if(place_count>1){
            befor_count = place_count-1;
            $('#btn_geo_txt'+befor_count).hide();
        }
        

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
                for (var i = place_markers.length+1; i = 0; i--) {
                    var num = i;
                    var marker = place_markers[num];
                    marker.icon = getPlacerIconUrl(num);
                    marker.zIndex = MARKER_BASE_ZINDEX +num;
                    marker.setMap(map);
                    place_markers[i] = marker;
                    if (num > 0) {
                        var icon = geo_icon_array.get(num);
                        icon.src = getNumberIconUrl(num);
                    }
                }
            }
        }

        if (index == 0 || index == 1) {
            var zero_input = getInputElement(ZERO_INDEX);
            places[ZERO_INDEX] = places[index];
            places[ZERO_INDEX].input = zero_input;
            zero_input.value = places[index].title;

            var place = places[ZERO_INDEX];
            var input_location = document.getElementById('input_location');
            loca_val = 'title::'+place.title+'#!lat::'+place.lat+'#!lng::'+place.lng;
            input_location.value = loca_val;

            var marker = place_markers[ZERO_INDEX];
            marker.position = new google.maps.LatLng(place.lat, place.lng);
            marker.title = place.title;
            marker.setMap(map);
            place_markers[ZERO_INDEX] = marker;
        }

         //위치값이 멀티면, input에 배열형태로 저장하기
        var loca_val = '';
        for (var key in places) {
            var place = places[key];
            //alert(place.lat+'&&'+place.lng);
            if (loca_val.indexOf(place.lat)) {
                //기존에 중복된 값이 있다면 열외하기
                if(loca_val == ''){
                    loca_val = 'title::'+place.title+'#!lat::'+place.lat+'#!lng::'+place.lng;
                }else{
                    loca_val = loca_val+'&multimap&'+'title::'+place.title+'#!lat::'+place.lat+'#!lng::'+place.lng;
                }
            }
        }
        //위치값 삭제 후 변경된 위치값을 저장하기
        var input_location = document.getElementById('input_location');
        input_location.value =loca_val;

        //console.log('length:'+getTrLength()+','+place_markers[ZERO_INDEX].getVisible());

        if (getTrLength() == 2 && !place_markers[ZERO_INDEX].getVisible()) {
            place_markers[ZERO_INDEX].setVisible(true);
            place_markers[FIRST_INDEX].setVisible(false);
            $('#input_form_orig').css("display", "table");
            $('#input_form').css("display", "none");
        }

        //기존 추가 버튼 안보이도록 변경하기.
        var place_count = $('#input_form tr').length;
        if(place_count>1){
            $('#btn_geo_txt'+place_count).show();
        }


        refreshMap();
    }

    //추가버튼 클릭시 실행됨
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
                //위치값이 하나면, 기본 input박스에 값 저장하기
                var input_location = document.getElementById('input_location');
                //input_location.value = places[ZERO_INDEX].lat + '&&' + places[ZERO_INDEX].lng;
                loca_val = 'title::'+places[ZERO_INDEX].title+'#!lat::'+places[ZERO_INDEX].lat+'#!lng::'+places[ZERO_INDEX].lng;
                input_location.value = loca_val;
            }else{
                //위치값이 멀티면, input에 배열형태로 저장하기
                var loca_val = '';
                for (var key in places) {
                    var place = places[key];
                    //alert(place.lat+'&&'+place.lng);
                    //기존에 중복된 값이 있다면 열외하기
                    if (loca_val.indexOf(place.lat)) {
                        //위치값이 최초값인지, 2개 이상의 값인지에 따라 붙이는 모양을 다르게..
                        if(loca_val == ''){
                            loca_val = 'title::'+place.title+'#!lat::'+place.lat+'#!lng::'+place.lng;
                        }else{
                            loca_val = loca_val+'&multimap&'+'title::'+place.title+'#!lat::'+place.lat+'#!lng::'+place.lng;
                        }
                    }
                }
                //위치값을 저장하기
                var input_location = document.getElementById('input_location');
                input_location.value =loca_val;
            }
            createPlacer(latlng, input.value, index);
            input.style.color = "black";
        } else {
            input.focus();
        }
    }

    //print_r 형태
    function print_r(tar) {
        var str = ''; 
        for (var p in tar) { 
            var tmp = eval("tar['" + p.toString() + "']"); 
            if (tmp != null && tmp.toString != null && tmp.toString() != ''){ 
                if (str != '') str += ", "; 
                str += p.toString() + " = " + tmp.toString(); 
            } 
        } 
        return str; 
    }

    //전체보기 클릭시 실행
    function refreshMap() {
        if (places.length > 1) {
            var latLngBound = new google.maps.LatLngBounds();
            for (var key in places) {
                var place = places[key];
                var pcLatLng = new google.maps.LatLng(place.lat, place.lng);
                latLngBound.extend(pcLatLng);
                //alert(place.lat+'&&'+place.lng);
            }
            map.fitBounds(latLngBound);
            console.log('zoom:'+defaultZoom+','+map.getZoom());
            map.setCenter(latLngBound.getCenter());
        } else {
            var latlng = new google.maps.LatLng(geo_1, geo_2);
            map.setCenter(latlng);
            map.setZoom(defaultZoom);
        }
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
        return 'https://chart.googleapis.com/chart?chst=d_map_pin_letter&chld='+index+'|FFFF42|000000';
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
        #now_weather{
            width: 100%;
            margin-bottom: 10px;
        }
    </style>
    <!-- google map 관련-->
    <? if ($temp) { ?>
        <div id='now_weather'>
            <ul>
                <li>
                    <?echo  $this->ez_front_model->trans_lang("현재 날씨");?>  : <?echo  $this->ez_front_model->trans_lang("온도");?> :<? echo $temp; ?>&nbsp;&nbsp;<?echo  $this->ez_front_model->trans_lang("날씨");?> ::<?echo  $this->ez_front_model->trans_lang($sky);?> &nbsp;&nbsp;<?echo  $this->ez_front_model->trans_lang("바람");?> ::<?echo  $this->ez_front_model->trans_lang($wind);?>
                </li>
            </ul>
        </div>
    <? } ?>
    <div id='map-canvas'></div>
    <div id='geo_now' style='display: none;'></div>
    </div>
<?
} else {
?>
    <!-- google map 관련-->
    <script src='https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&sensor=false'></script>
    <script type="text/javascript" >
        function initialize() {
            var input = document.getElementById('geo_txt');
            var input_location = document.getElementById('input_location');
            var geo_state = document.getElementById('geo_state');

            var autocomplete = new google.maps.places.Autocomplete(input);

            google.maps.event.addListener(autocomplete, 'place_changed', function () {
                console.log('place_changed');
                var place = autocomplete.getPlace();
                if (!place.geometry) {
                    input.value = "";
                    input_location.value = "";
                    geo_state.innerHTML = "";
                    return;
                }

                console.log(place.geometry.location);

                input_location.value = place.geometry.location.lat() + '&&' + place.geometry.location.lng();
                geo_state.innerHTML = "지도 정보를 확인했습니다.";
            });
        }

        function inputBlur(input) {
        }

        function inputFocus(input) {
        }

        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
<? } ?>