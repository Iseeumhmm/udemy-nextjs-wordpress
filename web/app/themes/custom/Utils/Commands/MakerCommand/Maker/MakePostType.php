<?php

namespace Atlantic\Themes\_NAMESPACE_\Utils\Commands\MakerCommand\Maker;

use Atlantic\Themes\_NAMESPACE_\Utils\Commands\MakerCommand\MakerCommandAbstract;
use Resulta\WpCommandsAbstract\Helpers\StringHelper;
use Resulta\WpCommandsAbstract\Questions\RequireQuestion;
use Resulta\WpCommandsAbstract\Questions\Question;

class MakePostType extends MakerCommandAbstract
{
    /**
     * {@inheritdoc}
     */
    public function getCommandName()
    {
        return 'post-type';
    }

    /**
     * Allows you to generate a new custom post type and add a desired category
     *
     * ## OPTIONS
     * 
     * Not used
     *
     * ## EXAMPLES
     *
     *     wp generate post-type
     *
     * @when after_wp_load
     */
    public function __invoke($arguments, $options)
    {
        $this->runStartCommand();
        
        // get name for new block
        $nameQuestion = new RequireQuestion("What will your new Custom Post type be called", "", "Do not add 'PostType' in the name");
        $name = $nameQuestion->ask();
        $name = str_replace(['PostType', 'posttype'], '', $name);
        $postTypeId = strtolower($name);

        $singularName = str_replace('s', '', $name);
        $singularNameQuestion = new RequireQuestion("What is the singular noun?", $singularName, $singularName);
        $singularName = str_replace('s', '', $singularNameQuestion->ask());

        // get destination path for new block
        $srcPathQuestion = new Question("The directory where to create the custom post type class", "Utils/PostTypes", "themes/$this->currentThemeActive/" . "Utils/PostTypes");
        $srcPath = $srcPathQuestion->ask();
        // get nameSpace for new block
        $namespaceQuestion = new Question("The namespace for new custom post type class file php", $this->defaultNameSpace. "\Utils\PostTypes", $this->defaultNameSpace. "\Utils\PostTypes");
        $namespace = $namespaceQuestion->ask();
        // add a new category
        $slugQuestion = new Question("Which slug would you like? ", $postTypeId, $postTypeId);
        $slug = strtolower($slugQuestion->ask());
        // add a new category
        $categoryQuestion = new Question("Do you want to add a category to this new custom post type?", 'n', 'y|n');
        $addCategory = strtolower($categoryQuestion->ask()) == 'y';
           
        $srcPath   = $this->defaultSrcPath . trim($srcPath, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;

        $params = [
            "postTypeId" => $postTypeId,
            "PostTypeName" => StringHelper::pascal($name.'PostType'),
            "PostTypeLabel" => StringHelper::pascal($postTypeId),
            "PostTypeSingularName" => StringHelper::pascal($singularName),
            "PostTypeNamespace" => $namespace,
            "PostTypeSlug" => $slug,
            "addCategory" => $addCategory
        ];  

        $this->generator->renderFile("PostType" . DIRECTORY_SEPARATOR ."PostType.php.php", $srcPath. $params['PostTypeName'] . '.php', $params);

        $this->runEndCommand();
    }
}
