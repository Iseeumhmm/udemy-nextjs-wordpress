# PostMeta component

This is the meta infos usually displayed under the title of a post.

## Usage

```twig
{# Twig #}

{% from '@Components/PostMeta/PostMeta.twig' import PostMeta %}

{{
    PostMeta({
        author: author,
        date: date
    })
}}
```

```scss
// SCSS

@import '@Components/PostMeta/PostMeta';
```

### Props

| Name      | Type            | Default | Description         |
| --------- | --------------- | ------- | ------------------- |
| `id`      | `string`        | `null`  | The id              |
| `classes` | `array`         | `null`  | List of css classes |
| `author`  | `Timber\Author` | `null`  | The author          |
| `date`    | `Date`          | `null`  | The date            |