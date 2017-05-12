/**
 * This <angket.000.app> project created by :
 * Name         : syafiq
 * Date / Time  : 03 May 2017, 7:07 AM.
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
        defaultDate: $(this).attr("value") ? moment($(this).attr("value")) : false,
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

        var supportsAudio = !!document.createElement('audio').canPlayType;
        if (supportsAudio)
        {
            var audio_container = 'ol#plList',
                index = 0,
                trackCount = $(audio_container).children().length,
                playing = false,
                audio = $('#music').bind('play', function ()
                {
                    playing = true;
                }).bind('pause', function ()
                {
                    playing = false;
                }).bind('ended', function ()
                {
                    if ((index + 1) < trackCount)
                    {
                        index++;
                        loadTrack(index);
                        audio.play();
                    } else
                    {
                        audio.pause();
                        index = 0;
                        playTrack(index);
                    }
                }).get(0),
                li = $(audio_container).find('li').click(function ()
                {
                    var id = parseInt($(this).index());
                    if (id !== index)
                    {
                        playTrack(id);
                    }
                }),
                loadTrack = function (id)
                {
                    $('.plSel').removeClass('plSel');
                    var li = $(audio_container).find('li').eq(id).addClass('plSel');
                    index = id;
                    audio.src = li.attr('data-audio')
                },
                playTrack = function (id)
                {
                    loadTrack(id);
                    audio.play();
                };
            playTrack(index);
        }
    });
    /*
     * Run right away
     * */
})(jQuery);
