/**
 * @file
 * Weglot switcher
 */

(function() {
    document.addEventListener('DOMContentLoaded', function(){
        var weglotSelector = document.querySelector("#weglot-selector")

        if(weglotSelector){

            weglotSelector.addEventListener("click", function(e) {
                this.className = this.className.indexOf("country-selector closed") < 0 ? this.className.replace("country-selector", "country-selector closed") : this.className.replace("country-selector closed", "country-selector");
                var body = document.body,
                    html = document.documentElement;
                var page_height = Math.max(body.scrollHeight, body.offsetHeight, html.clientHeight, html.scrollHeight, html.offsetHeight);
                var h = get_offset(this).top;

                var position = window
                    .getComputedStyle(this)
                    .getPropertyValue("position");
                var bottom = window
                    .getComputedStyle(this)
                    .getPropertyValue("bottom");
                var top = window
                    .getComputedStyle(this)
                    .getPropertyValue("top");

                if ((position != "fixed" && h > page_height / 2) || (position == "fixed" && h > 100)) {
                    this.className += " weg-openup";
                }
                return false;
            });
        }

        function get_offset(element) {
            var top = 0,
                left = 0;
            do {
                top += element.offsetTop || 0;
                left += element.offsetLeft || 0;
                element = element.offsetParent;
            } while (element);

            return { top: top, left: left };
        }
    })
})()
