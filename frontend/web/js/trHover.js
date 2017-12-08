document.addEventListener("DOMContentLoaded", function() {

    const meteoTr = document.querySelectorAll('.meteo tbody tr');
    const meteoAllTd = document.querySelectorAll('.meteo tbody td');
    const trafficTr = document.querySelectorAll('.traffic-table tbody tr');
    const trafficAllTd = document.querySelectorAll('.traffic-table tbody td');

    function trHover(tr, allTd) {
        for(var j=0; j<tr.length; j++) {
            tr[j].onclick = function () {
                for(var z=0; z < allTd.length; z++) {
                    allTd[z].classList.remove('yellow-td')
                }
                var td = this.querySelectorAll('td');
                for(var y = 0; y< td.length; y++) {
                    td[y].classList.add('yellow-td')
                }
            }
        }
    }

    trHover(meteoTr, meteoAllTd);
    trHover(trafficTr, trafficAllTd);


});