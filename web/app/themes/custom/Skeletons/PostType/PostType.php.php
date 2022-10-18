<?= "<?php\n" ?>

namespace <?= $PostTypeNamespace ?>;

/**
 * The new custome post type <?= $PostTypeName; ?>
 *
 * @package <?= $PostTypeNamespace; ?>
 */
class <?= $PostTypeName; ?><?= "\n" ?>
{
    // The post type id
    private $id = '<?= $postTypeId; ?>';

    // The post type options
    private $options = array(
        'labels' => array(
          'name' => '<?= $postTypeId; ?>s',
          'singular_name' => '<?= $PostTypeSingularName; ?>'
        ),
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'rewrite' => array(
            'slug' => '<?= $PostTypeSlug; ?>',
            'with_front' => false
        ),
        'supports' => array(
          'title',
          'editor',
          'revisions',
          'author',
          'thumbnail',
          'page-attributes'
        ),
        'menu_icon' => 'dashicons-star-half',
        'has_archive' => false,
    );

    /**
     * Constructor
     */
    public function __construct()
    {
        add_action('init', array($this,'registerPostType'));
<?php if ($addCategory) : ?>
        add_action('init', array($this,'registerTaxonomies'));
<?php endif ?>
    }

    /**
     * Register the post type
     *
     * @return void
     */
    public function registerPostType()
    {
        register_post_type($this->id, $this->options);
    }
<?php if ($addCategory) : ?>
    /**
     * Register the post type's taxonomies
     *
     * @return void
     */
    public function registerTaxonomies()
    {
        $args = [
            'hierarchical' => true,
            'public' => true,
            'show_ui' => true,
            'rewrite' => [ 'slug' => $this->options['rewrite']['slug'] . '/category', 'with_front' => false ],
            'labels' => [
                'name'              => __('Categories', 'custom'),
                'singular_name'     => __('Category', 'custom'),
                'search_items'      => __('Search Categories', 'custom'),
                'all_items'         => __('All Categories', 'custom'),
                'edit_item'         => __('Edit Category', 'custom'),
                'update_item'       => __('Update Category', 'custom'),
                'add_new_item'      => __('Add New Category', 'custom'),
                'new_item_name'     => __('New Category Name', 'custom'),
                'menu_name'         => __('Categories', 'custom'),
            ]
        ];

        register_taxonomy($this->id . '-category', $this->id, $args);
    }
<?php endif ?>
}
