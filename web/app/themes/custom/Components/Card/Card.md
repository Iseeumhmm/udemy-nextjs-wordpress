# Card component

This is a card.

## Usage

```twig
{# Twig #}

{% from '@Components/Card/Card.twig' import Card %}

{{
    Card({
        content: "3♠️"
    })
}}
```

```scss
// SCSS

@import '@Components/Card/Card';
```

### Props

| Name      | Type     | Default | Description                 |
| --------- | -------- | ------- | --------------------------- |
| `id`      | `string` | `null`  | The id of the card          |
| `classes` | `array`  | `null`  | List of css classes         |
| `content` | `string` | `null`  | Content wrapped by the card |