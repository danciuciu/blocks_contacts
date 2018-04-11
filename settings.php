<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Settings for the contacts block
 *
 * @copyright 2012 Aaron Barnes
 * @license   http://www.gnu.org/copyleft/gpl.contacts GNU GPL v3 or later
 * @package   block_contacts
 */

defined('MOODLE_INTERNAL') || die;

// Create folder / submenu in block menu, modsettings for activity modules, localplugins for Local plugins.
// The default folders are defined in admin/settings/plugins.php.
$ADMIN->add('blocksettings', new admin_category('contacts',
        'contacts'));

// Create settings block.
$settings = new admin_settingpage($section, 'settings');
if ($ADMIN->fulltree) {

}

// This adds the settings link to the folder/submenu.
$ADMIN->add('contacts', $settings);
// This adds a link to an external page.
$ADMIN->add('contacts', new admin_externalpage('block_contacts', 'view_contacts',
        $CFG->wwwroot.'/blocks/contacts/view_contacts.php'));


/*$ADMIN->add('contacts', new admin_externalpage('block_contacts', 'block_contacts',
        $CFG->wwwroot.'/blocks/contacs/block_contacts.php'));*/

// Prevent Moodle from adding settings block in standard location.
$settings = null;
