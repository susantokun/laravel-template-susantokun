(function () {
    "use strict";

    // $(".top-bar--menu")
    //     .find(".toggle")
    //     .find("input")
    //     .each(function () {
    //         $(this).on("focus", function () {
    //             $(".top-bar, .top-bar-boxed")
    //                 .find(".search-result")
    //                 .addClass("show");
    //         });

    //         $(this).on("focusout", function () {
    //             $(".top-bar, .top-bar-boxed")
    //                 .find(".search-result")
    //                 .removeClass("show");
    //         });
    //     });
    let toggle = document.querySelector('.toggle');
    let top_bar__menu = document.querySelector('.topbar__menu');
    let side_nav__title = document.querySelector('.sidebar__title');
    let navigation = document.querySelector('.sidebar');
    let content = document.querySelector('.content');

    toggle.onclick = function() {
        navigation.classList.toggle('active')
        top_bar__menu.classList.toggle('active');
        side_nav__title.classList.toggle('active');
    }

    let list = document.querySelectorAll('.navigation li');
    function activeLink() {
        list.list.forEach((item) => {
            item.classList.remove('');
            item.classList.add('hovered');
        });
        list.forEach((item) => {
            item.addEventListener('mouseover', activeLink)
        })
    }
})();
