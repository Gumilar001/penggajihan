/** @type {import('tailwindcss').Config} */
module.exports = {
  presets: [
    require('./vendor/wireui/wireui/tailwind.config.js')
  ],
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    './vendor/wireui/wireui/resources/**/*.blade.php',
    './vendor/wireui/wireui/ts/**/*.ts',
    './vendor/wireui/wireui/src/View/**/*.php'
  ],
  theme: {
    extend: {
      screens: {
        'tablet': '640px',
        'laptop': '1024px',
        'desktop': '1280px',
        'desktop_large': '1540px',
      },
      gap: {
        '1': '5px',
      },
      fontSize: {
        'heading2': '27px',
      },
      colors: {
        'import-hover': '#F8F0FF66',
        'bg-page': '#EEF4FF',
        'secondary': {
          10: '#D9EBFF',
          20: '#D9EBFF',
          30: '#D9EBFF',
          40: '#D9EBFF',
          50: '#1F82F6',
          60: '#1F82F6',
          70: '#D9EBFF',
          80: '#D9EBFF',
          90: '#D9EBFF',
          100: '#D9EBFF',
          200: '#D9EBFF',
          300: '#D9EBFF',
        },
        'primary': {
          10: '#1059b1',
          20: '#1059b1',
          30: '#1059b1',
          40: '#1059b1',
          50: '#1059b1',
          60: '#1059b1',
          70: '#1059b1',
          80: '#1059b1',
          90: '#1059b1',
          100: '#1059b1',
          200: '#1059b1',
          300: '#1059b1',
        },
        'warning': {
          10: '#FFF4C0',
          20: '#FFDE87',
          30: '#FFC84E',
          40: '#E7B445',
          50: '#CF9F3D',
          60: '#B88B34',
          70: '#A0772B',
          80: '#886223',
          90: '#704E1A',
          100: '#593A11',
          200: '#412509',
          300: '#291100',
        },
        'neutral': {
          10: '#FFFFFF',
          20: '#F7F7F7',
          30: '#F1F1F1',
          40: '#E7E7E7',
          50: '#CECECE',
          60: '#B1B1B1',
          70: '#919191',
          80: '#818181',
          90: '#666666',
          100: '#3B3B3B',
        },
        'success': {
          10: '#F2F8F5',
          20: '#E6F2EB',
          30: '#CAE5D7',
          40: '#AAD8C0',
          50: '#82C9A6',
          60: '#47BA87',
          70: '#3FA678',
          80: '#369068',
          90: '#2C7555',
          100: '#1F533C'
        },
        'danger': {
          10: '#FCF2F2',
          20: '#F9E4E4',
          30: '#F3C6C6',
          40: '#EDA3A3',
          50: '#E77575',
          60: '#E12120',
          70: '#C91D1C',
          80: '#AE1918',
          90: '#8E1414',
          100: '#640E0E'
        },
        'red': '#EB5757',
        'green': {
          1: '#219653'
        },
        'black': {
          20: '#D0D3D6',
          40: '#A1A7AD',
          60: '#727A84',
          80: '#434E5B',
          100: '#142232'
        },
        'gray': {
          4: '#BDBDBD',
        },
        'blue': {
          1: '#2F80ED',
        },
        'orange': {
          1: '#F2994A'
        },
        'profile': '#C5EBFC',
        'yellow': '#F2C94C',
        'tab-pane': '#EEF4FF',
        'light': {
          'secondary': {
            'orange': '#F5993F'
          }
        },
      }
    },
  },
  corePlugins: {
    aspectRatio: false,
  },
  darkMode: 'class',
  plugins: [
    require('@tailwindcss/aspect-ratio'),
    require('@tailwindcss/typography'),
    require("@tailwindcss/forms"),
    require('tailwindcss-font-inter')
  ],
}
