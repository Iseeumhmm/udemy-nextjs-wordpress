<?php

namespace Atlantic\Themes\NextJsWp\Utils\Admin;

use Atlantic\Themes\NextJsWp\Utils\Admin\ACFSyncNotification;

/**
 * Allows you to initialize all the necessary classes if you are in the administration
 */
class Admin
{
    /**
     * @Constructor
     */
    public function __construct()
    {
        if (is_admin()) {
            // Check if there are acf fields to synchronize
            new ACFSyncNotification();
        }
    }
}
