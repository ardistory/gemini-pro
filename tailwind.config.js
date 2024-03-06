/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './resources/views/**/*.blade.php',
    './resources/views/**/*.js'
  ],
  theme: {
    extend: {
      fontFamily: {
        'Inter': ['Inter']
      }
    },
  },
  plugins: [],
}

