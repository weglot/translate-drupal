/**
 * @file
 * Admin weglot check API
 */

(function($) {

    $(document).ready(function() {
        $("input[name=api_key]").blur(function() {
            var key = $(this).val();
            $.ajax({
                dataType: "json",
                url:
                    "https://weglot.com/api/user-info?api_key=" +
                    key,
                success: function(data) {
                    $(".wg-keyres").remove();
                    $("input[name=api_key]").after('<span class="wg-keyres wg-okkey"></span>');
                },
                error :function(data){
                    $(".wg-keyres").remove();
                    $("input[name=api_key]").after('<span class="wg-keyres wg-nokkey"></span>');
                }
            });
        });
    });
})(jQuery);
