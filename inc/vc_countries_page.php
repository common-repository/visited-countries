<?php
defined('ABSPATH') or die("No script kiddies please!");

// Create settings page for users to select countries they have visited
function vc_countries_page() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
		echo '<div class="wrap">';
  $s_content = '{num} Visited';
  $s_atts = array('height'=>'300','width'=>'400');
  echo np_vc_show_map($s_atts, $s_content);
		echo '<h2>Visited Countries</h2>';
        echo '';
  			echo 'Select each Country that you have visited and hit Save Changes';
        echo '<form method="post" action="options.php">'; 
        settings_fields( 'vc_visited_countries' );
        do_settings_sections( 'vc_visited_countries' );
		$options = get_option('vc_countries');
  echo '';
  submit_button();
		?>

      <table>
 
      <?php
      echo vc_region_checkboxes("North America", $options);
      
      echo vc_region_checkboxes("South America", $options);
      
      echo vc_region_checkboxes("Europe", $options);
      
      echo vc_region_checkboxes("Africa", $options);
      
      echo vc_region_checkboxes("Asia", $options);
     
      echo vc_region_checkboxes("Oceania", $options);
      ?>
            
      </table>
      
  
    <?php
        submit_button();
	echo '</form>';
	echo '</div>';
}

function get_countries($id) {
  	$countries = array('AL'=>'Albania','AM'=>'Armenia','AT'=>'Austria','AZ'=>'Azerbaijan','BA'=>'Bosnia and Herzegovina','BE'=>'Belgium',
					'BG'=>'Bulgaria','BY'=>'Belarus','CH'=>'Switzerland','CY'=>'Cyprus','CZ'=>'Czech Republic','DE'=>'Germany','DK'=>'Denmark','EE'=>'Estonia',
					'ES'=>'Spain','FI'=>'Finland','FR'=>'France','GB'=>'United Kingdom','GE'=>'Georgia','GR'=>'Greece','HR'=>'Croatia','HU'=>'Hungary',
					'IE'=>'Ireland','IS'=>'Iceland','IT'=>'Italy','LT'=>'Lithuania','LU'=>'Luxembourg','LV'=>'Latvia','MD'=>'Moldova','ME'=>'Montenegro',
					'MK'=>'Macedonia','NL'=>'Netherlands','NO'=>'Norway','PL'=>'Poland','PT'=>'Portugal','RO'=>'Romania','RS'=>'Serbia','SE'=>'Sweden',
					'SI'=>'Slovenia','SJ'=>'Svalbard and Jan Mayen','SK'=>'Slovakia','TR'=>'Turkey','UA'=>'Ukraine','RU'=>'Russia','VA'=>'Vatican City',
					'MT'=>'Malta','MC'=>'Monaco','XK'=>'Kosovo','LI'=>'Liechtenstein','IM'=>'Isle of Man','GI'=>'Gibraltar','FO'=>'Faroe Islands','AD'=>'Andorra',
					'AX'=>'Aland Islands','GG'=>'Guernsey',

    			'BS'=>'Bahamas','BZ'=>'Belize','CA'=>'Canada','CR'=>'Costa Rica','CU'=>'Cuba','DO'=>'Dominican Republic','GL'=>'Greenland',
					'GT'=>'Guatemala','HN'=>'Honduras','HT'=>'Haiti','JM'=>'Jamaica','MX'=>'Mexico','NI'=>'Nicaragua','PA'=>'Panama','PR'=>'Puerto Rico',
					'SV'=>'El Salvador','US'=>'United States','AG'=>'Antigua and Barbuda','AW'=>'Aruba','BB'=>'Barbados','BL'=>'Saint Barthelemy',
					'GD'=>'Grenada','KN'=>'Saint Kitts and Nevis','LC'=>'Saint Lucia','MQ'=>'Martinique','TC'=>'Turks and Caicos Islands',
					'VG'=>'British Virgin Islands','AI'=>'Anguilla','BM'=>'Bermuda','DM'=>'Dominica','PM'=>'Saint Pierre and Miquelon',
					'GP'=>'Guadeloupe','KY'=>'Cayman Islands','MF'=>'Saint Martin','MS'=>'Montserrat','SX'=>'Saint Martin','TT'=>'Trinidad and Tobago',
					'VC'=>'Saint Vincent and the Grenadines','VI'=>'US Virgin Islands','BQ'=>'Bonaire Saint Eustachius and Saba','CW'=>'Curaçao',
					
					'AR'=>'Argentina','BO'=>'Bolivia','BR'=>'Brazil','CL'=>'Chile','CO'=>'Colombia','EC'=>'Ecuador','FK'=>'Falkland Islands',
					'GF'=>'French Guiana','GY'=>'Guyana','PE'=>'Peru','PY'=>'Paraguay','SR'=>'Suriname','UY'=>'Uruguay','VE'=>'Venezuela',
					'GS'=>'South Georgia and South Sandwich Islands',

					'AO'=>'Angola','BF'=>'Burkina Faso','BI'=>'Burundi','BJ'=>'Benin','BW'=>'Botswana','CD'=>'Democratic Republic of Congo',
					'CF'=>'Central African Republic','CG'=>'Republic of Congo','CI'=>'Côte d\'Ivoire','CM'=>'Cameroon','DJ'=>'Djibouti',
					'DZ'=>'Algeria','EG'=>'Egypt','ER'=>'Eritrea','ET'=>'Ethiopia','GA'=>'Gabon','GH'=>'Ghana','GM'=>'Gambia','GN'=>'Guinea',
					'GQ'=>'Equatorial Guinea','GW'=>'Guinea-Bissau','KE'=>'Kenya','LR'=>'Liberia','LS'=>'Lesotho','LY'=>'Libya','MA'=>'Morocco','MG'=>'Madagascar',
					'ML'=>'Mali','MR'=>'Mauritania','MW'=>'Malawi','MZ'=>'Mozambique','NA'=>'Namibia','NE'=>'Niger','NG'=>'Nigeria','RW'=>'Rwanda',
					'SD'=>'Sudan','SL'=>'Sierra Leone','SN'=>'Senegal','SO'=>'Somalia','SS'=>'South Sudan','SZ'=>'Swaziland','TD'=>'Chad','TG'=>'Togo',
					'TN'=>'Tunisia','TZ'=>'Tanzania','UG'=>'Uganda','ZA'=>'South Africa','ZM'=>'Zambia','ZW'=>'Zimbabwe','EH'=>'Western Sahara',
					'KM'=>'Comoros','GO'=>'Glorioso Islands','JU'=>'Juan De Nova Island','SH'=>'Saint Helena','ST'=>'Sao Tome and Principe',
					'YT'=>'Mayotte','BV'=>'Bouvet Island','CV'=>'Cape Verde',

					'AE'=>'United Arab Emirates','AF'=>'Afghanistan','BD'=>'Bangladesh','BN'=>'Brunei Darussalam','BT'=>'Bhutan','CN'=>'China',
					'ID'=>'Indonesia','IL'=>'Israel','IN'=>'India','IQ'=>'Iraq','IR'=>'Iran','JO'=>'Jordan','JP'=>'Japan','KG'=>'Kyrgyzstan',
					'KH'=>'Cambodia','KP'=>'North Korea','KR'=>'South Korea','KW'=>'Kuwait','KZ'=>'Kazakhstan','LA'=>'Lao People\'s Democratic Republic',
					'LB'=>'Lebanon','LK'=>'Sri Lanka','MM'=>'Myanmar','MN'=>'Mongolia','MY'=>'Malaysia','NP'=>'Nepal','OM'=>'Oman','PH'=>'Philippines',
					'PK'=>'Pakistan','PS'=>'Palestinian Territories','QA'=>'Qatar','SA'=>'Saudi Arabia','SY'=>'Syria','TH'=>'Thailand',
					'TJ'=>'Tajikistan','TL'=>'Timor-Leste','TM'=>'Turkmenistan','TW'=>'Taiwan','UZ'=>'Uzbekistan','VN'=>'Vietnam','YE'=>'Yemen',
					'HK'=>'Hong Kong','MV'=>'Maldives','BH'=>'Bahrain','SG'=>'Singapore',

					'AS'=>'American Samoa','AU'=>'Australia','BN'=>'Brunei Darussalam','CC'=>'Cocos (Keeling) Islands','CX'=>'Christmas Island',
					'FJ'=>'Fiji','FM'=>'Federated States of Micronesia','GU'=>'Guam','HM'=>'Heard Island and McDonald Islands',
					'IO'=>'British Indian Ocean Territory','KI'=>'Kiribati','MH'=>'Marshall Islands','MO'=>'Macau','MP'=>'Northern Mariana Islands',
					'MU'=>'Mauritius','NC'=>'New Caledonia','NF'=>'Norfolk Island','NR'=>'Nauru','NU'=>'Niue','NZ'=>'New Zealand','PG'=>'Papua New Guinea',
					'PW'=>'Palau','RE'=>'Reunion','SB'=>'Solomon Islands','SC'=>'Seychelles','TF'=>'French Southern and Antarctic Lands','TK'=>'Tokelau',
					'TL'=>'Timor-Leste','TO'=>'Tonga','TV'=>'Tuvalu','VU'=>'Vanuatu','WF'=>'Wallis and Futuna','WS'=>'Samoa','CK'=>'Cook Islands',
					'PF'=>'French Polynesia','PN'=>'Pitcairn Islands'
					);
	
			array_multisort( $countries, SORT_ASC );
    $country = $countries[$id];
			return $country;
		}

function nc_fill_region($name) {
   switch ($name) {
    case "Europe":
        $array = array('AL','AM','AT','AZ','BA','BE','BG','BY','CH','CY','CZ','DE','DK','EE','ES','FI','FR','GB','GE','GR','HR','HU','IE','IS',
											 'IT','LT','LU','LV','MD','ME','MK','NL','NO','PL','PT','RO','RS','SE','SI','SJ','SK','TR','UA','RU','VA','MT','MC','XK',
											 'LI','IM','GI','FO','AD','AX','GG');
				break;
    case "North America":
    		$array = array('BS','BZ','CA','CR','CU','DO','GL','GT','HN','HT','JM','MX','NI','PA','PR','SV','US','AG','AW','BB','BL','GD','KN','LC',
                       'MQ','TC','VG','AI','BM','DM','PM','GP','KY','MF','MS','SX','TT','VC','VI','BQ','CW');
    		break;
    case "South America":
				$array = array('AR','BO','BR','CL','CO','EC','FK','GF','GY','PE','PY','SR','UY','VE','GS');
        break;
    case "Africa":
        $array = array ('AO','BF','BI','BJ','BW','CD','CF','CG','CI','CM','DJ','DZ','EG','ER','ET','GA','GH','GM','GN','GQ','GW','KE','LR','LS',
												'LY','MA','MG','ML','MR','MW','MZ','NA','NE','NG','RW','SD','SL','SN','SO','SS','SZ','TD','TG','TN','TZ','UG','ZA','ZM',
												'ZW','EH','KM','GO','JU','SH','ST','YT','BV','CV');
       break;
    case "Asia":
         $array = array('AE','AF','BD','BN','BT','CN','ID','IL','IN','IQ','IR','JO','JP','KG','KH','KP','KR','KW','KZ','LA','LB','LK','MM','MN',
												'MY','NP','OM','PH','PK','PS','QA','SA','SY','TH','TJ','TL','TM','TW','UZ','VN','YE','HK','MV','BH','SG');
        break;
    case "Oceania":
		  	$array = array('AS','AU','BN','CC','CX','FJ','FM','GU','HM','IO','KI','MH','MO','MP','MU','NC','NF','NR','NU','NZ','PG','PW','RE','SB',
											 'SC','TF','TK','TL','TO','TV','VU','WF','WS','CK','PF','PN');
    		break;
}
  //array_multisort( $array, SORT_ASC );
  return $array;
  }

 
function vc_region_checkboxes($region, &$options) {
  $output = "<tr>
      <th>$region</th>
    <tr>  ";
  $vc_region_a =  nc_fill_region($region);
  $i = 0;
   foreach ($vc_region_a as $country) {   
     
    if($i >= 5) {
      $output=$output.'<tr>';
      $i = 0;
    } 
     $output=$output.nc_build_checkbox($country, $options);
     $i++;
     }
    return $output;
  }

	function nc_build_checkbox($id, &$options) {
      $c = '';
    	$crlf = chr(13).chr(10);
      $qt = chr(34);
    	if($options[$id] <> '') {
        $c = checked( 1, $options[$id], false );
      }
      $name = get_countries($id);
    	$s = "<td><input type=".$qt."checkbox".$qt." id=".$qt."countries".$qt." name=".$qt."vc_countries[$id]".$qt." value=".$qt."1".$qt." $c/> $name</td>";
    return $s.$crlf;
    }

?>