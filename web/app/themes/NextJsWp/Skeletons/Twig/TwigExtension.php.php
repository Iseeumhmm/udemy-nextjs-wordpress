<?= "<?php\n" ?>

namespace <?= $ExtensionNamespace ?>;

<?php if (count($filters) > 0) : ?>
use Timber\Twig_Filter;
<?php endif ?>
<?php if (count($functions) > 0) : ?>
use Timber\TwigFunction;
<?php endif ?>
use Twig\Environment;

/**
 * Twig extension to provide a function to convert arrays to HTML attributes
 *
 * @package <?= $ExtensionNamespace ?>
 */
class <?= $ExtensionName ?> extends \Twig_Extension<?= "\n" ?>
{
    /**
     * {@inheritdoc}
     * This function must return the name of the extension. It must be unique.
     */
    public function getName()
    {
        return '<?= $ExtensionNameSnake ?>';
    }

<?php if (count($filters) > 0) : ?>
    /**
     * {@inheritdoc}
     * In this function we can declare the extension function
     */
    public function getFilters()
    {
        return [
<?php foreach ($filters as $filter) : ?>
            new Twig_Filter('<?= $filter['name'] ?>', [$this, '<?= $filter['functionName'] ?>']),<?= "\n" ?>
<?php endforeach; ?>
        ];
    }

<?php foreach ($filters as $filter) : ?>
    /**
    * 
    **/
    public function <?= $filter['functionName'] ?>()
    {
        /**
        * @todo add your code here
        **/
    }<?= "\n" ?>
<?php endforeach; ?>
<?php endif ?>

<?php if (count($functions) > 0) : ?>
    /**
     * {@inheritdoc}
     * In this function we can declare the extension function
     */
    public function getFunctions()
    {
        return [
<?php foreach ($functions as $function) : ?>
            new TwigFunction('<?= $function['name'] ?>', [$this, '<?= $function['functionName'] ?>'], ['needs_environment' => true]),<?= "\n" ?>
<?php endforeach; ?>
        ];
    }<?= "\n" ?>
<?php foreach ($functions as $function) : ?>
    /**
    * 
    * @param Twig\Environment $env
    **/
    public function <?= $function['functionName'] ?>(Environment $env)
    {
        /**
        * @todo add your code here
        **/
    }<?= "\n" ?>
<?php endforeach; ?> 
<?php endif ?>
}
