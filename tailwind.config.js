/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./app/views/**/*.php",
    "./public/**/*.html",
  ],
  theme: {
    extend: {
      colors: {
        primary: {
          dark: '#0F2854',
          DEFAULT: '#1C4D8D',
          light: '#4988C4',
          accent: '#BDE8F5'
        }
      }
    },
  },
  plugins: [],
}