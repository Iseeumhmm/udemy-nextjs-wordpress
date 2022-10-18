# PostsLoop component

This is displaying posts with NewsCard and pagination.

To be able to use this pagination it is necessary that the variable posts is the result of "TimberPostQuery".

## Usage

```twig
{# Twig #}

{% from '@Components/PostsLoop/PostsLoop.twig' import PostsLoop %}

{{
  PostsLoop({
    posts: posts,
    pagination_is_load_more: false
  })
}}
```

```scss
// SCSS

@import "@Components/PostsLoop/PostsLoop";
```

### Props

| Name                      | Type      | Default | Description                                     |
| ------------------------- | --------- | ------- | ----------------------------------------------- |
| `id`                      | `string`  | `null`  | The id                                          |
| `classes`                 | `array`   | `null`  | List of css classes                             |
| `posts`                   | `array`   | `null`  | The list of posts                               |
| `pagination_is_load_more` | `boolean` | `null`  | Is pagination of load more type                 |
| `targeted_page`           | `integer` | `null`  | The targeted page, in the case of loadMore type |
| `current_page`            | `integer` | `null`  | The current page, in the case of loadMore type  |
| `post_preview_length`     | `integer` | `null`  | The text length of the posts preview text       |
