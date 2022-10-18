# MainNav component

This is the main navigation of the site.

## Usage

```twig
{# Twig #}

{% from '@Components/MainNav/MainNav.twig' import MainNav %}

{{
    MainNav({
        menu: menu,
        search_placeholder: "Search by keywords"
    })
}}
```

```scss
// SCSS

@import '@Components/MainNav/MainNav';
```

```js
// JS

import MainNav from "@Components/MainNav/MainNav";

new MainNav();
```

### Props

| Name                 | Type          | Default | Description                         |
| -------------------- | ------------- | ------- | ----------------------------------- |
| `id`                 | `string`      | `null`  | The id                              |
| `classes`            | `array`       | `null`  | List of css classes                 |
| `menu`               | `Timber\Menu` | `null`  | The menu                            |
| `has_search`         | `boolean`     | `null`  | Is there a seach field              |
| `search_placeholder` | `string`      | `null`  | The search field placeholder        |
| `search_value`       | `string`      | `null`  | The search field value              |