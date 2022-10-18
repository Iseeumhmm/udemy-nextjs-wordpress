<?php

namespace Atlantic\Themes\NextJsWp\Utils\Commands\MakerCommand\Maker;

use Atlantic\Themes\NextJsWp\Utils\Commands\MakerCommand\MakerCommandAbstract;
use Resulta\WpCommandsAbstract\Helpers\StringHelper;
use Resulta\WpCommandsAbstract\Questions\ChoicesQuestion;
use Resulta\WpCommandsAbstract\Questions\RequireQuestion;
use Resulta\WpCommandsAbstract\Questions\Question;
use Resulta\WpCommandsAbstract\Questions\RepeaterQuestions;

class MakeComponent extends MakerCommandAbstract
{
    /**
     * {@inheritdoc}
     */
    public function getCommandName()
    {
        return 'component';
    }

    /**
     * Allows you to generate a new component using a skeleton
     *
     * ## OPTIONS
     * 
     * Not used
     *
     * ## EXAMPLES
     *
     *     wp generate component
     *
     * @when after_wp_load
     */
    public function __invoke($arguments, $options)
    {
        $this->runStartCommand();
       
        // get name for new block
        $nameQuestion = new RequireQuestion("What will your new Component be called");
        $name = $nameQuestion->ask();
        $namePascalCase = StringHelper::pascal($name);

        // get destination path for new block
        $srcPathQuestion = new Question("The directory where to create the Component", "Components", "themes/$this->currentThemeActive/" . "Components");
        $srcPath = $srcPathQuestion->ask();
        // get nameSpace for new block
        $namespaceQuestion = new Question("The namespace for new Component file php", $this->defaultNameSpace, $this->defaultNameSpace);
        $namespace = $namespaceQuestion->ask();

        $acfFileName = 'group_'.strtolower($namePascalCase).'.json';

        // Choose the files for generated
        $choicesFiles = [
            'js'   => "$namePascalCase.js",
            'php'  => "$namePascalCase.php",
            'scss' => "$namePascalCase.scss",
            'twig' => "$namePascalCase.twig",
            'md'   => "$namePascalCase.md",
            'acf'  => $acfFileName,
            'all'  => "All files",
        ];

        $choicesQuestion = new ChoicesQuestion("Which file should be created", $choicesFiles, array_keys($choicesFiles));
        $files = $choicesQuestion->ask();

        if (in_array('all', $files)) {
            unset($files[array_search('all', $files)]);
        }

        $acfTitle = "";
        if (in_array('acf', $files)) {
            $acfTitleQuestion = new RequireQuestion("What will be the name of the new acf group?", $name, $name);
            $acfTitle = $acfTitleQuestion->ask();
        }

        // Choose the property for twig block 
        $properties = [];
        if (in_array('twig', $files) || in_array('md', $files)) {
            $propertiesQuestions = new RepeaterQuestions("Do you want to add properties to the Component", [
                new Question("What is the name of the property"),
                new Question("What is the type of property", "string"),
                new Question("What is the description of the property"),
            ]);
            $propertiesQuestions->setContinueQuestion('Add another property?');
            $properties = $propertiesQuestions->ask();
        }
                
        $srcPath   = $this->defaultSrcPath . trim($srcPath, DIRECTORY_SEPARATOR);

        $params = [
            "type"  => "Component",
            "acfTitle"  => $acfTitle,
            "ComponentName" => $namePascalCase,
            "ComponentNameSlugify" => StringHelper::snake($name, '-'),
            "ComponentNamespace" => $namespace,
            "properties" => $properties,
        ];

        $destFolder = $srcPath . DIRECTORY_SEPARATOR . $params['ComponentName'] . DIRECTORY_SEPARATOR;
       
        foreach ($files as $key => $extensionFile) {
            if ($extensionFile == 'acf') {
                $destFileName = $destFolder . $acfFileName;
            } else {
                $destFileName = $destFolder . $params['ComponentName'] . '.' . $extensionFile;
            }

            $fileSkeleton = "Component.$extensionFile.php";
            
            $this->generator->renderFile("Component" . DIRECTORY_SEPARATOR . $fileSkeleton, $destFileName, $params);
        }

        $this->runEndCommand();
    }
}
