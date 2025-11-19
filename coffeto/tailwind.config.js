import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            boxShadow: {
                'neo': '4px 4px 0px 0px rgba(0,0,0,1)',
                'neo-sm': '2px 2px 0px 0px rgba(0,0,0,1)',
                'neo-lg': '8px 8px 0px 0px rgba(0,0,0,1)',
                'neo-xl': '12px 12px 0px 0px rgba(0,0,0,1)',
            },
            colors: {
                'neo-yellow': '#FFE900',
                'neo-blue': '#4D96FF',
                'neo-pink': '#FF6B6B',
                'neo-green': '#6BCB77',
                'neo-purple': '#9D4EDD',
            },
            borderWidth: {
                '3': '3px',
            },
        },
    },

    plugins: [forms],
};
