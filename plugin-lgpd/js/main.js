;(function($) {

    console.log("JS vindo do plugin GDPR");
    
    $('a.hide-content').click(function(e) {
        e.preventDefault();
     $('.content-gdpr').hide();
    });
    
    })(jQuery);