const mix = require('laravel-mix');

mix
    .setPublicPath('public')
    .copy(
        'public',
        '../../public/vendor/axeldotdev/graphql-docs'
    );

mix
    .js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require("tailwindcss"),
    ]);

if (mix.inProduction()) {
    mix.version();
}
