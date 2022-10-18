<?php

namespace Atlantic\Themes\_NAMESPACE_\Components\NewsCard;

use Atlantic\Themes\_NAMESPACE_\Utils\Twig\ComponentAbstract;

class NewsCard extends ComponentAbstract
{

    public function updateContext()
    {
        $this->context['qqq'] = 'www';
    }
}
