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
 * Settings for the custom_reports block
 *
 * @copyright 2017 Ian Wiild
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @package   block_custom_reports
 */

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {
    $settings->add(new admin_setting_configcheckbox('block_custom_reports_allowcssclasses', get_string('allowadditionalcssclasses', 'block_custom_reports'),
                       get_string('configallowadditionalcssclasses', 'block_custom_reports'), 0));
    
    // Starting time of log queries.
    $options = array(
    		'sincestart' => get_string('sincestart', 'block_custom_reports'),
    		'sinceforever' => get_string('sinceforever', 'block_custom_reports'),
    );
    $settings->add(new admin_setting_configselect('block_custom_reports/activitysince',
    		get_string('checkforactivity', 'block_custom_reports'),
    		get_string('checkforactivity_help', 'block_custom_reports'),
    		'sincestart',
    		$options)
    		);
}


