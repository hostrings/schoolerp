<?php


$menu_array = $menu->result_array();
$submenu_array = $submenu->result_array();
$menu_id = 1;
$options = array( );
if(isset($menu_array) && is_array($menu_array) && count($menu_array))
{
	foreach($menu_array as $items)
	{
		$options[$items['id']] = $items['name'];
	}
}
if(isset($submenu_array) && is_array($submenu_array) && count($submenu_array))
	{
		echo '<div class="submenu_container">';
		
		foreach($submenu_array as $key => $subitems)
		{
		$i=0;
			if( $subitems['menu_id'] == $menu_id )
			{
				$i++;
				echo '<div class="submenu_container_small">';
					echo '<a class="submenu_container" href="/index.php/welcome/index/sub/'.$subitems['id'].'">'.ucfirst($subitems['name']).'<img class="icon" src="/i/icon/icon'.$i.'.png" /></a>';
				echo '</div>';	
			}
		}
		echo '</div>';
	}
	echo '<div class="container_second_main">';
		if(isset($menu_array) && is_array($menu_array) && count($menu_array))
		{	
			echo form_dropdown('category', $options);
			echo form_open('welcome/admin');
				form_hidden('username', $items['id']);
				echo form_fieldset('Name');
				echo form_input('name', $items['name']);
				echo form_fieldset_close( ); 
				echo "<br />";
				echo form_fieldset('Image');
				echo form_input('image', $items['image']);
				echo form_fieldset_close(); 
				echo "<br />";
				echo form_fieldset('Position');
				echo form_input('position', $items['position']);
				echo form_fieldset_close();
				echo "<br />";
				echo form_submit('mysubmit', 'UPDATE');
				echo "<br />";
			form_close();
			echo "<hr />";
		}
		
	echo '</div>';
?>