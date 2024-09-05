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
            fontFamily: {
                "-apple-system": ["'BlinkMacSystemFont', 'sans-serif'"],
            },
            // colors: {
            //     "--black-color": "#000",
            //     "--white-color": "#fff",
            //     "--red-color": "#d1001f",
            // },
        },
    },
    plugins: [],
};
