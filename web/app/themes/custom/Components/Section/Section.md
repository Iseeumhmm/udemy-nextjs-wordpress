# Section component

This is a section.

## Usage

```twig
{# Twig #}

{% from '@Components/Section/Section.twig' import Section %}

{{
    Section({
        title: "Tabs are great",
        content: "Yes they are."
    }}
}}
```

```scss
// SCSS

@import "@Components/Section/Section";
```

### Props

| Name               | Type           | Default | Description                                      |
| ------------------ | -------------- | ------- | ------------------------------------------------ |
| `id`               | `string`       | `null`  | The id                                           |
| `classes`          | `array`        | `[]`    | List of css classes                              |
| `background_image` | `Timber\Image` | `null`  | The background image                             |
| `title`            | `string`       | `null`  | The title                                        |
| `title_alignment`  | `string`       | `null`  | The alignment of the title (`left/center/right`) |
| `content`          | `string`       | `null`  | The content                                      |
