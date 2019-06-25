/**
 * Encapsules the behavior for creating a progress chart in Moodle.
 *
 * Manages the UI.
 *
 * @module     block_custom_reports/line_renderer
 * @class      line_renderer
 * @package    block_custom_reports
 * @copyright  2019 Vasilis Valandreas
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @since      3.5
 */


requirejs.config({
    paths: {
        "ej2": '/elearning/blocks/ustom_reports/thirdparty/ej2',
    }
});

define(['jquery', 'ej2'], function($) {  
	var links = [];
	
	var t = {
		
        drawLine: function() {
      
			console.log("Hello world");
						
    	    
    	    $(document).ready(
    		  function () {
    		    var canvas = document.getElementById(chartEl);
    		    
    		    canvas.onclick = function (evt) {
    		      var activePoints = myChart.getElementsAtEvent(evt);
    		      var chartData = activePoints[0]['_chart'].config.data;
    		      var idx = activePoints[0]['_index'];

    		      var url = links[idx];
    		      window.location.href = url;
    		      return false;
    		    };
			});
    	    
    	    $(document).ready(
    		  function () {
    		    var canvas = document.getElementById(chartEl);
    		});
        },
	};
	return t;
});

