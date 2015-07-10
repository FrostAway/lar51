(function ($) {
    $(document).ready(function () {
        
        
        $('.box-select .link_type input[type="radio"]').change(function () {
            if ($(this).is(':checked')) {
                 var type = $(this).val();
                $.ajax({
                    url: ajax_url,
//                    headers: {'X-XSRF-TOKEN': $('.ajax_token').val()},
                    type: 'POST',
                    data: {
                        action: 'menu_link',
                        _token: $('.ajax_token').val(),
                        type: type
                    },
                    success: function (data) {
                        $('.box-select .link_select').html(data);
                    }
                });
            }
        });
        
        $('.box-select .link_type input[type="radio"]').each(function(){
           if($(this).is(':checked')){
                var type = $(this).val();
                $.ajax({
                    url: ajax_url,
//                    headers: {'X-XSRF-TOKEN': $('.ajax_token').val()},
                    type: 'POST',
                    data: {
                        action: 'menu_link',
                        value: $('#link_value').val(),
                        _token: $('.ajax_token').val(),
                        type: type
                    },
                    success: function (data) {
                        $('.box-select .link_select').html(data);
                    }
                });
           } 
        });
    });
})(jQuery);

