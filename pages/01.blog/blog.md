---
title: Home
blog_url: blog
text_align: center

showcase_classes: parallax text-light overlay-dark
showcase_image: jellyfish.jpg

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

# My Grav Blog
## **awesomazing adventures**
