<?php

/*LICENSE DO WHAT THE F* YOU WANT WITH THIS !

JUST PLEASE KEEP MY INFOS :
https://github.com/ThaNico
thanico.dev [at] gmail.com

Rewritten from JOJOManLV's userlist v.0.0.3
https://github.com/JOJOManLV/codofUserList
From this commit: 1593cd4f48856d884b03c015a7b0c4d4fc934c27
*/

//Settings
//If you need to change something,
//it should be changed from those two files
require('thanico_userlist.config.php');
require('thanico_userlist.lang.php');
if(!isset($userlist_lang[(string)$language]['id'])) $language = 'en_US'; //security

add_js_body("http://code.jquery.com/jquery-1.11.2.min.js", array('name' => 'jquery.js'));
add_js(PLUGIN_PATH . 'thanico_userlist/assets/js/jquery.tablesorter.min.js', array('name' => 'jquery.tablesorter.min.js'));

if(strlen($css_custom) > 0) $css_custom = '<style>'.$css_custom.'</style>';
$html = $css_custom.'
<table id="userTable" class="'.$css_table_class.'">
  <thead>
    <tr>';

foreach($display_order as $f) {
	$sort = 'int';
	if($f == "role" || $f == "name") $sort = 'string';
	if($f == "avatar") $sort = '';
	if(strlen($sort) > 0) $sort = ' data-sort="'.$sort.'"';
	if($display_col[(string)$f]) $html .= '<th'.$sort.'>'.$userlist_lang[(string)$language][(string)$f].'</th>';
}
 
$html .= '
    </tr>
  </thead>
  <tbody>';

$db = \DB::getPDO();
$query = 'SELECT `id` FROM `codo_users`';
if(!$display_Anonymous) $query .= ' WHERE pass != \'youJustCantCrackThis\'';

foreach ($db->query($query) as $row) {
    $user = User::get($row['id']);
	if(!is_object($user) || $user->id != $row['id']) continue; //security, maybe useless but I don't care :)
	
    $html .= '<tr>';
	
	foreach($display_order as $f) {
		if(!isset($display_col[(string)$f])) continue;
		if(!$display_col[(string)$f]) continue;
		
		switch($f) {
			case 'avatar' :				
				if($link_on_avatar) {
					$field = '<a href="?u=/user/profile/'.$user->id.'"><img draggable="false" src="'.$user->avatar.'"/></a>';
					if($userFriendlyURL) $field = '<a href="/user/profile/'.$user->id.'"><img draggable="false" src="'.$user->avatar.'"/></a>';
				}
				else $field = '<img draggable="false" src="'.$user->avatar.'"/>';
				$html .= '<td><div class="codo_topics_topic_avatar">'.$field.'</div></td>';
				break;
				
			case 'id' :
				if($link_on_id) {
					$field = '<a href="?u=/user/profile/'.$user->id.'">'.$user->id.'</a>';
					if($userFriendlyURL) $field = '<a href="/user/profile/'.$user->id.'">'.$user->id.'</a>';
				}
				else $field = $user->id;
				$html .= '<td>'.$field.'</td>';
			break;
			
			case 'name' :
				if($link_on_name) {
					$field = '<a href="?u=/user/profile/'.$user->id.'">'.htmlentities($user->name,ENT_QUOTES).'</a>';
					if($userFriendlyURL) $field = '<a href="/user/profile/'.$user->id.'">'.htmlentities($user->name,ENT_QUOTES).'</a>';
				}
				else $field = htmlentities($user->name,ENT_QUOTES);
				$html .= '<td>'.$field.'</td>';
			break;
			
			case 'nbposts' :
				$html .= '<td>'.$user->no_posts.'</td>';
				break;
				
			case 'nbviews' :
				$html .= '<td>'.$user->profile_views.'</td>';
				break;
				
			case 'role' :
				$html .= '<td>'.htmlentities(User::getRoleName($user->rid),ENT_QUOTES).'</td>';
				break;
				
			default :
				//nothing
		}
	}
	
	$html .= '</tr>';
}

$html .= '
  </tbody>
</table>
<script>
$(document).ready(function() { $("#userTable").tablesorter(); } );
</script>
';

echo $html;

?>