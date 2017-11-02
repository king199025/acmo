/**
 * Created by apuc0 on 17.10.2017.
 */
function ACMap() {

    this.init = function (options) {
        this.defaultParams = {
            mapId: 'yaMap',
            width: '100%',
            height: '500px',
            center: [55.7, 37.6],
            zoom: 10,
            controls: [],
            placeMarks: []
        };

        this.finalParams = this.defaultParams;

        for (var key in options) {
            if (options.hasOwnProperty(key)) {
                if (options[key] !== undefined) {
                    this.finalParams[key] = options[key];
                }
            }
        }
        this.options = this.finalParams;
        this.mapBoxObj = document.getElementById(this.options.mapId);
        this.mapBoxObj.style.width = this.options.width;
        this.mapBoxObj.style.height = this.options.height;
        ymaps.ready(this.run.bind(this));
    };

    this.run = function () {
        this.getMapObj();
        this.addAllObjects();
    };

    this.addAllObjects = function () {
        for (var i = 0; i < this.options.placeMarks.length; i++) {
            if (this.options.placeMarks[i].address) {
                var pm = [];
                pm['pm'] = this.options.placeMarks[i];
                this.customGeoCoder(this.options.placeMarks[i].address, pm, function (coor, data) {
                    data['pm'].coordinates = coor;
                    this.addPlaceMark(data['pm']);
                }.bind(this))
            }
            else {
                this.addPlaceMark(this.options.placeMarks[i]);
            }
        }
    };

    this.addPlaceMark = function (placeMark) {
        if(placeMark.iconLayout){
            placeMark.options.iconLayout = ymaps.templateLayoutFactory.createClass(placeMark.iconLayout)
        }
        var pm = new ymaps.Placemark(placeMark.coordinates, placeMark.properties, placeMark.options);
        this.map.geoObjects.add(pm);
    };

    this.getMapObj = function () {
        this.map = new ymaps.Map(this.options.mapId, {
            center: this.options.center,
            zoom: this.options.zoom,
            controls: this.options.controls
        });
    }

    this.customGeoCoder = function (address, data, callback) {
        callback = callback || function () {
            };
        data = data || [];
        address = address.replace(/\s/ig, '+');

        var xhr = new XMLHttpRequest();

        xhr.open('GET', 'https://geocode-maps.yandex.ru/1.x/?format=json&results=1&geocode=' + address, true);

        xhr.send(); // (1)

        xhr.onreadystatechange = function () { // (3)
            if (xhr.readyState != 4) return;

            if (xhr.status != 200) {
                console.log(xhr.status + ': ' + xhr.statusText);
            } else {
                var res = JSON.parse(xhr.responseText).response.GeoObjectCollection.featureMember[0].GeoObject;
                if (res) {
                    var resCoor = [];
                    var coor = res.Point.pos.split(' ');
                    resCoor.push(coor[1]);
                    resCoor.push(coor[0]);
                    callback(resCoor, data);
                }
            }

        }
    }

}