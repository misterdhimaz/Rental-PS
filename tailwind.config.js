/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
  ],
  theme: {
    extend: {
      colors: {
        'brand': {
          50: '#f0fdfa',
          100: '#ccfbf1',
          500: '#14b8a6', // Teal/Cyan Clean
          600: '#0d9488',
        },
        'surface': {
          950: '#020617', // Deep Slate
          900: '#0f172a',
          800: '#1e293b',
        }
      },
      fontFamily: {
        'display': ['Satoshi', 'Inter', 'sans-serif'],
        'mono-gaming': ['JetBrains Mono', 'monospace'],
      },
      backgroundImage: {
        'gaming-gradient': 'radial-gradient(circle at 50% 50%, rgba(20, 184, 166, 0.1) 0%, rgba(2, 6, 23, 1) 100%)',
      }
    },
  },
  plugins: [],
}
