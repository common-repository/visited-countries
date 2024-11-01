<?php
defined('ABSPATH') or die("No script kiddies please!");

// Generate map for display off of a shortcode
function np_vc_show_map($atts, $content='') {
  $country_count = 0;
  $vc_map_width = 600;
  $vc_map_height = 400;
  
  $options = get_option('vc_settings');
  $vc_theme = $options['theme'];
  vc_validate_atts($atts, $vc_map_width, $vc_map_height);
  
	$vc_show_map_code = '
				<div id="vc_countries_map">
				<script src="' . vc_ammap_url .'ammap.js" type="text/javascript"></script>
        			<script src="' . vc_ammap_url .'maps/worldLow.js" type="text/javascript"></script>
			        <script src="' . vc_ammap_url .'themes/'.$vc_theme.'.js" type="text/javascript"></script> 
			        <div id="vc_mapdiv" style="width: '.$vc_map_width.'px; height: '.$vc_map_height.'px;"></div>
        			
        			<script type="text/javascript">
            			var map = AmCharts.makeChart("vc_mapdiv",{
                			type: "map",
                theme: "'.$vc_theme.'",
                pathToImages     : "' . vc_ammap_url . 'images/",
                panEventsEnabled : true,
                backgroundColor  : "'.$options['waterColor'].'",
                backgroundAlpha  : 1,

                zoomControl: {
                    panControlEnabled  : true,
                    zoomControlEnabled : true
                },

                dataProvider     : {
                    mapVar          : AmCharts.maps.worldLow,
										getAreasFromMap:true,
                    areas           : [
										'.vc_fill_countries().'	
											
                    ]
                },

                areasSettings    : {
                    autoZoom             : false,
                    color                : "'.$options['color'].'",
                    colorSolid           : "'.$options['colorSolid'].'",
                    selectedColor        : "'.$options['selectedColor'].'",
                    outlineColor         : "'.$options['outlineColor'].'",
                    rollOverColor        : "'.$options['rollOverColor'].'",
                    rollOverOutlineColor : "'.$options['rollOverOutlineColor'].'"
                }
            });
        </script>
		</div>';
		$country_count = vc_get_country_count();	
    $total_count = 250;
    $percent_visited = number_format((($country_count/$total_count)*100), 2).'%';
   $content = str_replace('{total}', $total_count, $content);
   $content = str_replace('{num}', $country_count, $content);
   $content = str_replace('{percent}', $percent_visited, $content);
   $content = '<div>'.$content.'</div>';
  return $vc_show_map_code.$content;
}

function vc_validate_atts($atts, &$vc_map_width, &$vc_map_height) {
  $vc_atts_width = 0;
  $vc_atts_height = 0;
  if(!empty($atts['width'])) {$vc_atts_width = number_format($atts['width'],0,".","");}
  if(!empty($atts['height'])) {$vc_atts_height = number_format($atts['height'],0,".","");}
  if ($vc_atts_width > 0 ) {$vc_map_width = $vc_atts_width;}
  if ($vc_atts_height > 0) {$vc_map_height = $vc_atts_height;}
  }


// Get countries from DB and process for Map Display
function vc_fill_countries() {
   $vcountries[] = serialize(get_option('vc_countries'));
	foreach($vcountries as $key => $country ) {
    $countries_name = vc_get_country_name($country);
      }
  return $countries_name;
}

// Create string of Countries for Map Display
	function vc_get_country_name( $name ) {
		$outString = '';
    	$temp = explode( '"', $name );
    	foreach ($temp as $test) {
        $first = substr($test,0,1);
        $second = substr($test,1,1);
        if (ord($first) > 64 && ord($first) < 91 && ord($second) > 64 && ord($second) < 91) {
          $outString = $outString.'	{ id: "'.$test.'", showAsSelected: true }, 
											';
         }
        }
    return $outString;
	}
// Count how many countries are selected
 function vc_get_country_count() {
   $count = 0;
   $country = get_option('vc_countries');
    if($country) {
      $count = count($country);
    }
   return $count;
   }




?>