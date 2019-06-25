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
 * Custom reports
 * A Moodle block to show Custom reportss - firstly a bubble chart
 * @package blocks
 * @author: Ian Wild
 * @date: 2017
 */

require_once("../../config.php");
require_once($CFG->dirroot."/blocks/custom_reports/locallib.php");

$id = required_param('id', PARAM_INT);

// get current course from course id
$course = get_course($id);

// Force user login in course (SITE or Course).
if ($course->id == SITEID) {
    require_login();
    $context = context_system::instance();
} else {
    require_login($course);
    $context = context_course::instance($course->id);
}

$PAGE->set_context($context);
$PAGE->set_pagelayout('incourse');
$PAGE->set_url('/blocks/custom_reports/viewreport.php', ['id' => $id]);

$reportname = get_string('bubblechart', 'block_custom_reports');

$PAGE->set_title($reportname);
$PAGE->set_heading($reportname);
$PAGE->set_cacheable( true);

$PAGE->requires->js('/blocks/custom_reports/thirdparty/d3.js', true);

echo $OUTPUT->header();

// get the relevant interaction data
$data = custom_reports_get_views($course->id);

if(isset($data[0])) {
	if($data[0] != CR_SUCCESS) {
		// TODO: output a suitable message
	} else {
		if(isset($data[1])) {
		
			$renderer = $PAGE->get_renderer('block_custom_reports');
			
			// echo 'return to course' button above and below the chart
			echo $renderer->get_report_exit_btn($course->id);
			
			// load third party charting code
			echo HTML_WRITER::tag('section', '', array('id'=>'graph'));
			
			echo $renderer->get_report_exit_btn($course->id);
			
			
			$activities = json_decode($data[1]);
			
			$dataset = array();
			
			foreach($activities as $activity) {
				$datapoint = array();
				$datapoint['activity'] = $activity->name;
				$datapoint['interactions'] = intval($activity->numviews);
				
				$dataset[] = $datapoint;
			}
			
			$paramdata = array();
			$paramdata['children'] = $dataset;
			
			$json_data = json_encode($paramdata);
			
			$js_params = array('graph', $json_data);
			
			$PAGE->requires->js_call_amd('block_custom_reports/chart_renderer', 'drawChart', $js_params);
			
		} else {
			// TODO: output a suitable message
		}
	}
}

// Never reached if download = true.
echo $OUTPUT->footer();
