# SocialShare component

This is to share a link on social medias.

## Usage

```twig
{# Twig #}

{% from '@Components/SocialShare/SocialShare.twig' import SocialShare %}

{{
    SocialShare({
        link: "https://youtu.be/dQw4w9WgXcQ"
    })
}}
```

```scss
// SCSS

@import '@Components/SocialShare/SocialShare';
```

### Props

| Name         | Type     | Default | Description                |
| ------------ | -------- | ------- | -------------------------- |
| `id`         | `string` | `null`  | The id                     |
| `classes`    | `array`  | `[]`    | List of css classes        |
| `share_text` | `string` | `Share` | The text before the icons  |
| `link`       | `string` | `null`  | The link to share          |