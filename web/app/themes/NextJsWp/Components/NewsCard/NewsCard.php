<?php

namespace Atlantic\Themes\NextJsWp\Components\NewsCard;

use Atlantic\Themes\NextJsWp\Utils\Twig\ComponentAbstract;

class NewsCard extends ComponentAbstract
{

    public function updateContext()
    {
        $this->context['qqq'] = 'www';
    }
}
