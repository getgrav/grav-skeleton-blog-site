---
title: Home
blog_url: blog

enigma:
    hero:
        style: dark
        size: fullscreen
        overlay: false
    blog:
        date: footer
        taxonomy: footer

sitemap:
    changefreq: monthly
    priority: 1.03

content:
    items: @self.children
    order:
        by: date
        dir: desc
    limit: 5
    pagination: true

feed:
    description: Sample Blog Description
    limit: 10

pagination: true
---

# Enigmas Wrapped in Conundrums
#### The awesomazing new **Grav** default theme
