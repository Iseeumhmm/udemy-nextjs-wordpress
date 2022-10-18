# TextInput component

This is a text input.

## Usage

```twig
{# Twig #}

{% from '@Components/TextInput/TextInput.twig' import TextInput %}

{{
    TextInput({
        name: 's',
        placeholder: "Type something here"
    })
}}
```

```scss
// SCSS

@import '@Components/TextInput/TextInput';
```

### Props

| Name          | Type      | Default | Description                                            |
| ------------- | -------- | ------- | ------------------------------------------------------- |
| `id`          | `string` | `null`  | The id                                                  |
| `classes`     | `array`  | `[]`    | List of css classes                                     |
| `value`       | `string` | `null`  | The value                                               |
| `name`        | `string` | `null`  | The name                                                |
| `placeholder` | `string` | `null`  | The placeholder                                         |
| `on_click`    | `string` | `null`  | Name of a JS function to be called when a click occurs  |
| `on_change`   | `string` | `null`  | Name of a JS function to be called when a change occurs |