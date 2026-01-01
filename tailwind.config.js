import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./resources/**/*.js",
        "./node_modules/flowbite/**/*.js",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
        brand: {
          softer: '#EEF2FF',
          medium: '#6366F1',
        },
        danger: {
          soft: '#FEE2E2',
          medium: '#EF4444',
        },
        success: {
          soft: '#DCFCE7',
          medium: '#22C55E',
        },
        warning: {
          soft: '#FEF3C7',
          medium: '#F59E0B',
        },
      fg: {
        brand: {
          strong: '#1E3A8A',
        },
        danger: {
          strong: '#991B1B',
        },
        success: {
          strong: '#14532D',
        },
      },
    },
          },
      },

    plugins: [
        forms,
        require('flowbite/plugin')
    ],
    darkMode: 'class',
};
