/**
 * This <angket.000.app> project created by :
 * Name         : syafiq
 * Date / Time  : 02 May 2017, 10:09 AM.
 * Email        : syafiq.rezpector@gmail.com
 * Github       : syafiqq
 */

(function ($)
{
    $('input#created').datetimepicker({
        format: 'YYYY-MM-DD',
        maxDate: moment()
    });

    $(function ()
    {
        $("form#recover").on('submit', function (event)
        {
            event.preventDefault();
            var form = $(this);
            const data = form.serializeObject();
            $.ajax({
                type: form.attr('method'),
                url: form.attr('action'),
                data: data,
                dataType: 'json',
                contentType: 'application/x-www-form-urlencoded; charset=UTF-8; X-Requested-With: XMLHttpRequest'
            })
                .done(function (data)
                {
                    if (data.hasOwnProperty('data'))
                    {
                        if (data['data'].hasOwnProperty('notify'))
                        {
                            var notify = data['data']['notify'];
                            for (var i = -1; ++i < notify.length;)
                            {
                                $.notify({message: notify[i][0]}, {type: notify[i][1]});
                            }
                        }
                    }
                    if (data.hasOwnProperty('code'))
                    {
                        if (data['code'] === "200")
                        {
                            if (data.hasOwnProperty('redirect'))
                            {
                                console.log(data['redirect']);
                                setTimeout(function ()
                                {
                                    location.href = data['redirect'];
                                }, 2000);
                            }
                        }
                    }
                })
                .fail(function ()
                {
                    $.notify({
                        message: 'Error', url: window.location.protocol + "//" + window.location.host
                    }, {
                        type: 'danger'
                    });
                })
        });
    });
    /*
     * Run right away
     * */
})(jQuery);