# GamblingTable component

This is the CTA Table, it displays a table of CTAs coming from the gambling-ads plugin.

## Usage

```twig
{# Twig #}

{% from '@Components/GamblingTable/GamblingTable.twig' import GamblingTable %}

{{
    GamblingTable({
        tables: [...]
    })
}}
```

```scss
// SCSS

@import '@Components/GamblingTable/GamblingTable';
```

### Props

| Name      | Type     | Default | Description                 |
| --------- | -------- | ------- | --------------------------- |
| `id`      | `string` | `null`  | The id                      |
| `classes` | `array`  | `null`  | List of css classes         |
| `tables`  | `array`  | []      | The tables data             |

Note: `tables` is an array of multiple tables with each being an array containing all required data. We have an array of tables because one GamblingTable can display multiple tables using tabs to select which is visible one at a time for example.