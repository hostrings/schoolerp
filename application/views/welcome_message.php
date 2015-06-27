<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$menu_array = $menu->result_array();
$submenu_array = $submenu->result_array();
$menu_id = 1;

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
	echo '<div class="container_second">';
	if(isset($menu_array) && is_array($menu_array) && count($menu_array))
	{
		foreach($menu_array as  $items)
		{
			echo '<div class="submenu_container_small_s">';
				echo '<a class="submenu_container_a" href="/index.php/welcome/index/'.$items['id'].'"><img src="/i/'.$items['id'].'.png" href="index.php/welcome/index/sub/'.$items['id'].'"/><br />'.ucfirst($items['name']).'</a>';
			echo '</div>';
		}
	}
	echo '</div>';
	echo '</div>';
?>