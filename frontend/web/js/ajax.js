$(document).ready(function () {
    var _csrf = $('meta[name="csrf-token"]').attr("content");
    $(document).on('change', '.date-from, .date-to', function () {
        var date_from = $('.date-from').val();
        var date_to = $('.date-to').val();
        var id = $('#meteo_id').val();
        if (date_from || date_to) {
            $.ajax(
                {
                    'method': 'POST',
                    'url': '/weather/ajax/date-interval',
                    'data': {
                        'date_from': date_from,
                        'date_to': date_to,
                        '_csrf': _csrf,
                        'id': id
                    },
                    'success': function (response) {
                        var res = JSON.parse(response);
                        if(res.error){
                            alert(res.error);
                        }else if (res.success){
                            $('tbody').html(res.success);
                        }
                    }
                }
            );
        }
    });
});
