/**
 * This <angket.000.app> project created by :
 * Name         : syafiq
 * Date / Time  : 06 May 2017, 11:12 PM.
 * Email        : syafiq.rezpector@gmail.com
 * Github       : syafiqq
 */

(function ($)
{

    var table = $('table#inventory_test').DataTable({
        paging: false,
        fixedHeader: true
    });
    $(function ()
    {
        var uuid = "_schoolment_uuid_question_" + $('meta[property="uuid"]').attr('content');

        $("form#test").on('submit', function (event)
        {
            event.preventDefault();
            var form = $(this);
            $.ajax({
                type: form.attr('method'),
                url: form.attr('action'),
                data: make_json_form_data(),
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
                                Cookies.remove(uuid);
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

        function make_json_form_data()
        {
            var ar = $();
            for (var i = 0; i < table.rows()[0].length; i++)
            {
                ar = ar.add(table.row(i).node())
            }

            var json_obj = {};
            ar.find('input[type=radio]:checked').each(function (i, el)
            {
                json_obj[$(el).attr('name')] = $(el).val();
            });
            return json_obj;
        }

        function save_content(uuid)
        {
            Cookies.set(uuid, make_json_form_data());
        }

        function load_content(uuid)
        {
            var _data = Cookies.getJSON(uuid);

            jQuery.each(_data, function (k, v)
            {
                $("input[name=\"" + k + "\"][value=\"" + v + "\"]").prop('checked', true);
                $("input").find("[name=\"" + k + "\"]").find("[value=\"" + v + "\"]").prop('checked', true);
            });
        }

        $("button#save").on('click', function (event)
        {
            save_content(uuid);
            /*
             for (var i = 0; i < table.rows()[0].length; i++)
             {
             ar = ar.add(table.row(i).node())
             }
             console.log('serialize ');
             console.log(+ar.find('input[type=radio]:checked').serialize());
             var json_obj = {};
             ar.find('input[type=radio]:checked').each(function (i, el)
             {
             json_obj[$(el).attr('name')] = $(el).val();
             });

             console.log('jsonobj ');
             console.log(json_obj);*/
            //Cookies.remove('name');
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

        load_content(uuid);

        var intervalID = window.setInterval(myCallback, 20000);

        function myCallback()
        {
            save_content(uuid);
            $.notify({
                message: 'Jawaban Berhasil disimpan.'
            }, {
                type: 'info',
                delay: 1000,
                timer: 1000
            });
        }

        //TODO This is code for publish data
        /* var x = {"question[q1]": "3"};
         jQuery.each(x, function (k, v)
         {
         $("input[name=\"" + k + "\"][value=\"" + v + "\"]").prop('checked', true);
         //$("input").find("[name="+k+""]").find("[value=\"" + v + "\"]").prop('checked', true);
         });*/

        //TODO this is code for read from meta
        /*var uuid = "_schoolment_uuid_question_" + $('meta[property="uuid"]').attr('content');
         console.log(uuid);*/
    });
    /*
     * Run right away
     * */
})(jQuery);
