(function ($) {

    "use strict";

    $(document).ready(function () {
     
            if ($.cookie('a.hide-content')) {
                $(".content-gdpr").remove();
            }
        
            $("a.hide-content").click(function() {
                console.log("Clique disparando");
                $(".content-gdpr").remove();
                $.cookie('a.hide-content', true);
            });

    



    });

})(jQuery);