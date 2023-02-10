import { defineConfig } from 'vite'
import liveReload from 'vite-plugin-live-reload'
import { promCmsVitePlugin } from '@prom-cms/vite-plugin'
import path from 'path'

export default defineConfig({
  publicDir: path.join(__dirname, 'public'),
  plugins: [
    liveReload('../(modules|public)/**/*.(php|ts|js|css|scss|json|twig)'),
    promCmsVitePlugin(),
  ],
})
