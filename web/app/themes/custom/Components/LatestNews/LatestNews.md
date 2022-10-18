# LatestNews component

This is the latest news.

## Usage

```twig
{# Twig #}

{% from '@Components/LatestNews/LatestNews.twig' import LatestNews %}

{{
    LatestNews({
        news: latest_news
    })
}}
```

```scss
// SCSS

@import '@Components/LatestNews/LatestNews';
```

### Props

| Name                | Type           | Default           | Description                    |
| ------------------- | -------------- | ----------------- | ------------------------------ |
| `id`                | `string`       | `null`            | The id                         |
| `classes`           | `array`        | `null`            | List of css classes            |
| `news`              | `array`        | `null`            | The list of news               |
| `title`             | `string`       | `Recent News`     | The title                      |
| `read_more_text`    | `string`       | `Read More News`  | The text of the read more link |