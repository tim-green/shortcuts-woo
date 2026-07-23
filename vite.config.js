import { defineConfig } from 'vite';
import path from 'path';

export default defineConfig({
  build: {
    outDir: 'build',
    emptyOutDir: true,
    rollupOptions: {
      input: path.resolve(__dirname, 'assets/js/main.js'),
      output: {
        entryFileNames: 'js/app.js',
        chunkFileNames: 'js/app-[hash].js',
        assetFileNames: (assetInfo) => {
          if (assetInfo.name && assetInfo.name.endsWith('.css')) {
            return 'css/app.css';
          }
          return 'assets/[name][extname]';
        },
      },
    },
  },
});