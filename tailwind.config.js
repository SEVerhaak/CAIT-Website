import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    DEFAULT: '#F2F2F2',  // light mode
                    dark: '#0D0806',     // dark mode
                },
                secondary: {
                    DEFAULT: '#F20505',
                    dark: '#F20505',
                },
                customRed:{
                    DEFAULT: '#A60303',
                    dark: '#730202',
                }
            },
        },
        darkMode: 'class', // or 'media'
    },

    plugins: [forms],
};
