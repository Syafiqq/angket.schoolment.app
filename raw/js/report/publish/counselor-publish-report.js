/**
 * This <angket.000.app> project created by :
 * Name         : syafiq
 * Date / Time  : 06 May 2017, 8:26 PM.
 * Email        : syafiq.rezpector@gmail.com
 * Github       : syafiqq
 */

(function ($)
{
    $(function ()
    {
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

        function print()
        {
            $("page#printable-area").print({
                globalStyles: true,
                mediaPrint: false,
                stylesheet: ['/assets/bower_components/bootstrap/dist/css/bootstrap.min.css', '/assets/css/report/publish/counselor-publish-report.min.css'],
                noPrintSelector: ".no-print",
                iframe: true,
                append: null,
                prepend: null,
                manuallyCopyFormValues: true,
                deferred: $.Deferred(),
                timeout: 750,
                title: null,
                doctype: '<!doctype html>'
            });
        }

        $("a._nav-a-link").on('click', function (event)
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
                                location.href = data['redirect'];
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

        print();
    });
    /*
     * Run right away
     * */
})(jQuery);
