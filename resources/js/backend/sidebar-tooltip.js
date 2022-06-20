import tippy, { roundArrow } from "tippy.js";

(function () {
    "use strict";

    // Side menu tooltips
    let initTooltips = (function tooltips() {
        $(".sidebar_menu").each(function () {
            if (this._tippy == undefined) {
                let content = $(this)
                    .find(".sidebar_menu__title")
                    .html()
                    .replace(/<[^>]*>?/gm, "")
                    .trim();
                tippy(this, {
                    content: content,
                    arrow: roundArrow,
                    animation: "shift-away",
                    placement: "right",
                });
            }

            if (
                $(window).width() <= 1260 ||
                $(this).closest(".sidebar").hasClass("sidebar__simple")
            ) {
                this._tippy.enable();
            } else {
                this._tippy.disable();
            }
        });

        return tooltips;
    })();

    window.addEventListener("resize", () => {
        initTooltips();
    });
})();
