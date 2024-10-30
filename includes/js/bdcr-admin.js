jQuery(document).ready(function($){

    $('.bdcr_select_icon_btn').click(function () {
        
        $(document).find('.bdcr_icon_modal').fadeIn();
    })

    $('.bdcr_close_modal').click(function () {
        
        $(document).find('.bdcr_icon_modal').fadeOut();
    })

    $('.bdcr_icon_wrap').click(function () {

        $(document).find('.bdcr_active_icon').removeClass('bdcr_active_icon');
        
        var $this = $(this);

        var icon_key = $this.attr('data-icon_key');

        var icon_html = $this.html();

        $(document).find('.bdcr_selected_icon').html(icon_html);

        $this.addClass('bdcr_active_icon');

        $(document).find('#bdcr_icon').val(icon_key);

        $(document).find('.bdcr_icon_modal').fadeOut();
    })

    $(document).on('click', '#bdcr_options_save', function (e) {
        e.preventDefault();
    
        $(document).find('.bdcr_loader').removeClass('bdcr_hide');
        $(document).find('.bdcr_settings_success').addClass('bdcr_hide');
        $(document).find('.bdcr_settings_error').addClass('bdcr_hide');
    
        var bdcr_form_data = new FormData(document.getElementById('bdcr_settings_form'));
    
        bdcr_form_data.append('action', 'bdcr_save_settings');
    
        $.ajax({
            url : Bdcr.ajaxurl,
            type : 'POST',
            data : bdcr_form_data,
            processData : false,
            contentType : false,
            success: function (response) {

                var res = JSON.parse(response);
    
                if (res.success) {
                    $(document).find('.bdcr_settings_success').removeClass('bdcr_hide');
                } else {
                    $(document).find('.bdcr_settings_error').removeClass('bdcr_hide');
                }
    
                $(document).find('.bdcr_loader').addClass('bdcr_hide');
            }
        });
    });



    
    
});