# Footer component

This is the footer of the site.

## Usage

```twig
{# Twig #}

{% from '@Components/Footer/Footer.twig' import Footer %}

{{
    Footer({
        menu: menu,
        logo: logo,
        copyright_text: "© Tabs are better than spaces."
    })
}}
```

```scss
// SCSS

@import '@Components/Footer/Footer';
```

### Props

| Name                | Type           | Default | Description                 |
| ------------------- | -------------- | ------- | --------------------------- |
| `id`                | `string`       | `null`  | The id                      |
| `classes`           | `array`        | `null`  | List of css classes         |
| `menu`              | `Timber\Menu`  | `null`  | The menu                    |
| `logo`              | `string`       | `null`  | The logo url                |
| `copyright_text`    | `string`       | `null`  | The copyright text          |