# Byline component

This is a Byline component, Displays the author and publication information of a post.

## Usage

```twig
{# Twig #}

{% from '@Component/Byline/Twig' import Byline %}

{{
  Byline({
    post: post,
    dateformat: 'F d, Y',
    features: {
      published: false,
      updated: {
        label: 'Updated'
      }
    },
    classes: ['site-header-content__byline']
  })
}}
```

```scss
// SCSS

@import "@Components/Byline/Byline";
```

### Props

| Name         | Type           | Default | Description                                                                                   |
| ------------ | -------------- | ------- | --------------------------------------------------------------------------------------------- |
| `id`         | `string`       | `null`  | The id of the Byline                                                                          |
| `classes`    | `array`        | `[]`    | List of css classes                                                                           |
| `attributes` | `string`       | `null`  | Text of the Byline                                                                            |
| `post`       | `TimberPost`   | `null`  | the Timber/Post Object of the page to gather information from                                 |
| `dateformat` | `string`       | `null`  | The string format to use for formatting the date.                                             |
| `features`   | `array[mixed]` | `null`  | An array of arrays used for byline features, a feature or label set to false will not appear. |
