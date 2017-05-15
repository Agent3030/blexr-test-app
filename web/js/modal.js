$(document).ready(function(){
    $('body').on('click', function(){
        $('.search-window').html('').hide();
    });
    $.ajax({
        url: '/site/odds-form-ajax',
        type: 'get'
    }).done(
        function(data){
            modal = $('#odds-modal');
            oddInput =$('.odds-input') ;

            modal.find('.modal-content').html('').html(data);
            modal.modal('show');

            $('.odds-input').on('input', function(e){
                val = $(this).val();
                label = $(this).attr('id');

                $.ajax({
                    url: '/site/get-all-values-ajax',
                    type: 'post',
                    data: {
                        value: val,
                        label: label
                    }
                }).done(
                    function(data){
                        searchWindow = $('div[data-id='+label+']');
                        searchWindow.html('');

                      if(data!="undefined" && Array.isArray(data)){
                        data.forEach(function (item, i) {
                            responseStr = '<p>' + item + '</p>'

                            searchWindow.append(responseStr);
                            searchWindow.show();
                            });

                        searchWindow.children().on('click', function (e) {
                            e.preventDefault();
                            currentOdd = $(this).text();
                            $('#'+label).val(currentOdd);
                            searchWindow.html('').hide();
                            $.ajax({
                                url: '/site/get-values-ajax',
                                type: 'post',
                                data: {
                                    value: currentOdd,
                                    label: label
                                }
                            }).done(dataResponse);

                        });


                    } else {
                          responseStr ='<p>No data</p>'

                          searchWindow.append(responseStr);
                          searchWindow.show();
                      }
                    });

            });
            $('.odds-input').on('focusout', function(e) {
                val = $(this).val();
                label = $(this).attr('id');
                $.ajax({
                    url: '/site/get-values-ajax',
                    type: 'post',
                    data: {
                        value: val,
                        label: label
                    }
                }).done(dataResponse);
        });

        function dataResponse (data) {
            console.log(data);
            for(key in data){
                $('#'+key).val(data[key]);
            }
        };

     });

    $('#contact-button').on('click',function(){
        $.ajax({
            url: '/site/contact-ajax',
            type: 'get'
        }).done(
            function(data) {
                modal = $('#contact');


                modal.find('.modal-body').html('').html(data);
                modal.modal('show');
            });
    });


});