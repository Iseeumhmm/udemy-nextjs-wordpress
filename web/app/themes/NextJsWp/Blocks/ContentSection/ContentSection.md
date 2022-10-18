# ContentSection component

This is a content section.

## Usage

```twig
{# Twig #}

{% from '@Blocks/ContentSection/ContentSection.twig' import ContentSection %}

{{
  ContentSection({
    title: 'Exceptional dynamical quantum phase transitions in periodically driven systems',
    content: '<p>Extending notions of phase transitions to nonequilibrium realm is a fundamental problem for statistical mechanics. While it was discovered that critical transitions occur even for transient states before relaxation as the singularity of a dynamical version of free energy, their nature is yet to be elusive.</p>'
  })
}}
```

```scss
// SCSS

@import "@Blocks/ContentSection/ContentSection";
```

### Props

| Name              | Type           | Default | Description                                      |
| ----------------- | -------------- | ------- | ------------------------------------------------ |
| `id`              | `string`       | `null`  | The id                                           |
| `classes`         | `array`        | `[]`    | List of css classes                              |
| `layout`          | `string`       | `null`  | The layout (`null / two_columns`)                |
| `title`           | `string`       | `null`  | The title                                        |
| `title_position`  | `string`       | `null`  | The title position (`null / section_header`)     |
| `title_alignment` | `string`       | `null`  | The alignment of the title (`left/center/right`) |
| `content`         | `string`       | `null`  | The content                                      |
| `text_position`   | `string`       | `null`  | The text position (`null / right`)               |
| `image`           | `Timber\Image` | `null`  | The image                                        |
| `variants`        | `array`        | `[]`    | The variants                                     |
