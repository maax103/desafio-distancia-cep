// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  devtools: { enabled: true },
  app: {
    head: {
      meta: [
        {
          name: "viewport",
          content: "width=device-width, initial-scale=1"
        },
        {
          charset: "utf-8"
        }
      ],
      link: [
        {
          rel: 'stylesheet',
          href: 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css'
        }
      ],
      script: [
        {
          src: 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js',
          tagPosition: 'bodyClose'
        }
      ],
      noscript: []
    }
  },

  runtimeConfig: {
    public: {
      API_URL: process.env.API_URL
    }
  },

  modules: ["usebootstrap"],
  usebootstrap: {
    bootstrap: {
      prefix: ``
    },
    html: {
      prefix: `B`
    },
  },
  css: [
    "~/assets/css/global.css"
  ]
})