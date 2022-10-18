<?php

namespace Atlantic\Themes\_NAMESPACE_\Utils\Commands\MakerCommand\Maker;

use Atlantic\Themes\_NAMESPACE_\Utils\Commands\MakerCommand\MakerCommandAbstract;
use Resulta\WpCommandsAbstract\Helpers\StringHelper;
use Resulta\WpCommandsAbstract\Questions\RepeaterQuestions;
use Resulta\WpCommandsAbstract\Questions\RequireQuestion;
use Resulta\WpCommandsAbstract\Questions\Question;

class MakeTwigExtension extends MakerCommandAbstract
{
    /**
     * {@inheritdoc}
     */
    public function getCommandName()
    {
        return 'twig-extension';
    }

    /**
     * Allows you to generate a new twig extension and dynamically add as many filters and functions as you want
     *
     * ## OPTIONS
     * 
     * Not used
     *
     * ## EXAMPLES
     *
     *     wp generate twig-extension
     *
     * @when after_wp_load
     */
    public function __invoke($arguments, $options)
    {
        $this->runStartCommand();
        
        // get name for new block
        $nameQuestion = new RequireQuestion("What will your new Twig Extension be called", "", "Do not add 'Extension' in the name");
        $name = $nameQuestion->ask();
        $name = str_replace(['Extension', 'extension'], '', $name);

        // get destination path for new block
        $srcPathQuestion = new Question("The directory where to create the Twig extension", "Utils/Twig", "themes/$this->currentThemeActive/" . "Utils/Twig");
        $srcPath = $srcPathQuestion->ask();
        // get nameSpace for new block
        $namespaceQuestion = new Question("The namespace for new Twig extension file php", $this->defaultNameSpace. "\Utils\Twig", $this->defaultNameSpace. "\Utils\Twig");
        $namespace = $namespaceQuestion->ask();

        $filtersQuestion = new RepeaterQuestions("Do you want to add one or more filters to this extension?", [
            new RequireQuestion("What is the name of the filter"),
            new RequireQuestion("What is the name used for this filter")
        ]);
        $filters = $filtersQuestion->ask();

        foreach ($filters as $key => &$filter) {
            $filter['name'] = StringHelper::camel($filter[0]);
            $filter['functionName'] = StringHelper::camel($filter[1]);

            unset($filter[0]);
            unset($filter[1]);
        }
        
        $functionsQuestion = new RepeaterQuestions("Do you want to add one or more filters to this extension?", [
            new RequireQuestion("What is the name of the Function"),
            new RequireQuestion("What is the name used for this Function")
        ]);
        $functions = $functionsQuestion->ask();

        foreach ($functions as $key => &$function) {
            $function['name'] = StringHelper::camel($function[0]);
            $function['functionName'] = StringHelper::camel($function[1]);

            unset($function[0]);
            unset($function[1]);
        }
           
        $srcPath   = $this->defaultSrcPath . trim($srcPath, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;

        $params = [
            "ExtensionName" => StringHelper::pascal($name.'Extension'),
            "ExtensionNameSnake" => StringHelper::snake($name),
            "ExtensionNamespace" => $namespace,
            "filters" => $filters,
            "functions" => $functions,
        ];

        $params['functions'] = $functions;      

        $this->generator->renderFile("Twig" . DIRECTORY_SEPARATOR ."TwigExtension.php.php", $srcPath. $params['ExtensionName'] . '.php', $params);

        $this->runEndCommand();
    }
}
