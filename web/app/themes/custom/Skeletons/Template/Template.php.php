<?= "<?php\n" ?>

/**
* Template Name: <?= $TemplateName ?><?= "<?php\n" ?>
*/

namespace <?= $TemplateNamespace ?>;

use Timber\Timber;

$context = Timber::get_context();

/**
* Put your logic code here
**/

Timber::render(array("Templates/<?= $TemplateName ?>/<?= $TemplateName ?>.twig"), $context, TEMPLATE_CACHE_DURATION, TEMPLATE_CACHE_MODE);
