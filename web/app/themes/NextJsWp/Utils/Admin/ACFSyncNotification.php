<?php

namespace Atlantic\Themes\NextJsWp\Utils\Admin;

/**
 * This class is used for inform user in admin if we need to sync more one field acf
 */
class ACFSyncNotification
{
    /**
     * @Constructor
     */
    public function __construct()
    {
        add_action('admin_init', [$this, 'checkAcfSyncAvailable']);
    }

    /**
     * Add notification in all screen admin if we have more one field acf to syncrhonize
     *
     * Retrieve function in the ACF plugin because no existing hook can retrieve the list of fields to synchronize
     * @see https://github.com/AdvancedCustomFields/acf/blob/master/includes/admin/admin-field-groups.php#L147
     *
     * @return void
     */
    public function checkAcfSyncAvailable()
    {
        $sync = array();

        // Review local json field groups.
        if (acf_get_local_json_files()) {
            // Get all groups in a single cached query to check if sync is available.
            $all_field_groups = acf_get_field_groups();
            foreach ($all_field_groups as $field_group) {
                // Extract vars.
                $local    = acf_maybe_get($field_group, 'local');
                $modified = acf_maybe_get($field_group, 'modified');
                $private  = acf_maybe_get($field_group, 'private');

                // Ignore if is private.
                if ($private || $local !== 'json') {
                    continue;

                    // if new acf field
                } elseif (!$field_group['ID']) {
                    $sync[ $field_group['key'] ] = $field_group;

                    // Append to sync if "json" modified time is newer than database.
                } elseif ($modified && $modified > get_post_modified_time('U', true, $field_group['ID'])) {
                    $sync[ $field_group['key'] ] = $field_group;
                }
            }
        }

        if (!empty($sync)) {
            add_action('admin_notices', [$this, 'addNotification']);
        }
    }

    /**
     * Add notification WP
     *
     * @return void
     */
    public function addNotification()
    {
        $class = 'notice notice-info';
        $adminUrl = admin_url("edit.php?post_type=acf-field-group&post_status=sync");
        $message = __('There are ACF groups to sync', 'custom');
        $linkText = __('Go to Sync available', 'custom');

        printf('<div class="%1$s"><p>%2$s : <a href="%3$s">%4$s</a></p></div>', esc_attr($class), esc_html($message), esc_html($adminUrl), esc_html($linkText));
    }
}
