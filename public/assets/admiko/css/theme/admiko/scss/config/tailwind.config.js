const defaultTheme = require("tailwindcss/defaultTheme");
const colors = require("tailwindcss/colors");
module.exports = {
  content: [
    "./resources/views/admin/**/*.blade.php",
  ],
  theme: {
    extend: {
      screens: {
        'xs': '440px',
      },
      colors: {
        primary: colors.blue,
        secondary: colors.fuchsia,
        neutral: colors.gray,
        sidebar: colors.gray,
        danger: colors.red,
        success: colors.green,
        info: colors.sky,
      },
      fontFamily: {
        sans: ["Inter", ...defaultTheme.fontFamily.sans],
      },
      borderRadius: {
        theme: '0.5rem',
      },
    },
  },
  plugins: [
    require("@tailwindcss/typography"),
    require("@tailwindcss/forms")({
      strategy: 'base'
    })
  ],
}

