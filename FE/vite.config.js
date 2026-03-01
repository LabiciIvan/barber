import { defineConfig } from 'vite';
import react from '@vitejs/plugin-react';

export default defineConfig({
  plugins: [react()],
  server: {
    host: true,          // important: listens on 0.0.0.0 for Docker
    port: 5173,
    strictPort: true,
    watch: {
      usePolling: true,  // important for Windows + mounted volumes
    },
  },
});
