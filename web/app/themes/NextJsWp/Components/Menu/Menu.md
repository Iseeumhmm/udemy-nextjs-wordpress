# Menu component

This is a menu.

## Usage

```twig
{# Twig #}

{% from '@Components/Menu/Menu.twig' import Menu %}

{{
    Menu({
        items: [
            {title: "A menu", children: [
                {title: "A submenu", url: "#"},
                {title: "Another submenu", url: "#"},
                ]
            },
            {title: "A second menu", url: "#"},
        ]
    })
}}
```

```scss
// SCSS

@import '@Components/Menu/Menu';
```

### Props

| Name             | Type     | Default | Description                                    |
| ---------------- | -------- | ------- | ---------------------------------------------- |
| `id`             | `string` | `null`  | The id                                         |
| `classes`        | `array`  | `null`  | List of css classes                            |
| `items`          | `array`  | `null`  | The items                                      |
| `aria_label`     | `string` | `null`  | The aria label of the nav tag                  |
| `before_content` | `string` | `null`  | Raw content inside the nav tag before the menu |
| `after_content`  | `string` | `null`  | Raw content inside the nav tag after the menu  |