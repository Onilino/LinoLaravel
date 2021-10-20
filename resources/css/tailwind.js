const color = require('tailwindcss/colors')

module.exports = {
  purge: [
      '../**/*.js',
      '../**/*.vue',
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
        colors: {
            'solarized': '#fdf6e3',
            'quantic': '#3D44A0',
            'laravel-darkest': '#462a16',
            'laravel-darker': '#613b1f',
            'laravel-dark': '#de751f',
            'laravel': '#f4645f',
            'laravel-light': '#fa9687',
            'laravel-lighter': '#fcd9b6',
            'laravel-lightest': '#fde8e7',
            'youtube': '#ff0000'
        },
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
