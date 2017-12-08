document.addEventListener("DOMContentLoaded", function() {
    var watch = document.getElementById("watch");
    function digitalWatch() {
        var date = new Date();
        var day = date.getDate();
        var month = parseInt(date.getMonth() + 1);
        var year = date.getFullYear();
        var hours = date.getHours();
        var minutes = date.getMinutes();
        if (hours < 10) hours = "0" + hours;
        if (minutes < 10) minutes = "0" + minutes;
        watch.innerHTML = day + '.' + month + '.' + year + ' ' + hours + ":" + minutes;
    }
    if (watch) {
        function clockStart() {
            setInterval(digitalWatch, 1000);
            digitalWatch();
        }
        clockStart();
    }

});