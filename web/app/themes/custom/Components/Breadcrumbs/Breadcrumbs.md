# Breadcrumbs component

This is the site's breadcrumbs navigation.

## Usage

```twig
{# Twig #}

{% from '@Components/Breadcrumbs/Breadcrumbs.twig' import Breadcrumbs %}

{{
  Breadcrumbs({
    items: [
      {
        text: 'Home',
        link: '/'
      },
      {
        text: 'Why tabs are better than spaces',
        link: '/tabs-better-than-spaces'
      }
    ]
  })
}}
```

```scss
// SCSS

@import "@Components/Breadcrumbs/Breadcrumbs";
```

### Props

**Required props are marked with `*`.**

| Name      | Type     | Default | Description                                   |
| --------- | -------- | ------- | --------------------------------------------- |
| `id`      | `string` | `null`  | The id of the menu                            |
| `classes` | `array`  | `[]`    | List of css classes                           |
| `items`\* | `object` | `null`  | List of items \[{text:"Home", link:"#"},...\] |
