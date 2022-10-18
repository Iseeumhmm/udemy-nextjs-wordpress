# Link component

This is a link.

## Usage

```twig
{# Twig #}

{% from '@Components/Link/Link.twig' import Link %}

{{
    Link({
        href: 'https://www.npmjs.com/package/isitfriday',
        content: "Is it Friday?"
    })
}}
```

```scss
// SCSS

@import '@Components/Link/Link';
```

### Props

| Name                | Type           | Default | Description                         |
| ------------------- | -------------- | ------- | ----------------------------------- |
| `id`                | `string`       | `null`  | The id                              |
| `classes`           | `array`        | `null`  | List of css classes                 |
| `href`              | `array`        | `null`  | The list of news                    |
| `title`             | `string`       | `null`  | The title                           |
| `target`            | `string`       | `null`  | _blank|_self|_parent|_top|framename |
| `rel`               | `string`       | `null`  | The rel attribute                   |
| `content`           | `string`       | `null`  | The content wrapped in the link     |