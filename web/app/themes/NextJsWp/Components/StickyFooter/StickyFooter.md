# StickyFooter component

This is a sticky bar, it sticks to the bottom of the screen.

## Usage

```twig
{# Twig #}

{% from '@Components/StickyFooter/StickyFooter.twig' import StickyFooter %}

{{
    StickyFooter({
        content: 'Anything you want here'
    })
}}
```

```scss
// SCSS

@import '@Components/StickyFooter/StickyFooter';
```

```js
// JS

import Slider from "@Components/StickyFooter/StickyFooter";

new StickyFooter();
```

### Props

| Name      | Type      | Default | Description                |
| --------- | --------- | ------- | -------------------------- |
| `id`      | `string`  | `null`  | The id                     |
| `classes` | `array`   | `[]`    | List of css classes        |
| `content` | `boolean` | `true`  | The content in the bar     |