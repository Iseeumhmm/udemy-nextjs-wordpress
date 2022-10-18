# Picture component

This is a picture.

## Usage

```twig
{# Twig #}

{% from '@Components/Picture/Picture.twig' import Picture %}

{# Use 'souces' attribute %#
{{
    Picture({
        sources: [
        {
            url: image.src('large')
        },
        {
            media: '(min-width: 768px)',
            url: image.src('medium')
        }
        ],
        width: image.width,
        height: image.height,
        alt: image.alt
    })
}}

{# Use 'imageId' attribute %#
{{
    Picture({
        imageId: 12,
    })
}}
```

### Props

| Name         | Type      | Default   | Description                                  |
| ------------ | --------- | --------- | -------------------------------------------- |
| `id`         | `string`  | `null`    | The id                                       |
| `classes`    | `array`   | `[]`      | List of css classes                          |
| `sources`    | `array`   | `[]`      | The picture sources `[{media: "", url: ""}]` |
| `alt`        | `string`  | `null`    | The alt attribute                            |
| `width`      | `integer` | `null`    | The width attribute                          |
| `height`     | `integer` | `null`    | The height attribute                         |
| `imageId`    | `integer` | `null`    | The Attachment id                            |
| `attributes` | `integer` | `null`    | The extras attributes                        |