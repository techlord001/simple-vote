/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {
      colors: {
      primary: {
          background: '#282758',
          text: '#7B7AA0',
      },
      secondary: {
          background: '#7D762C',
          text: '#E4DFA6',
      },
      border: '#FFFFFF',
      },
    },
  },
  plugins: [],
}

