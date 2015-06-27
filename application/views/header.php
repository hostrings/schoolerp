<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js" type="text/javascript"></script>
	<script src="/js/dropit.js"></script>
	<link rel="stylesheet" href="/css/dropit.css" type="text/css" />
	<style type="text/css">
	
	::selection { background-color: #0f4255; color: white; }
	::-moz-selection { background-color: #0f4255; color: white; }

	body {
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: white;
	}

	a {
		color: #white;
		font-weight: 600;
	}
	html, #body{
		margin:0;
		padding:0;
		display:inline;
		min-width:1000px;
		width:100%;
		height:100%;
		min-height:80%;
		display:block;
	}
	html{
		margin:0;
		padding:0;
		display:block;
		width:100%;
		height:100%;
		max-width:100%;
		max-height:100%;
	}
	.submenu_container{
		float:left;
		min-width:90px;
		width:15%;
		max-width:240px;
		height:25px !important;
		display:block;
		color:#b3b3b3 !important;
		font-size:9px !important;
		font-weight:400 !important;
		margin-top:15px !important;
	}
	li.menu_container_big ul li.submenu_container a{
		padding:2px 0 0 0 !important;
		letter-spacing:0px;
		height:20px;
	}
	.menu_container_big{
		display:inline;
		float:left;
		min-width:60px;
		width:1%;
		max-width:90px;
		height:30px;
		background-color:#0f4255;
		padding:0 auto 0 auto;
		margin:5px 0;	
		font-size:10px;
		border-right:1px solid white;
	}
	.menu_container_big a, .drop a{
		background-image:url('') !important;
	}
	.menu_container_small a{
		color:white;
		text-decoration:none;
		font-size:10px;
		font-weight:600;
		letter-spacing:-3px;
	}
	.menu_container_main{
		display:inline;
		float:left;
		width:100%;
		min-width:100%;
		height:40px;
		max-height:60px;
		display:block;
		margin:0;
		background-color:#0f4255;
		color:white;
	}
	.menu_container{
		display:inline;
		float:left;
		width:100% !important;
		min-width:90%;
		height:40px;
		max-height:60px;
		margin:0 0 0 15%;
		display:block;
	}
	.menu_container_small{
		display:inline;
		float:left;
		width:100%;
		min-width:60%;
		height:100%;
		text-align:center;
		padding:10% 0;
	}
	.submenu_container_small{
		display:inline;
		float:left;
		width:100%;
		height:30px;
		text-align:left;
		padding:0 0 0 20px;
		margin-left:10px;
		border-right: 3px solid #e4e4e4;
		border-left: 3px solid #e4e4e4;
	}
	.submenu_container_small a{
		display:inline;
		text-decoration:none;
		color:black;
		font-size:12px;
		font-weight:600;
		border-bottom: 1px solid #e4e4e4;
		width:100%;
		height:30px;
		display:block;
	}
	li.menu_container_big ul li.submenu_container{
		background-color: #0f4255;
		width:80px;
		float:left;
		margin:0 !important;
		border:none !important;
	}
	.menu_container_big_second{
		display:inline;
		float:left;
		width:160px;
		height:60px;
		border:1px solid black;
		padding:10px auto;
	}
	.container_second_main{
		display:inline;
		float:left;
		min-width:500px;
		width:600px;
		height:60%;
		margin-left:50px;	
	}
	.container_second{
		display:inline;
		float:left;
		width:800px;
		min-width:700px;
		height:400px;
		margin:12% 0;
		z-index:-1;
	}
	.container{
		display:inline;
		float:left;
		height:90%;
		display:block;
		width:100%;
	}
	.footer{
		display:inline;
		float:left;
		width:100%;
		height:10%;
		background-color:black;
		display:block;
	}
	.footer_conteiner{
		display:inline;
		float:left;
		width:100%;
		text-align:center;
		display:block;
	}
	.submenu_container_small_s{
		display:inline;
		float:left;
		width:140px;
		height:140px;
		text-align:left;
		border: 2px solid #ececec;
		margin:5px;
		overflow:hidden;
	}
	.submenu_container_a{
		display:inline;
		text-decoration:none;
		color:#306c84;
		font-size:8px;
		font-weight:bold;
		width:140px;
		height:20px;
		display:block;
		text-align:center;
		padding:10px 0;
	}
	.submenu_container_a img{
		width:100px;
	}
	.header{
		display:inline;
		width:100%;
		height:100px;
		float:left;
		display:block;
		background-color: #0f4255;
  		background-image: -webkit-linear-gradient(top,#0f4255, #40cee8);
  		background-image: linear-gradient(to bottom,#0f4255, #40cee8);
	}
	.admin{
		display:inline;
		float:right;
		width:300px;
		height:30px;
		dipslay:block;
	}
	.container_second_main select{
		margin-top:100px;
	}
	.icon{
		float:right;
		margin: 7px 10px 0 0;
	}

ul{
	margin:0;
	padding:0;
	height:80px;
}

li{
	width:80px;
	height:80px;
	float:left;
	color:#0f4255;
	text-align:left !important;
	
}
.subtext{
	height:80px;
}

legend, label{
	color:black;
}
.username, .password, label, .submit{
	display:inline;
	float:left;
	margin:20px;
	display:block;
	height:40px;
	width:40%;
}
label{
height:10px;
width:100%;
font-family:Verdana,Tahoma;
font-size:15px;
font-weight:600;
}

.container_second p{
height:10px;
width:100%;
font-family:Verdana,Tahoma;
font-size:15px;
font-weight:600;
color:black;
}
/*Menu Color Classes*/
.blue{
height:60px;
width:80px;
background:#0f4255 top left no-repeat;}
</style>	
<?php

echo '</head>';
echo '<body id="body">';
$menu_array = $menu->result_array();
$submenu_array = $submenu->result_array();
$menu_id = $this->uri->segment(3);

echo '<div class="container">';
echo '<div class="header">';

if($this->session->userdata('logged_in'))
{
	echo '<a class="admin" href="/index.php/welcome/admin/">Admin</a>';
	echo '<a class="admin" href="/index.php/welcome/index">Index</a>';
	echo '<a class="admin" href="/index.php/welcome/logout">Logout</a>';
}
else
{
	echo '<a class="admin" href="/index.php/verifylogin/index/">Login</a>';
}
echo '</div>';

if($this->session->userdata('logged_in'))
{
echo '<div class="menu_container_main">';
echo '<ul class="menu_container dropdown">';
	if(isset($menu_array) && is_array($menu_array) && count($menu_array))
	{
		foreach($menu_array as  $key1 => $items)
		{	// menu_container_small
			echo '<li class="menu_container_big drop">';
				echo '<a href="/index.php/welcome/category/'.$items['id'].'">'.ucfirst($items['name']).'</a>';

				echo '<ul style="height:30px;">';				
				foreach($submenu_array as $key => $subitems)
				{
					if( $subitems['menu_id'] == $key1 )
					{
						echo '<li class="submenu_container"><a href="index.php/welcome/index/sub/'.$subitems['id'].'">'.ucfirst($subitems['name']).'</a></li>';
					}
				}
				echo '</ul>';
			echo '</li>';
		}
	}
echo '</ul>';
echo '</div>';
}


	if(isset($submenu_array) && is_array($submenu_array) && count($submenu_array) && $this->uri->segment(2) == 'category')
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


	
?>