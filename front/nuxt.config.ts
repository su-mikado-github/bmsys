// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  ssr: false,

  devtools: { enabled: true },

  app: {
    head: {
      title: "My Blog",
      meta: [
        { charset: "utf-8" },
        { name: "viewport", content: "width=device-width, initial-scale=1" },
      ],
      link: [
        //
        { rel: "icon", type: "image/x-icon", href: "/favicon.ico" },
      ],
      script: [
        //
        { src: "/scripts/test.js", type: "text/javascript" },
      ],
    },
  },
});
