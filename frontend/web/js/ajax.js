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
                            $('tbody').html('');
                        }else if (res.success){
                            $('tbody').html(res.success);
                        }
                        window.history.pushState(null, null, '/weather/forecast/view?id=' + id + '&date=' + date_from + ' 00:00');
                    }
                }
            );
        }
    });

    $(document).on('change', '.date', function () {
        var id = $(this).data('pdk-id');
        var date = $(this).val();
        $('.background-request').show();
        $.ajax({
            url:'/video/view',
            data: {id:id, date:date},
            success: function (response) {
                $('.video-archive__content').html(response);
                window.history.pushState(null, null, '/video/view?id=' + id + '&date=' + date + ' 00:00');
                $('.background-request').hide();
            }
        })
    })
});
