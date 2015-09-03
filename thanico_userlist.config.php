<?php

/*LICENSE DO WHAT THE F* YOU WANT WITH THIS !

JUST PLEASE KEEP MY INFOS :
https://github.com/ThaNico
thanico.dev [at] gmail.com

Rewritten from JOJOManLV's userlist v.0.0.3
https://github.com/JOJOManLV/codofUserList
From this commit: 1593cd4f48856d884b03c015a7b0c4d4fc934c27
*/

$language = 'fr_FR'; //config langs in thanico_userlist.lang.php, check if your lang is in the file !

$userFriendlyURL = false; //if you want to manually handle this, comment the line below
if(!$userFriendlyURL && defined("SEF") && SEF == 1) $userFriendlyURL = true; //auto enabling
//if enabled, profiles url are: /user/profile/x
//if not, profiles url are: /index.php?u=/user/profile/x


//order of the fields
//if you want to remove one, use the below variables and please don't remove from display_order
$display_order = array(
"id",
"avatar",
"name",
"nbposts",
"nbviews",
"role"
);

$display_Anonymous = false; 					//display the anonymous user ?
$display_col['avatar'] = true;					//display avatar column ?
$display_col['id'] = true;						//display userid column ?
$display_col['name'] = true;					//display name column ?
$display_col['nbposts'] = true;					//display number of posts column ?
$display_col['nbviews'] = false;				//display profile views column ?
$display_col['role'] = true;					//display role column ?
//you can set every $display_col to false, but that's gonna be useless

$link_on_id = false;							//profile link when clicking on a userid ?
$link_on_name = true;							//profile link when clicking on a name ?
$link_on_avatar	= true;							//profile link when clicking on an avatar ?

$css_table_class = 'table table-striped';		//class applied on the table

//custom css to apply, you don't need to put <style>
$css_custom = '#userTable { margin: 0 auto; width: 80%; }';
//userTable is the id of the table			
?>