module.exports = {
    mode: 'jit',
    purge: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
    ],
    darkMode: false, // or 'media' or 'class'
    theme: {
        extend: {
            colors: {
                primary: '#164194',
                secondary: '#dee9fc',
            },
          },
    },
    variants: {
        extend: {},
    },
    plugins: [require('@tailwindcss/typography'),]
}