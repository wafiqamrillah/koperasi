/** @type {import('tailwindcss').Config} */
module.exports = {
    prefix: 'tw-',
    important: true,
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/protonemedia/laravel-splade/lib/**/*.vue",
        "./vendor/protonemedia/laravel-splade/resources/views/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
    ],

    theme: {
        extend: {},
    },

    plugins: [
        require("@tailwindcss/forms"),
        require("@tailwindcss/typography")
    ],

    corePlugins: {
        preflight: false,
    }
};