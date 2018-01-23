---
title: Body & Hero Classes
date: 14:55 08/11/2017
author: Tasha Maxwell

hero_classes: text-light title-h1h2 overlay-dark-gradient hero-large parallax
hero_image: unsplash-overcast-mountains.jpg
show_sidebar: true

taxonomy:
    category: blog
    tag: [journal, photography]
---


The [Quark theme](https://getgrav.org/downloads/themes) has the ability to allow pages to override some of the default options by letting the user set `body_classes` for any page.  The theme will merge the combination of the defaults with any `body_classes` set. This allows you to easily add hero classes to give your blog post some **bling**.

===

## Body Classes

```yaml
body_classes: "header-dark header-transparent"
```

On a particular page will ensure that page has those options enabled (assuming they are false by default).

## Hero Options

The hero template allows some options to be set in the page frontmatter. This is used by the modular `hero` as well as the blog and item templates to provide a more dynamic header.

```yaml
hero_classes: text-light title-h1h2 parallax overlay-dark-gradient hero-large
hero_image: road.jpg
hero_align: center
```

The `hero_classes` option allows a variety of hero classes to be set dynamically these include:

* `text-light` | `text-dark` - Controls if the text should be light or dark depending on the content
* `title-h1h2` - Enforced a close matched h1/h2 title pairing
* `parallax` - Enables a CSS-powered parallax effect
* `overlay-dark-gradient` - Displays a transparent gradient which further darkens the underlying image
* `overlay-light-gradient` - Displays a transparent gradient which further lightens the underlying image
* `overlay-dark` - Displays a solid transparent overlay which further darkens the underlying image
* `overlay-light` - Displays a solid transparent overlay which further darkens the underlying image
* `hero-fullscreen` | `hero-large` | `hero-medium` | `hero-small` | `hero-tiny` - Size of the hero block

The `hero_image` should point to an image file in the current page folder.