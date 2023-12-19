/** @type {import('tailwindcss').Config} */

const availableThemes = require('./assets/js/tailwind/themes').default;
const availableColors = require('./assets/js/tailwind/colors').default;
const availableTailwindSafeClasses = require('./assets/js/tailwind/safe-classes').default;

module.exports = {
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
  ],
  purge: {
    options: {
      safelist: [
        ...availableThemes,
        ...availableTailwindSafeClasses
      ],
    },
  },
  theme: {
    extend: {
      colors: {
        ...availableColors
      },
    },
  },
  plugins: [],
}