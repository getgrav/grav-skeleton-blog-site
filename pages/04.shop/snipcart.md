---
title: Bike Shop
subtitle: get on your bike!
body_classes: fullwidth
process:
    twig: true
enigma:
    hero:
        overlay: false
        size: small
        background: 'linear-gradient(#BCBFD2, #f7f7f7)'
content:
    items: @self.children
    order:
        by: title
        dir: asc
---

[owl-carousel items=1 margin=10 loop=true autoplay=false autoplayHoverPause=true nav=true]
<div style="background: url({{ page.media['image-1.jpg'].brightness(-70).url }}) 50% 50%;background-size: cover;color:#fff;">
  <h2>Start the season off right</h2>
  <h3>with a new bike!</h3>
</div>
<div style="background: url({{ page.media['image-2.jpg'].brightness(-70).url }}) 50% 50%;background-size: cover;color:#fff;">
  <h2>Get amazing deals on both</h2>
  <h3>mountain and road bikes</h3>
</div>
<div style="background: url({{ page.media['image-3.jpg'].brightness(-70).url }}) 50% 50%;background-size: cover;color:#fff;">
  <h2>Get the kit you need</h2>
  <h3>no matter your skill level</h3>
</div>
[/owl-carousel]

Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat.
