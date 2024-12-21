// tailwind.config.js
module.exports = {
    content: [
        "./resources//*.blade.php", // Include all Blade templates
        "./vendor/bladewind//*.blade.php", // Include Bladewind components
        "./vendor/mkocansey/bladewind/resources/views/**/*.blade.php",
    ],
    darkMode: "false",
    theme: {
        extend: {
            fontFamily: {
                poppins: ["Inter", "sans-serif"], // Add Roboto font
                poppins: ["Poppins", "sans-serif"], // Add Roboto font
            },

            colors: {
                primary: {
                    DEFAULT: "#dc8630",
                    light: "#f4a85a ",
                    dark: "#b36d27 ",
                    contrast: "#ffffff",
                },
                secondary: {
                    DEFAULT: "#35408D",
                    light: "#5966B0",
                    dark: "#2A336E",
                    contrast: "#ffffff",
                },
                white: {
                    DEFAULT: "#ffffff",
                    light: "#f0f0f0",
                    dark: "#cccccc",
                    contrast: "#222222",
                },
                dark: {
                    DEFAULT: "#222222",
                    light: "#2e2e2e",
                    dark: "#1a1a1a",
                    contrast: "#ffffff",
                },
            },
            animation: {
                "infinite-scroll": "infinite-scroll 40s linear infinite",
            },
            keyframes: {
                "infinite-scroll": {
                    from: { transform: "translateX(0)" },
                    to: { transform: "translateX(-100%)" },
                },
            },
        },
    },
    plugins: [],
};
