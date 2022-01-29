const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors');
module.exports = {
    darkMode: 'class',

    theme: {
        extend: {
            colors: {
              'lightBg': '#F4F6F9',
              'lightHeader': '#F8F9FA',
            },
            fontFamily: {
                sans: ['Inter var', ...defaultTheme.fontFamily.sans],
            },
        },
    },
    variants: {
        extend: {
            colors: {
                danger: colors.rose,
                primary: colors.blue,
                success: colors.green,
                warning: colors.yellow,
            },
            backgroundColor: ['active'],
        }
    },
    // mode: 'jit',
    // purge: [
    //     './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    //     './vendor/laravel/jetstream/**/*.blade.php',
    //     './storage/framework/views/*.php',
    //     './resources/views/**/*.blade.php',
    // ],

    purge: {
        content: [
            './app/**/*.php',
            './resources/**/*.html',
            './resources/**/*.js',
            './resources/**/*.jsx',
            './resources/**/*.ts',
            './resources/**/*.tsx',
            './resources/**/*.php',
            './resources/**/*.vue',
            './resources/**/*.twig',
            './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
            './vendor/laravel/jetstream/**/*.blade.php',
            './storage/framework/views/*.php',
            './resources/views/**/*.blade.php',
            './vendor/filament/**/*.blade.php',

        ],
        options: {
            defaultExtractor: (content) => content.match(/[\w-/.:]+(?<!:)/g) || [],
            whitelistPatterns: [/-active$/, /-enter$/, /-leave-to$/, /show$/],
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
    ],
};
