# Button component

This is a button.

## Usage

```twig
{# Twig #}

{% from '@Component/Button/Twig' import Button %}

{{
  Button({
    text: 'Click me!'
  })
}}
```

```scss
// SCSS

@import "@Components/Button/Button";
```

### Props

| Name       | Type           | Default | Description                |
| ---------- | -------------- | ------- | -------------------------- |
| `id`       | `string`       | `null`  | The id of the button       |
| `classes`  | `array`        | `[]`    | List of css classes        |
| `text`     | `string`       | `null`  | Text of the button         |
| `disabled` | `bool`         | `false` | Is the button disable?     |
| `on_click` | `string`       | `null`  | On Click callback function |
| `type`     | `reset/submit` | `null`  | Type of the button         |
| `role`     | `string`       | `null`  | Role of the button         |
