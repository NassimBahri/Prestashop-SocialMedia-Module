<?php
/**
*Class SocialMedia
*Ce module vous donne la possibilité d'ajouter les liens de vos pages/groupes sur les réseaux sociaux dans votre site E-commerce
*@author Nassim Bahri
*@version 1.0
*@copyright (c) 2012 Nassim Bahri
**/
class SocialMedia extends ObjectModel{


	public $socialmedia;
	/**
	*@var $fieldsRequired les champs requis de la table socialmedia
	**/
	protected $fieldsRequired=array('url','title');
	/**
	*@var $fieldsValidate type des champs
	**/
	protected $fieldsValidate=array('url'=>'isAbsoluteUrl');
	/**
	*@var $table nom de la table dans la base de données
	**/
	protected $table='socialmedia';
	/**
	*@var $identifier identifiant de la table
	**/
	protected $identifier='id_socialmedia';
	
	public $url;
	public $title;
	public $id_socialmedia;
	/**
	*get the table fileds
	**/
	public function getFields(){
		parent::validateFields();
		$fields['id_socialmedia']=pSQL($this->id_socialmedia);
		$fields['title']=pSQL($this->title);
		$fields['url']=pSQL($this->url);
		return $fields;
	}


}
?>