# Syndication Feed Plugin for Grav

This plugin support both __Atom 1.0__ and __RSS__ feed types. Enabling is very simple. just install this plugin in the `/user/plugins/`` folder in your Grav install. By default the plugin is enabled and provides some default values.

## Feed Usage

The feeds work for pages that have sub-pages, for example a blog list view. If your page has a `sub_pages` header variable that defines a taxonomy or `true` to display sub-pages, then the RSS plugin will automatically be enabled. Simply append either `feed:atom` or `feed:rss` to the url.

eg:

```
http://www.mysite.com/blog/feed:atom
```

## RSS Plugin Defaults

```
limit: 10
description: My Feed Description
lang: en-us
length: 500
```

You can override any of the default values by setting one or more of these in your blog list page where `sub_pages` is defined. For example:

```
title: Sample Blog
content:
    items: @self.children
    limit: 5
    pagination: true
feed:
    limit: 15
    description: Sample Blog Description
```
