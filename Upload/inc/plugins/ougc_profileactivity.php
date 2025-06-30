<?php

/***************************************************************************
 *
 *   OUGC Profile Activity plugin (/inc/plugins/ougc_profileactivity.php)
 *   Author: Omar Gonzalez
 *   Copyright: © 2012 Omar Gonzalez
 *
 *   Website: https://ougc.network/
 *
 *   Show an overview of latest user threads or posts in profiles.
 *
 ***************************************************************************
 ****************************************************************************
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 ****************************************************************************/

declare(strict_types=1);

use function ougc\ProfileActivity\Admin\pluginActivate;
use function ougc\ProfileActivity\Admin\pluginInfo;
use function ougc\ProfileActivity\Admin\pluginIsInstalled;
use function ougc\ProfileActivity\Admin\pluginUninstall;
use function ougc\ProfileActivity\Core\addHooks;

use const ougc\ProfileActivity\ROOT;

if (!defined('IN_MYBB')) {
    die('This file cannot be accessed directly.');
}

define('ougc\ProfileActivity\ROOT', MYBB_ROOT . 'inc/plugins/ougc/ProfileActivity');

// Plugin Settings
define('ougc\ProfileActivity\Core\SETTINGS', [
    //'allowedGroups' => '-1'
]);

// PLUGINLIBRARY
if (!defined('PLUGINLIBRARY')) {
    define('PLUGINLIBRARY', MYBB_ROOT . 'inc/plugins/pluginlibrary.php');
}

require_once ROOT . '/Core.php';

if (defined('IN_ADMINCP')) {
    require_once ROOT . '/Admin.php';

    require_once ROOT . '/Hooks/Admin.php';

    addHooks('ougc\ProfileActivity\Hooks\Admin');
} else {
    require_once ROOT . '/Hooks/Forum.php';

    addHooks('ougc\ProfileActivity\Hooks\Forum');
}

require_once ROOT . '/Core.php';

function ougc_profileactivity_info(): array
{
    return pluginInfo();
}

function ougc_profileactivity_activate(): bool
{
    return pluginActivate();
}

function ougc_profileactivity_is_installed(): bool
{
    return pluginIsInstalled();
}

function ougc_profileactivity_uninstall(): bool
{
    return pluginUninstall();
}



/*
    require_once MYBB_ROOT . '/inc/adminfunctions_templates.php';
    find_replace_templatesets(
        'member_profile',
        '#' . preg_quote('{$signature}') . '#',
        '{$signature}{$memprofile[\'activity_threads\']}{$memprofile[\'activity_posts\']}'
    );
*/