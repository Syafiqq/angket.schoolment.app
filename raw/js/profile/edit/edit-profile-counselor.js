/**
 * This <angket.000.app> project created by :
 * Name         : syafiq
 * Date / Time  : 02 May 2017, 7:21 PM.
 * Email        : syafiq.rezpector@gmail.com
 * Github       : syafiqq
 */

(function ($)
{
    $('input#imageupload').fileupload({
        dataType: 'json',
        done: function (e, data)
        {
            if (data.result.hasOwnProperty('data'))
            {
                if (data.result['data'].hasOwnProperty('notify'))
                {
                    var notify = data.result['data']['notify'];
                    for (var i = -1; ++i < notify.length;)
                    {
                        $.notify({message: notify[i][0]}, {type: notify[i][1]});
                    }
                }
            }
            if (data.result.hasOwnProperty('code'))
            {
                if (data.result['code'] === "200")
                {
                    if (data.result.hasOwnProperty('redirect'))
                    {
                        setTimeout(function ()
                        {
                            location.href = data.result['redirect'];
                        }, 2000);
                    }
                }
            }
        }
    });

    $('input#datebirth').datetimepicker({
        format: 'YYYY-MM-DD',
        useCurrent: false,
        defaultDate: moment($(this).attr("value")),
        maxDate: moment()
    });

    $(function ()
    {
        $("form#edit").on('submit', function (event)
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

        $("a#logout").on('click', function (event)
        {
            event.preventDefault();
            $.ajax({
                type: 'post',
                url: $(this).attr('href'),
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