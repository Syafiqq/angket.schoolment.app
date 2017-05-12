/**
 * This <angket.000.app> project created by :
 * Name         : syafiq
 * Date / Time  : 06 May 2017, 12:25 PM.
 * Email        : syafiq.rezpector@gmail.com
 * Github       : syafiqq
 */

(function ($)
{
    $('table#report_tb').DataTable();

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
