import defaultTheme from 'tailwindcss/defaultTheme';

export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Poppins', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    light: '#6fcf97', // Vibrant green
                    DEFAULT: '#27ae60', // Base green
                    dark: '#219653',   // Darker green
                },
                accent: {
                    light: '#56ccf2', // Vibrant blue
                    DEFAULT: '#2d9cdb', // Base blue
                    dark: '#2f80ed',   // Darker blue
                },
            },
        },
    },
    plugins: [],
};