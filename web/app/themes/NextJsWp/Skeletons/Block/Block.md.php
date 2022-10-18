# <?= $BlockName ?> Block

This is a <?= $BlockName ?> section.

## Usage

```twig
{# Twig #}

{% from '@Blocks/<?= $BlockName ?>/<?= $BlockName ?>.twig' import <?= $BlockName ?> %}

{{
<?= $BlockName ?>({
    /**
     * @todo : Add your properties
     */
  })
}}
```

```scss
// SCSS

@import "@Blocks/<?= $BlockName ?>/<?= $BlockName ?>";
```

### Props

| Name              | Type           | Default | Description                                      |
| ----------------- | -------------- | ------- | ------------------------------------------------ |
| `id`              | `string`       | `null`  | The id                                           |
| `classes`         | `array`        | `[]`    | List of css classes                              |
| `attributes`      | `array`        | `null`  | The extras attributes                            |
/**
* @todo : Add your properties informations
*/