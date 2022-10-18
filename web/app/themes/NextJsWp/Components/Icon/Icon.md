# Icon component

This is an icon.

## Usage

```twig
{# Twig #}

{% from '@Components/Icon/Icon.twig' import Icon %}

{{
    Icon({
        icon: 'arrow-up'
    })
}}
```

```scss
// SCSS

@import '@Components/Icon/Icon';
```

### Props

| Name                | Type           | Default | Description                 |
| ------------------- | -------------- | ------- | --------------------------- |
| `id`                | `string`       | `null`  | The id                      |
| `classes`           | `array`        | `null`  | List of css classes         |
| `icon`              | `string`       | `null`  | The string id of the icon   |