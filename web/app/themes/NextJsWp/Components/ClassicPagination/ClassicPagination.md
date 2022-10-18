# ClassicPagination component

This is a pagination.

## Usage

```twig
{# Twig #}

{% from '@Components/ClassicPagination/ClassicPagination.twig' import ClassicPagination %}

{{
    ClassicPagination({
        pages: [
            {link: "", title: "1", current: true}
            {link: "/page-2", title: "2"}
            {link: "/page-3", title: "3"}
        ],
        next: {link: "/page-2"}
    })
}}
```

```scss
// SCSS

@import "@Components/ClassicPagination/ClassicPagination";
```

```js
// JS

import ClassicPagination from "@Components/ClassicPagination/ClassicPagination";

new ClassicPagination();
```

### Props

| Name         | Type     | Default   | Description                                                               |
| ------------ | -------- | --------- | ------------------------------------------------------------------------- |
| `id`         | `string` | `null`    | The id                                                                    |
| `classes`    | `array`  | `null`    | List of css classes                                                       |
| `attributes` | `array`  | `null`    | The Array contain the extra attributes or used for merged the attributes. |
| `pages`      | `array`  | `[]`      | The pages                                                                 |
| `type`       | `string` | `classic` | Type of pagination                                                        |
| `prev`       | `object` | `null`    | Previous page                                                             |
| `next`       | `object` | `null`    | Next page                                                                 |
