# <?= $ComponentName ?> Component

This is a <?= $ComponentName ?>.

## Usage

```twig
{# Twig #}

{% from '@Components/<?= $ComponentName ?>/<?= $ComponentName ?>.twig' import <?= $ComponentName ?> %}

{{
<?= $ComponentName ?>({
    /**
     * @todo : Add your properties
     */
  })
}}
```

```scss
// SCSS

@import "@Components/<?= $ComponentName ?>/<?= $ComponentName ?>";
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