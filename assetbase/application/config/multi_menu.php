<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| $config
| -------------------------------------------------------------------
| This file contains the config array for configure database fileds, the menu structure
|
| Please see user guide for more info:
| https://github.com/edomaru/codeigniter_multilevel_menu
|
*/
// Database fileds
$config["menu_id"]               = 'id';
$config["menu_label"]            = 'name';
$config["menu_parent"]           = 'parent';
$config["menu_icon"] 			 = 'icon';
$config["menu_key"]              = 'slug';
$config["menu_order"]            = 'number';
// Menu structure
$config["nav_tag_open"]          = '<ul class="sidebar-menu">';
$config["nav_tag_close"]         = '</ul>';
$config["item_tag_open"]         = '<li>';
$config["item_tag_close"]        = '</li>';
$config["parent_tag_open"]       = '<li class="treeview">';
$config["parent_tag_close"]      = '</li>';
$config["parent_anchor_tag"]     = '<a href="%s">%s</a>';
$config["children_tag_open"]     = '<ul class="treeview-menu">';
$config["children_tag_close"]    = '</ul>';
$config['icon_position']		 = 'left'; // 'left' or 'right'
$config['menu_icons_list']		 = array();
$config["item_active_class"]     = 'active';

$config["item_divider"]          = "<li class='divider'></li>";
$config['parentl1_tag_open']     = '<li class="treeview">';
$config['parentl1_anchor']       = '<a href="%s">%s<i class="fa fa-angle-left pull-right"></i></a>';
// these for the future version
$config['icon_img_base_url']	 = '';