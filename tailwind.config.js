const defaultTheme = require("tailwindcss/defaultTheme");
const colors = require("tailwindcss/colors");

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            // fontFamily:{
            //     'mow':["'Poppins', sans-serif"],
            // },
            colors: {
                'mow-red':'#cc1020',
                'mow-shine-yellow':'#fcc404',
                'mow-dark-yellow':'#d3a407',
            },
        },
    },
    plugins: [],
};
