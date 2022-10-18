<?php

namespace Atlantic\Themes\NextJsWp\Utils\Commands\MakerCommand;

use Resulta\WpCommandsAbstract\PluginCommandAbstract;
use Resulta\WpCommandsAbstract\Generators\Generator;
use WP_CLI;

abstract class MakerCommandAbstract extends PluginCommandAbstract
{
    /**
     * Array containing all the different types of Generator
     *
     * @var Generator
     */
    protected $generator;
    /**
     * defaultNameSpace
     *
     * @var mixed
     */
    protected $defaultNameSpace;
    /**
     * defaultSrcPath
     *
     * @var mixed
     */
    protected $defaultSrcPath;
    /**
     * Use to retrieve the folder name of the current wordpress theme
     *
     * @var string
     */
    protected $currentThemeActive;
    /**
     * Use to retrieve the folder name of the current wordpress theme
     *
     * @var string
     */
    protected $defaultGenerateDirPath;

    public function __construct()
    {
        $this->currentThemeActive = wp_get_theme()->get('Name');
        $this->defaultNameSpace = "Atlantic\Themes\\" . $this->currentThemeActive;
        $this->defaultSrcPath = get_template_directory(). DIRECTORY_SEPARATOR;
        $this->defaultSkeletonDirPath = $this->defaultSrcPath . 'Skeletons';
        $this->generator = new Generator($this->defaultSkeletonDirPath);
    }

    /**
     * {@inheritdoc}
     */
    abstract public function getCommandName();

    /**
     * {@inheritdoc}
     */
    abstract public function __invoke($arguments, $options);

    /**
     * {@inheritdoc}
     */
    public function getPluginCommandName()
    {
        return 'make';
    }

    protected function runStartCommand()
    {
        $generateCommandsString = "
++++++++++++++++++++++++++++++++++++++++++++
|                                          |
|              Maker Command               |
|                                          |
++++++++++++++++++++++++++++++++++++++++++++
";
        WP_CLI::line(WP_CLI::colorize("%g" . $generateCommandsString));
        WP_CLI::line(WP_CLI::colorize("%N"));
    }

    protected function runEndCommand()
    {
        $generateCommandsString = "
++++++++++++++++++++++++++++++++++++++++++++
|                                          |
|             Maker End Command            |
|                                          |
++++++++++++++++++++++++++++++++++++++++++++
";
        WP_CLI::line(WP_CLI::colorize("%g" . $generateCommandsString));

        WP_CLI::line(WP_CLI::colorize("%N"));
    }
}
