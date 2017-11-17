/**
 * Created by apuc0 on 02.11.2017.
 */
var map = new ACMap();
console.log(mapData);
map.customGeoCoder('Чувашия', [], function (coor) {
    var pm = [];
    for (var i=0;i<mapData.length;i++){
        pm.push({
            coordinates: [mapData[i].lat, mapData[i].lon],
            properties: {
                hintContent: mapData[i].name,
                balloonContentBody:mapData[i].render
            },
            options: {
                balloonMinWidth: 900,
                balloonMinHeight: 400,
                //balloonImageOffset: [-50, -60]
                iconShape: {
                    type: 'Circle',
                    // Круг описывается в виде центра и радиуса
                    coordinates: [0, 0],
                    radius: 25
                }
            },
            iconLayout: '<div class="placeMarkLayoutContainer"><div class="iconLayoutСircle">'+mapData[i].temperature+'°C</div></div>'
        })
    }
    map.init({
        mapId: 'acMap',
        height: '100%',
        zoom: 8,
        center: coor,
        controls: ['default', 'routeButtonControl'],
        placeMarks: pm
    });
    console.log(coor);
});