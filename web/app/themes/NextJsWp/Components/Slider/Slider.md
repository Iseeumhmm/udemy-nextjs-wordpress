# Slider component

This is a slider.

## Usage

```twig
{# Twig #}

{% from '@Components/Slider/Slider.twig' import Slider %}

{{
    Slider({
        slides: [
            {content: 'Would'},
            {content: 'You'},
            {content: 'Eat'},
            {content: 'Cheese'}
        ]
    })
}}
```

```scss
// SCSS

@import '@Components/Slider/Slider';
```

```js
// JS

import Slider from "@Components/Slider/Slider";

new Slider();
```

### Props

| Name        | Type      | Default | Description                |
| ----------- | --------- | ------- | -------------------------- |
| `id`        | `string`  | `null`  | The id                     |
| `classes`   | `array`   | `[]`    | List of css classes        |
| `prev_next` | `boolean` | `true`  | Is there prev/next arrows? |
| `dots`      | `boolean` | `true`  | Is there nav dots?         |
| `slides`    | `array`   | `[]`    | The slides                 |