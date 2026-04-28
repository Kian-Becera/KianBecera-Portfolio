/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: 'class',
  content: ['./src/**/*.{js,jsx,ts,tsx}'],
  theme: {
    extend: {
      colors: {
        accent:        '#00e5cc',
        'dark-bg':     '#060c1a',
        'dark-card':   '#0d1526',
        'dark-border': '#162032',
        'dark-muted':  '#6b7a99',
      },
      fontFamily: {
        sans: ['Space Grotesk', 'Inter', 'ui-sans-serif', 'system-ui'],
        mono: ['JetBrains Mono', 'Fira Code', 'ui-monospace'],
      },
      keyframes: {
        fadeUp: {
          from: { opacity: '0', transform: 'translateY(20px)' },
          to:   { opacity: '1', transform: 'translateY(0)' },
        },
        ticker: {
          '0%':   { transform: 'translateX(110%)' },
          '100%': { transform: 'translateX(-110%)' },
        },
      },
      animation: {
        'fade-up': 'fadeUp .6s ease both',
        'ticker':  'ticker 14s linear infinite',
      },
    },
  },
  plugins: [],
}
