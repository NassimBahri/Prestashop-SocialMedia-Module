<?php
/**
*Class SocialMedia
*This module give users the possibility to add their social media links to prestashop
*@author Nassim Bahri
*@version 1.0
*@copyright (c) 2012 Nassim Bahri
**/

if (!defined('_PS_VERSION_'))
  exit;

class SocialMedia extends Module{

	/**
	*SocialMedia construct
	**/
	public function __construct(){
		global $smarty;
		$this->name="socialmedia";
		$this->tab="Réseaux sociaux";
		$this->version="1.0";
		$this->author="Nassim Bahri";
		$this->need_instance=0;
		parent::__construct();
		$this->displayName=$this->l("Prestashop social media");
		$this->description=$this->l("This module give users the possibility to add their social media links to prestashop");
		$smarty->assign('socialLinks',$this->getListLink());
	}

	/**
	*SocialMedia installation
	**/
	public function install(){
		if (!parent::install() OR
			!$this->registerHook('leftColumn') OR
			!$this->registerHook('rightColumn') OR
			!Db::getInstance()->Execute('
			CREATE TABLE '._DB_PREFIX_.'socialmedia (
			`id_socialmedia` int(2) NOT NULL AUTO_INCREMENT, 
			`url` varchar(255) NOT NULL,
			`title` varchar(255) NOT NULL,
			PRIMARY KEY(`id_socialmedia`))
			ENGINE='._MYSQL_ENGINE_.' default CHARSET=utf8'))
			return false;
		return true;
	}

	/**
	*SocialMedia uninstallation
	**/
	public function uninstall(){
		if (!parent::uninstall() OR
			!Db::getInstance()->Execute('DROP TABLE '._DB_PREFIX_.'socialmedia'))
			return false;
		return true;
	}
	
	/**
	*Display SocialMedia module in the Left HOOK
	**/
	public function hookLeftColumn($params){
		global $smarty;
		return $this->display(__FILE__,'socialmedia.tpl');
	}
	
	/**
	*Display SocialMedia module in the Right HOOK
	**/
	public function hookRightColumn($params){
		$this->hookLeftColumn($params);
	}
	
	/**
	*Récupérer la liste des liens
	**/
	public function getListLink(){
		$liste=DB::getInstance()->ExecuteS('SELECT * FROM '._DB_PREFIX_.'socialmedia');
		$tab=array();
		foreach($liste as $l){
			$tab[$l['id_socialmedia']]=array('title'=>$l['title'],'link'=>$l['url']);
		}
		return $tab;
	}

}
?>