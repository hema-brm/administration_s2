/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
  ],
  theme: {
    extend: {
      colors: {
        primary: {
          50: withOpacity('--color-primary-50'),
          100: withOpacity('--color-primary-100'),
          200: withOpacity('--color-primary-200'),
          300: withOpacity('--color-primary-300'),
          400: withOpacity('--color-primary-400'),
          500: withOpacity('--color-primary-500'),
          600: withOpacity('--color-primary-600'),
          700: withOpacity('--color-primary-700'),
          800: withOpacity('--color-primary-800'),
          900: withOpacity('--color-primary-900'),
        },
        secondary: {
          50: withOpacity('--color-secondary-50'),
          100: withOpacity('--color-secondary-100'),
          200: withOpacity('--color-secondary-200'),
          300: withOpacity('--color-secondary-300'),
          400: withOpacity('--color-secondary-400'),
          500: withOpacity('--color-secondary-500'),
          600: withOpacity('--color-secondary-600'),
          700: withOpacity('--color-secondary-700'),
          800: withOpacity('--color-secondary-800'),
          900: withOpacity('--color-secondary-900'),
        },
        success: {
          50: withOpacity('--color-success-50'),
          100: withOpacity('--color-success-100'),
          200: withOpacity('--color-success-200'),
          300: withOpacity('--color-success-300'),
          400: withOpacity('--color-success-400'),
          500: withOpacity('--color-success-500'),
          600: withOpacity('--color-success-600'),
          700: withOpacity('--color-success-700'),
          800: withOpacity('--color-success-800'),
          900: withOpacity('--color-success-900'),
        },
        warning: {
          50: withOpacity('--color-warning-50'),
          100: withOpacity('--color-warning-100'),
          200: withOpacity('--color-warning-200'),
          300: withOpacity('--color-warning-300'),
          400: withOpacity('--color-warning-400'),
          500: withOpacity('--color-warning-500'),
          600: withOpacity('--color-warning-600'),
          700: withOpacity('--color-warning-700'),
          800: withOpacity('--color-warning-800'),
          900: withOpacity('--color-warning-900'),
        },
        danger: {
          50: withOpacity('--color-danger-50'),
          100: withOpacity('--color-danger-100'),
          200: withOpacity('--color-danger-200'),
          300: withOpacity('--color-danger-300'),
          400: withOpacity('--color-danger-400'),
          500: withOpacity('--color-danger-500'),
          600: withOpacity('--color-danger-600'),
          700: withOpacity('--color-danger-700'),
          800: withOpacity('--color-danger-800'),
          900: withOpacity('--color-danger-900'),
        },
        info: {
          50: withOpacity('--color-info-50'),
          100: withOpacity('--color-info-100'),
          200: withOpacity('--color-info-200'),
          300: withOpacity('--color-info-300'),
          400: withOpacity('--color-info-400'),
          500: withOpacity('--color-info-500'),
          600: withOpacity('--color-info-600'),
          700: withOpacity('--color-info-700'),
          800: withOpacity('--color-info-800'),
          900: withOpacity('--color-info-900'),
        },
      },
    },
  },
  plugins: [],
}

function withOpacity (cssVariable) {
  return ({ opacityValue }) => {
    return opacityValue ? `rgba(var(${cssVariable}), ${opacityValue})` : `rgb(var(${cssVariable}))`
  }
}
