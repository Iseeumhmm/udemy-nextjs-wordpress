# Header component

This is the heaser of the site.

## Usage

```twig
{# Twig #}

{% from '@Components/Header/Header.twig' import Header %}

{{
    Header({
        menu: menu,
        logo: logo
    })
}}
```

```scss
// SCSS

@import '@Components/Header/Header';
```

### Props

| Name                | Type           | Default | Description                 |
| ------------------- | -------------- | ------- | --------------------------- |
| `id`                | `string`       | `null`  | The id                      |
| `classes`           | `array`        | `null`  | List of css classes         |
| `menu`              | `Timber\Menu`  | `null`  | The menu                    |
| `logo`              | `string`       | `null`  | The logo url                |
| `copyright_text`    | `string`       | `null`  | The copyright text          |