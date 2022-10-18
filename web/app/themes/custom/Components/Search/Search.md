# Search component

This is a search form, it is showing/hidding on click on an icon.

## Usage

```twig
{# Twig #}

{% from '@Components/Search/Search.twig' import Search %}

{{
    Search({
        placeholder: "Search by keywords",
        value: searched_value
    })
}}
```

```scss
// SCSS

@import '@Components/Search/Search';
```

```js
// JS

import Search from "@Components/Search/Search";
```

### Props

| Name          | Type      | Default | Description                       |
| ------------- | --------- | ------- | --------------------------------- |
| `id`          | `string`  | `null`  | The id                            |
| `classes`     | `array`   | `[]`    | List of css classes               |
| `placeholder` | `string`  | `null`  | The placeholder of the text field |
| `value`       | `string`  | `null`  | The value of the text field       |
| `has_label`   | `boolean` | `null`  | Does the text field has a label?  |
| `submit_text` | `string`  | `null`  | The text of the submit button     |