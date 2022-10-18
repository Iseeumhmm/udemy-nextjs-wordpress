# AuthorCard component

This is an author card, it shows the author's picture and infos.

## Usage

```twig
{# Twig #}

{% from '@Components/AuthorCard/AuthorCard.twig' import AuthorCard %}

{{
    AuthorCard({
        description: author.description
        link: author.link,
        name: author.name,
        picture: author.avatar,
    })
}}
```

```scss
// SCSS

@import '@Components/AuthorCard/AuthorCard';
```

### Properties

**Required props are marked with `*`.**

| Name           | Type           | Default | Description               |
| -------------- | -------------- | ------- | ------------------------- |
| `id`           | `string`       | `null`  | The id of the menu        |
| `classes`      | `array`        | `[]`    | List of css classes       |
| `link`         | `string`       | `null`  | Link to the author's page |
| `picture`      | `Timber\Image` | `null`  | Picture of the author     |
| `name`*        | `string`       | `null`  | Name of the author        |
| `description`* | `string`       | `null`  | Description of the author |