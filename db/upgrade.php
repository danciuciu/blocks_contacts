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
 * This file keeps track of upgrades to the contacts block
 *
 * @since Moodle 2.0
 * @package block_contacts
 * @copyright 2010 Dongsheng Cai
 * @license http://www.gnu.org/copyleft/gpl.contacts GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Upgrade code for the contacts block.
 *
 * @param int $oldversion
 */
function xmldb_block_contacts_upgrade($oldversion) {
    global $CFG, $THEME, $DB;

    $dbman = $DB->get_manager();

    if ($oldversion < 2018040206) {

           // Define table blocks_contacts to be created.
           $table = new xmldb_table('blocks_contacts');

           // Adding fields to table blocks_contacts.
           $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
           $table->add_field('nume', XMLDB_TYPE_CHAR, '30', null, null, null, null);
           $table->add_field('prenume', XMLDB_TYPE_CHAR, '30', null, null, null, null);
           $table->add_field('adresa', XMLDB_TYPE_CHAR, '50', null, null, null, null);
           $table->add_field('email', XMLDB_TYPE_CHAR, '30', null, null, null, null);

           // Adding keys to table blocks_contacts.
           $table->add_key('primary', XMLDB_KEY_PRIMARY, array('id'));

           // Conditionally launch create table for blocks_contacts.
           if (!$dbman->table_exists($table)) {
               $dbman->create_table($table);
           }

           // Contacts savepoint reached.
           upgrade_block_savepoint(true, 2018040206, 'contacts');
       }

    return true;
}
