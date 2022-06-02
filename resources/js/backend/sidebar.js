(function () {
    "use strict";

    // Side Menu
    $(".sidebar_menu").on("click", function () {
        if ($(this).parent().find("ul").length) {
            if ($(this).parent().find("ul").first()[0].offsetParent !== null) {
                $(this)
                    .find(".sidebar_menu__sub_icon")
                    .removeClass("transform rotate-180");
                $(this).removeClass("sidebar_menu__open");
                $(this)
                    .parent()
                    .find("ul")
                    .first()
                    .slideUp(300, function () {
                        $(this).removeClass("sidebar_menu__sub_open");
                    });
            } else {
                $(this)
                    .find(".sidebar_menu__sub_icon")
                    .addClass("transform rotate-180");
                $(this).addClass("sidebar_menu__open");
                $(this)
                    .parent()
                    .find("ul")
                    .first()
                    .slideDown(300, function () {
                        $(this).addClass("sidebar_menu__sub_open");
                    });
            }
        }
    });
})();
