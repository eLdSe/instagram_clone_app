const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './vendor/wire-elements/modal/src/ModalComponent.php',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['DM Sans', ...defaultTheme.fontFamily.sans],
                serif: ['DM Serif Display', ...defaultTheme.fontFamily.serif],
                body: ['IBM Plex Sans Arabic', 'sans-serif'],
            },
            colors: {
                'ig-pink': '#ee2a7b',
                'ig-orange': '#f77737',
                'ig-purple': '#6228d7',
                'ig-yellow': '#f9ce34',
            },
            borderRadius: {
                '2xl': '16px',
                '3xl': '24px',
            },
        },
    },
    plugins: [require('@tailwindcss/forms')],
};
