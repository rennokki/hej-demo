<?php

namespace App\Http\Controllers;

use RenokiCo\Hej\Http\Controllers\SocialController as HejController;

class SocialiteController extends HejController
{
    /**
     * Whitelist social providers to be used.
     *
     * @var array
     */
    protected static $allowedSocialiteProviders = [
        'github',
    ];
}
