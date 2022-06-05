(function () {
    "use strict";

    // Mobile Menu
    $("#mobile_menu_toggler").on("click", function () {
        if ($(".mobile_menu").find("ul").first()[0].offsetParent !== null) {
            $(".mobile_menu").find("ul").first().slideUp();
        } else {
            $(".mobile_menu").find("ul").first().slideDown();
        }
    });

    $(".mobile_menu")
        .find(".menu")
        .on("click", function () {
            if ($(this).parent().find("ul").length) {
                if (
                    $(this).parent().find("ul").first()[0].offsetParent !== null
                ) {
                    $(this)
                        .find(".menu__sub_icon")
                        .removeClass("transform rotate-180");
                    $(this)
                        .parent()
                        .find("ul")
                        .first()
                        .slideUp(300, function () {
                            $(this).removeClass("menu__sub_open");
                        });
                } else {
                    $(this)
                        .find(".menu__sub_icon")
                        .addClass("transform rotate-180");
                    $(this)
                        .parent()
                        .find("ul")
                        .first()
                        .slideDown(300, function () {
                            $(this).addClass("menu__sub_open");
                        });
                }
            }
        });
})();
