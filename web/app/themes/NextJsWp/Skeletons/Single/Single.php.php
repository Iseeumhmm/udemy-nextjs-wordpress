<?= "<?php\n" ?>

/**
* Single Name: <?= $SingleName ?><?= "<?php\n" ?>
*/

namespace <?= $SingleNamespace ?>;

use Timber\Timber;

$context = Timber::get_context();

/**
* Put your logic code here
**/

Timber::render(array("Singles/<?= $SingleName ?>/<?= $SingleName ?>.twig"), $context, TEMPLATE_CACHE_DURATION, TEMPLATE_CACHE_MODE);
