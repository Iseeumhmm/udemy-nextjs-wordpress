# LoadMorePagination component

This is a load more pagination. This pagination allows to display a button to load the posts in ajax.

## Usage

```twig
{# Twig #}

{% from '@Components/LoadMorePagination/LoadMorePagination.twig' import LoadMorePagination %}

{{
  LoadMorePagination({
    next: {
      link: '/page-2'
    }
  })
}}
```

```scss
// SCSS

@import "@Components/LoadMorePagination/LoadMorePagination";
```

```js
// JS

import LoadMorePagination from "@Components/LoadMorePagination/LoadMorePagination";

new LoadMorePagination();
```

### Props

| Name            | Type      | Default    | Description                                                               |
| --------------- | --------- | ---------- | ------------------------------------------------------------------------- |
| `id`            | `string`  | `null`     | The id                                                                    |
| `classes`       | `array`   | `null`     | List of css classes                                                       |
| `attributes`    | `array`   | `null`     | The Array contain the extra attributes or used for merged the attributes. |
| `type`          | `string`  | `loadMore` | Type of pagination                                                        |
| `next`          | `object`  | `null`     | Next page                                                                 |
| `targeted_page` | `integer` | `1`        | The targeted page                                                         |
| `current_page`  | `integer` | `1`        | The current page                                                          |
