document.addEventListener("DOMContentLoaded", function() {

    const table = document.querySelector('.meteo-review table');
    if (table) {
        const rows = table.querySelectorAll('tr');
        var i;
        for ( i=0; i<rows.length; i++) {
            rows[i].dataset.id % 2 === 0 ? rows[i].style.backgroundColor = "#fafafa" : ''
        }
    }

    const tr = document.querySelectorAll('.traffic-table table tbody tr');
    for(var j=0; j<tr.length; j++) {
        const firstTd = tr[j].querySelector('td');
        firstTd.innerText = j+1
    }

    $('[data-fancybox="images"]').fancybox({
        thumbs : {
            autoStart : true
        }
    })

});