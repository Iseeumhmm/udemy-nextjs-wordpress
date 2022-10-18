{% macro <?= $BlockName ?>(props) %}
    {#
        <?= $BlockName ?>

        This component is an <?= str_replace("-", " ", $BlockNameSlugify) ?>.

        @param {string} id The id
        @param {array} classes List of css classes
<?php if ($properties) : ?>
    <?php foreach ($properties as $property) : ?>
    @param {<?= $property[1] ?>} <?= $property[0] ?> <?= $property[2] ?> <?= "\n" ?>
    <?php endforeach; ?>
<?php endif ?>

    #}

    {# Output #}
    {% from '@Components/Section/Section.twig' import Section %}

    {{
        Section({
            id: prop.id,
            classes: (props.classes ?? [])|merge(['<?= $BlockNameSlugify ?>']),
            attributes: props.attributes,
            content: _self.sectionContent({

            })
        }) 
    }}

{% endmacro %}

{% macro sectionContent(props) %}
    <div class="<?= $BlockNameSlugify ?>__content">
    
    </div>
{% endmacro %}