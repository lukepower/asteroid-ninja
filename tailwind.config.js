import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import preset from './vendor/filament/support/tailwind.config.preset';
import colors from 'tailwindcss/colors';

/** @type {import('tailwindcss').Config} */
export default {
    presets: [preset],

    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
        "./node_modules/tw-elements/dist/js/**/*.js",
        "./node_modules/flowbite/**/*.js"
    ],
    darkMode: 'class',
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms,colors,require("tw-elements/dist/plugin.cjs"),require('flowbite/plugin')],
};
