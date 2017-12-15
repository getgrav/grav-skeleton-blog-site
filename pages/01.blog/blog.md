---
title: Home
blog_url: blog
text_align: center

hero_classes: text-light overlay-dark-gradient
hero_image: road.jpg

show_sidebar: true
show_breadcrumbs: true

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

# My **Grav**tastic Blog
## the ramblings of a rambler
