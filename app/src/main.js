export default defineConfig({
    root: './', // Set this to the directory where your index.html is located
    build: {
        rollupOptions: {
            input: './index.html' // This should point to the path of your index.html file
        }
    }
});