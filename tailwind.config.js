/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "./about.html",
    "./contact.html",
    "./blog.html",
    "./packages.html",
    "./src/**/*.{js,ts,jsx,tsx}",
  ],

  // ✅ SAFELIST MUST BE HERE (top level)
  safelist: [
    "focus:ring-2",
    "focus:ring-sky-500",
    "hover:scale-105",
    "hover:bg-sky-700",
  ],

  theme: {
    extend: {},
  },

  plugins: [],
};
