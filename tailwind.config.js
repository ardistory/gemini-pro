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
      },
      colors: {
        'white-vite': '#DFDFD6',
        'black-vite': '#1B1B1F',
        'pink-vite': '#bd34fe',
        'blue-vite': '#47caff'
      }
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('tailwind-scrollbar')
  ],
}

