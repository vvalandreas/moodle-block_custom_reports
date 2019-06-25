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
 * Form for editing custom_reports block instances.
 *
 * @package   block_custom_reports
 * @copyright 2017 Ian Wild
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Form for editing custom_reports block instances.
 *
 * @copyright 2017 Ian Wild
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class block_custom_reports_edit_form extends block_edit_form {
    protected function specific_definition($mform) {
        global $CFG;

        // Fields for editing HTML block title and contents.
        $mform->addElement('header', 'configheader', get_string('blocksettings', 'block'));

        $mform->addElement('text', 'config_title', get_string('configtitle', 'block_custom_reports'));
        $mform->setType('config_title', PARAM_TEXT);

        if (!empty($CFG->block_custom_reports_allowcssclasses)) {
            $mform->addElement('text', 'config_classes', get_string('configclasses', 'block_custom_reports'));
            $mform->setType('config_classes', PARAM_TEXT);
            $mform->addHelpButton('config_classes', 'configclasses', 'block_custom_reports');
        }
    }

    function set_data($defaults) {
        if (!$this->block->user_can_edit() && !empty($this->block->config->title)) {
            // If a title has been set but the user cannot edit it format it nicely
            $title = $this->block->config->title;
            $defaults->config_title = format_string($title, true, $this->page->context);
            // Remove the title from the config so that parent::set_data doesn't set it.
            unset($this->block->config->title);
        }

        parent::set_data($defaults);
        // restore $text
        if (!isset($this->block->config)) {
            $this->block->config = new stdClass();
        }
        if (isset($title)) {
            // Reset the preserved title
            $this->block->config->title = $title;
        }
    }
}
