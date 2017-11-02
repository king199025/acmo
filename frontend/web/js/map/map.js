/**
 * Created by apuc0 on 02.11.2017.
 */
var map = new ACMap();

map.customGeoCoder('Чувашия', [], function (coor) {
    var pm = [];
    for (var i=0;i<mapData.length;i++){
        pm.push({
            coordinates: [mapData[i].lat, mapData[i].lon],
            properties: {
                hintContent: mapData[i].name,
                balloonContentBody:mapData[i].render
            }
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