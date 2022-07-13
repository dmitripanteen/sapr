<?php

class Recaptcha
{
	public static function init($id = 'g-recaptcha'){
		$dispatcher = self::getDispatcher();
		$dispatcher->trigger('onInit', $id);
	}
	
	
	public static function display(){
		return JCaptcha::getInstance('recaptcha')->display('captcha', 'captcha', 'captcha');
	}
	
	
	public static function isValid($userAnswer = null){
		$dispatcher = self::getDispatcher();
		
		if (!$userAnswer){
			$userAnswer = self::_getField('g-recaptcha-response');
		}
		
		$res = $dispatcher->trigger('onCheckAnswer', $userAnswer);
		
		return isset($res[0]) && $res[0] ? true : false;
	}
	
	
	protected static function getDispatcher(){
		JPluginHelper::importPlugin('captcha');
		
		return JDispatcher::getInstance();
	}
	
	
	protected static function _getField($name, $default = ''){
		$jinput = JFactory::getApplication()->input;
		$form = $jinput->post->get('jform', '', 'array');
		$res = isset($form[$name]) ? $form[$name] : $default;
		
		if (!$res){
			$res = $jinput->post->get($name, $default);
		}
		
		return $res;
	}
	
	
	public static function _getLanguage(){
		// Initialise variables
		$language = JFactory::getLanguage();
		$tag = explode('-', $language->getTag());
		$tag = $tag[0];
		$available = array('en', 'pt', 'fr', 'de', 'nl', 'ru', 'es', 'tr');
		
		if (in_array($tag, $available)){
			return "lang : '".$tag."',";
		}
		// If the default language is not available, let's search for a custom translation
		if ($language->hasKey('PLG_RECAPTCHA_CUSTOM_LANG')){
			$custom[] = 'custom_translations : {';
			$custom[] = "\t".'instructions_visual : "'.JText::_('PLG_RECAPTCHA_INSTRUCTIONS_VISUAL').'",';
			$custom[] = "\t".'instructions_audio : "'.JText::_('PLG_RECAPTCHA_INSTRUCTIONS_AUDIO').'",';
			$custom[] = "\t".'play_again : "'.JText::_('PLG_RECAPTCHA_PLAY_AGAIN').'",';
			$custom[] = "\t".'cant_hear_this : "'.JText::_('PLG_RECAPTCHA_CANT_HEAR_THIS').'",';
			$custom[] = "\t".'visual_challenge : "'.JText::_('PLG_RECAPTCHA_VISUAL_CHALLENGE').'",';
			$custom[] = "\t".'audio_challenge : "'.JText::_('PLG_RECAPTCHA_AUDIO_CHALLENGE').'",';
			$custom[] = "\t".'refresh_btn : "'.JText::_('PLG_RECAPTCHA_REFRESH_BTN').'",';
			$custom[] = "\t".'help_btn : "'.JText::_('PLG_RECAPTCHA_HELP_BTN').'",';
			$custom[] = "\t".'incorrect_try_again : "'.JText::_('PLG_RECAPTCHA_INCORRECT_TRY_AGAIN').'",';
			$custom[] = '},';
			$custom[] = "lang : '".$tag."',";
			
			return implode("\n", $custom);
		}
		
		// If nothing helps fall back to english
		return '';
	}
	
	
	public static function getPublicKey(){
		$key = '';
		
		if (JPluginHelper::isEnabled('captcha', 'recaptcha')){
			$plugin = JPluginHelper::getPlugin('captcha', 'recaptcha');
			$params = new JRegistry($plugin->params);
			
			$key = $params->get('public_key', '');
		}
		
		return $key;
	}
}
