# GamblingTableSection component

This is the Gambling Table Section, displays a table of data coming from the gambling-ads plugin.

## Usage

```twig
{# Twig #}

{% from '@Blocks/GamblingTableSection/GamblingTableSection.twig' import GamblingTableSection %}

{{
  GamblingTableSection({
    title: '$5k to the first to click!',
    content: 'Stop wasting you money and click on the buttons bellow!',
    cta_shortcode: "[get_cta id='123']"
  })
}}
```

```scss
// SCSS

@import "@Blocks/GamblingTableSection/GamblingTableSection";
```

### Props

| Name              | Type     | Default | Description                                      |
| ----------------- | -------- | ------- | ------------------------------------------------ |
| `id`              | `string` | `null`  | The id                                           |
| `classes`         | `array`  | `[]`    | List of css classes                              |
| `title`           | `string` | `null`  | The title                                        |
| `title_alignment` | `string` | `null`  | The alignment of the title (`left/center/right`) |
| `content`         | `string` | `null`  | The content                                      |
| `cta_shortcode`   | `string` | `null`  | The gambling-ads shortcode                       |
