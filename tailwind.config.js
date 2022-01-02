module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        'youtube-red': '#ff0000'
      }
    }
  },
  variants: {
    backgroundColor: ['responsive', 'hover', 'focus', 'active'],
    outline: ['responsive', 'hover', 'focus', 'active'],
  },
  plugins: []
}
