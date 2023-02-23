import { defineConfig } from 'vite'
import liveReload from 'vite-plugin-live-reload'
import { promCmsVitePlugin } from '@prom-cms/vite-plugin'
import path from 'path'

export default defineConfig(({ command }) => {
  return {
    plugins: [
      liveReload('../(modules|public)/**/*.(php|ts|js|css|scss|json|twig)'),
      promCmsVitePlugin(),
    ],
  }
})
