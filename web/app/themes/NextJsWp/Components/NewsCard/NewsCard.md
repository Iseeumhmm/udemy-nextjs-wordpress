# NewsCard component

This is a news card.

## Usage

```twig
{# Twig #}

{% from '@Components/NewsCard/NewsCard.twig' import NewsCard %}

{{
  NewsCard({
    title: 'Hi',
    link: '/hi',
    thumbnail: thumbnail,
    text: 'Hi diddly ho neighborinos!',
    author: flanders,
    date: modified_date
  })
}}
```

```scss
// SCSS

@import "@Components/NewsCard/NewsCard";
```

### Props

| Name                | Type            | Default         | Description           |
| ------------------- | --------------- | --------------- | --------------------- |
| `id`                | `string`        | `null`          | The id                |
| `classes`           | `array`         | `null`          | List of css classes   |
| `title`             | `string`        | `null`          | The title             |
| `link`              | `string`        | `null`          | The link              |
| `thumbnail`         | `Timber\Image`  | `null`          | The thumbnail         |
| `text`              | `string`        | `null`          | The text              |
| `author`            | `Timber\Author` | `null`          | The author            |
| `date`              | `date`          | `null`          | The date              |
| `date_format`       | `string`        | `D, M jS, g:ia` | The date format       |
| `last_updated_text` | `string`        | `Last updated`  | The last updated text |
| `readmore_text`     | `string`        | `Read More`     | The read more text    |
| `attributes`        | `array[string]` | `null`          | The of attributes     |
