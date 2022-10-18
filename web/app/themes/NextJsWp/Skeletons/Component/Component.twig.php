{% macro <?= $ComponentName ?>(props) %}
    {#
        <?= $ComponentName ?>

        This component is an <?= str_replace("-", " ", $ComponentNameSlugify) ?>.

        @param {string} id The id
        @param {array} classes List of css classes
        @param {string} attributes The Array contain the extra attributes or used for merged the attributes. example : class attribute
<?php if ($properties) : ?>
    <?php foreach ($properties as $property) : ?>
    @param {<?= $property[1] ?>} <?= $property[0] ?> <?= $property[2] ?> <?= "\n" ?>
    <?php endforeach; ?>
<?php endif ?>

    #}

    {# Output #}
    <div  {{ 
        {
            id: props.id,
            class: (props.classes ?? [])|merge(['<?= $ComponentNameSlugify ?>']),
            <?php if ($properties) : ?>
<?php foreach ($properties as $property) : ?>
<?= $property[0] ?>: props.<?= $property[0] ?>,<?= "\n" ?>
<?php endforeach; ?>
<?php endif ?>
        }|arrayToAttributesHTML(props.attributes) 
    }}>
        {#
            Put your content here
        #}
    </div>

{% endmacro %}
