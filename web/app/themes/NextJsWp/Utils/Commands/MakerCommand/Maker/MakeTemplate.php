<?php

namespace Atlantic\Themes\NextJsWp\Utils\Commands\MakerCommand\Maker;

use Atlantic\Themes\NextJsWp\Utils\Commands\MakerCommand\MakerCommandAbstract;
use Resulta\WpCommandsAbstract\Helpers\StringHelper;
use Resulta\WpCommandsAbstract\Questions\ChoicesQuestion;
use Resulta\WpCommandsAbstract\Questions\RequireQuestion;
use Resulta\WpCommandsAbstract\Questions\Question;

class MakeTemplate extends MakerCommandAbstract
{
    /**
     * {@inheritdoc}
     */
    public function getCommandName()
    {
        return 'template';
    }

    /**
     * Allows you to generate a new template using a skeleton
     *
     * ## OPTIONS
     * 
     * Not used
     *
     * ## EXAMPLES
     *
     *     wp generate template
     *
     * @when after_wp_load
     */
    public function __invoke($arguments, $options)
    {
        $this->runStartCommand();
       
        // get name for new block
        $nameQuestion = new RequireQuestion("What will your new Template be called");
        $name = $nameQuestion->ask();
        $namePascalCase = StringHelper::pascal($name);

        // get destination path for new block
        $srcPathQuestion = new Question("The directory where to create the Template", "Templates", "themes/$this->currentThemeActive/" . "Templates");
        $srcPath = $srcPathQuestion->ask();
        // get nameSpace for new block
        $namespaceQuestion = new Question("The namespace for new Template file php", $this->defaultNameSpace, $this->defaultNameSpace);
        $namespace = $namespaceQuestion->ask();

        $acfFileName = 'group_'.strtolower($namePascalCase).'.json';

        // Choose the files for generated
        $choicesFiles = [
            'js'   => "$namePascalCase.js",
            'scss' => "$namePascalCase.scss",
            'twig' => "$namePascalCase.twig",
            'acf'  => $acfFileName,
            'all'  => "All files",
        ];

        $choicesQuestion = new ChoicesQuestion("Which file should be created", $choicesFiles, ['js', 'scss', 'twig']);
        $files = $choicesQuestion->ask();
        // add obligation file generated
        $files[] = 'php';

        if (in_array('all', $files)) {
            unset($files[array_search('all', $files)]);
        }

        $acfTitle = "";
        if (in_array('acf', $files)) {
            $acfTitleQuestion = new RequireQuestion("What will be the name of the new acf group?", $name, $name);
            $acfTitle = $acfTitleQuestion->ask();
        }

                
        $srcPath   = $this->defaultSrcPath . trim($srcPath, DIRECTORY_SEPARATOR);

        $params = [
            "type"  => "Template",
            "acfTitle"  => $acfTitle,
            "TemplateName" => $namePascalCase,
            "TemplateNameSlugify" => StringHelper::snake($name, '-'),
            "TemplateNamespace" => $namespace,
        ];

        $destFolder = $srcPath . DIRECTORY_SEPARATOR . $params['TemplateName'] . DIRECTORY_SEPARATOR;
       
        foreach ($files as $key => $extensionFile) {
            if ($extensionFile == 'php') {
                $destFileName = $this->defaultSrcPath . DIRECTORY_SEPARATOR . 'template-'.strtolower($name).'.php';
            } else if ($extensionFile == 'acf'){
                $destFileName = $destFolder . $acfFileName;
            }else {
                $destFileName = $destFolder . $params['TemplateName'] . '.' . $extensionFile;
            }

            $fileSkeleton = "Template.$extensionFile.php";
            
            $this->generator->renderFile("Template" . DIRECTORY_SEPARATOR . $fileSkeleton, $destFileName, $params);
        }

        $this->runEndCommand();
    }
}
