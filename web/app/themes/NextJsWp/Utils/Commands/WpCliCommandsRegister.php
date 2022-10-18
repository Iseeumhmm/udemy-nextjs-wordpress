<?php

namespace Atlantic\Themes\NextJsWp\Utils\Commands;

use Atlantic\Themes\NextJsWp\Utils\Commands\MakerCommand\Maker as MakerCommands;
use Resulta\WpCommandsAbstract\CommandsRegister;

/**
 * Class to register all new wp-cli commands
 */
class WpCliCommandsRegister extends CommandsRegister
{
    public function __construct()
    {
        if (WP_ENV == "development") {
            parent::__construct();

            $this->addCommand(new MakerCommands\MakeBlock())
                 ->addCommand(new MakerCommands\MakeComponent())
                 ->addCommand(new MakerCommands\MakeTemplate())
                 ->addCommand(new MakerCommands\MakeSingle())
                 ->addCommand(new MakerCommands\MakeTwigExtension())
                 ->addCommand(new MakerCommands\MakePostType())
                 ->addCommand(new MakerCommands\MakeSingle())
            ;
        }
    }
}
