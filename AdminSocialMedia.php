<?php
/**
*Class SocialMedia
*Ce module vous donne la possibilité d'ajouter les liens de vos pages/groupes sur les réseaux sociaux dans votre site E-commerce
*Administration pannel
*@author Nassim Bahri
*@version 1.0
*@copyright (c) 2012 Nassim Bahri
**/
include_once(PS_ADMIN_DIR.'/../classes/AdminTab.php');
define('_PS_SOCIAL_IMG_DIR_','/prestashop/img/social/');	

class AdminSocialMedia extends AdminTab{

	protected $maxImageSize = 200000;
	
	/**
	*Constructeur de la classe AdminSocialMedia
	**/
	public function __construct(){
		$this->table='socialmedia';
		$this->className='SocialMedia';
		$this->lang=false;
		$this->edit=true;
		$this->delete=true;
		$this->fieldImageSettings = array('name' => 'image', 'dir' => 'social');
		$this->fieldsDisplay=array(
			'id_socialmedia'=>array('title'=>$this->l('ID'),'align'=>'center','width'=>25),
			'img'=>array('title'=>$this->l('Logo'),'align'=>'center','orderby' => false,'search'=>false,'width'=>25,'image' => 'social'),
			'title'=>array('title'=>$this->l('Titre'),'align'=>'center','width'=>100),
			'url'=>array('title'=>$this->l('URL'),'align'=>'center','width'=>100)
		);
		$this->identifier='id_socialmedia';
		parent::__construct();
	}
	
	/**
	*Méthode qui permet d'afficher le formulaire d'ajout/modification
	**/
	public function displayForm($isMainTab = true){
		global $currentIndex;
		parent::displayForm();
		if (!($obj = $this->loadObject(true)))
			return;
		$form='<form action="'.$currentIndex.'&submitAdd'.$this->table.'=1&token='.$this->token.'" method="post" enctype="multipart/form-data">';
		if(isset($obj->id)){$form.='<input type="hidden" name="id_'.$this->table.'" value="'.$obj->id.'" />';}
		$form.='<fieldset><legend><img src="../modules/socialmedia/logo.gif" />'.$this->l('Réseaux sociaux').'</legend>
		<label>'.$this->l('Title :').' </label>
		<div class="margin-form">
			<input type="text" size="63" name="title" value="'.htmlentities($this->getFieldValue($obj, 'title'), ENT_COMPAT, 'UTF-8').'" /> <sup>*</sup>
		</div>
		<label>'.$this->l('URL :').' </label>
		<div class="margin-form">
			<input type="text" size="63" name="url" value="'.htmlentities($this->getFieldValue($obj, 'url'), ENT_COMPAT, 'UTF-8').'" /> <sup>*</sup>
		</div>
		<label>'.$this->l('Logo :').' </label>
		<div class="margin-form">';
		if($obj->id!=''){$form.='<img src="'._PS_SOCIAL_IMG_DIR_.$obj->id.'.jpg" width="50" /><br />';}
		$form.='<input type="file" name="image" />
		</div>
		<div class="margin-form">
			<input type="submit" class="button" name="submitAdd'.$this->table.'" value="'.$this->l('Valider').'"/>
		</div>
		<div class="small"><sup>*</sup> '.$this->l('Champs requis').'</div>';
		$form.='</fieldset></form>';
		echo $form;
	}
	
	/**
	*Méthode qui permet d'uploader une image
	**/
	public function afterImageUpload(){
		global $currentIndex;
		if (($id = (int)(Tools::getValue('id_socialmedia'))) AND isset($_FILES) AND count($_FILES) AND file_exists(_PS_SOCIAL_IMG_DIR_.$id.'.jpg'))
		{
			imageResize(_PS_SOCIAL_IMG_DIR_.$id.'.jpg', _PS_SOCIAL_IMG_DIR_.$id.'-image.jpg', 32, 32);
		}
		Tools::redirectAdmin($currentIndex.'&token='.$this->token);
	}
	
	

}
?>