/**
 * Created by apuc0 on 02.11.2017.
 */
var map = new ACMap();
map.customGeoCoder('Чувашия', [], function (coor) {
    var pm = [];
    for (var i=0;i<mapData.length;i++){
        if(mapData[i].temperature !== ''){
            pm.push({
                coordinates: [mapData[i].lat, mapData[i].lon],
                properties: {
                    hintContent: mapData[i].name,
                    balloonContentBody:mapData[i].render
                },
                options: {
                    balloonMinWidth: 300,
                    balloonMinHeight: 350,
                    //balloonImageOffset: [-50, -60]
                    iconShape: {
                        type: 'Circle',
                        // Круг описывается в виде центра и радиуса
                        coordinates: [0, 0],
                        radius: 25
                    }
                },
                iconLayout: '<div class="placeMarkLayoutContainer"><div class="iconLayoutСircle" style="border-color: '+mapData[i].rs+'">'+mapData[i].temperature+'°C</div></div>',
                click: function (e) {
                    var timerId = setInterval(function() {
                        if(e.originalEvent.map.balloon.isOpen()){
                            (function ($) {
                                $('.tabcontent').each(function (i) {
                                    if (i != 0) {
                                        $(this).hide(0)
                                    }
                                });
                                $('.modal__slider').slick({
                                    dots: false,
                                    infinite: false,
                                    speed: 300,
                                    slidesToShow: 1,
                                    adaptiveHeight: true,
                                    arrows: true,
                                });

                                $(document).on('click', '.tablinks a', function (e) {
                                    e.preventDefault();
                                    var itemId = $(this).attr('href');
                                    var activeTab = $(itemId);
                                    $('.tabcontent').hide();
                                    activeTab.show();
                                    $('#photo-date').text($(this).data('date'));
                                    $('.tablinks a').removeClass('active');
                                    $(this).addClass('active');
                                });
                            })(jQuery);
                            clearInterval(timerId);
                        }
                    }, 50);
                }
            })
        }

    }
    map.init({
        mapId: 'acMap',
        height: '100%',
        zoom: 8,
        center: coor,
        controls: ['default', 'routeButtonControl'],
        placeMarks: pm
    });
});
