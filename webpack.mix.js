const mix = require('laravel-mix');

mix.js("resources/js/backend/backend.js", "public/js/backend.js")
    .react()
    .postCss(
    "resources/css/backend/backend.css",
    "public/css/backend.css",
    [
        require("postcss-import"),
        require("postcss-advanced-variables"),
        require("tailwindcss/nesting"),
        require("tailwindcss"),
        require("autoprefixer"),
    ]
);

mix.js("resources/js/frontend/frontend.js", "public/js/frontend.js")
    .react()
    .postCss(
    "resources/css/frontend/frontend.css",
    "public/css/frontend.css",
    [
        require("postcss-import"),
        require("postcss-advanced-variables"),
        require("tailwindcss/nesting"),
        require("tailwindcss"),
        require("autoprefixer"),
    ]
);
