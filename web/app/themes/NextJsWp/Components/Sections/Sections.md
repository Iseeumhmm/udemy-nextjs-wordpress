# Section component

This is the sections loop, it calls the sections Blocks according to the flex ACF field `page_sections`.

## Usage

```twig
{# Twig #}

{% from '@Components/Sections/Sections.twig' import Sections %}

{{
    Sections({
        page_sections: post.meta('page_sections')
    }}
}}
```

### Props

| Name            | Type    | Default | Description                     |
| --------------- | ------- | ------- | ------------------------------- |
| `page_sections` | `array` | `null`  | The sections as provided by ACF |