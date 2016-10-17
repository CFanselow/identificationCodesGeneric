<?php 

/**
 * @file plugins/generic/identificationCodes/IdentificationCodesHandler.inc.php
 *
 * Copyright (c) 2016 Language Science Press
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING. 
 *
 * @class IdentificationCodesHandler
 *
 */

import('classes.handler.Handler');
import('plugins.generic.identificationCodes.IdentificationCodesDAO');

class IdentificationCodesHandler extends Handler {	

	static $plugin;

	function IdentificationCodesHandler() {
		parent::Handler();
	}

	/**
	 * Provide the plugin to the handler.
	 */
	static function setPlugin($plugin) {
		self::$plugin = $plugin;
	}

	function index($args, $request) {

		$authorizedUserGroups = array(ROLE_ID_SITE_ADMIN,ROLE_ID_MANAGER);
		$userRoles = $this->getAuthorizedContextObject(ASSOC_TYPE_USER_ROLES);

		// redirect to index page if user does not have the rights
		$user = $request->getUser();
		if (!array_intersect($authorizedUserGroups, $userRoles)) {
			$request->redirect(null, 'index');
		}

		$press = $request->getPress();

		// get codes from the settings
		//$identifcationCodesSettings = array_map('trim', explode(',', $press->getSetting('langsci_identificationCodes_codes')));

		//$identifcationCodesSettings = array_map('trim', explode(',',self::$plugin->getSetting($press->getId(), 'langsci_identificationCodes_codes')));

		$identifcationCodesSettings = array_map('trim', explode(',',self::$plugin->getSetting($press->getId(), 'langsci_identification_codes')));

var_dump($identifcationCodesSettings);

		// get codes from the ONIX code list
		$onixCodelistItemDao = DAORegistry::getDAO('ONIXCodelistItemDAO');
		$onixCodes = $onixCodelistItemDao->getCodes('List5');

		// get all codes from the settings that really exist
		$selectedIdentificationCodes = array();
		foreach ($onixCodes as $id => $codename) {
			// remove id from name
			$pos = -strrpos($codename," ");
			if ($pos) {
				$codename = substr($codename,0,-$pos);
			}
			if (in_array(trim($codename),$identifcationCodesSettings,true)) {
				$selectedIdentificationCodes[] = $id;

			}
		}

		// get all code values from the database
		$identificationCodesDAO = new IdentificationCodesDAO();
		$identificationCodes = $identificationCodesDAO->getData();

		$templateMgr = TemplateManager::getManager($request);
		$templateMgr->assign('pageTitle', 'plugins.generic.title.identificationCodes');
		$templateMgr->assign('userRoles', $userRoles); // necessary for the backend sidenavi to appear
		$templateMgr->assign('identificationCodes', $identificationCodes);
		$templateMgr->assign('selectedIdentificationCodes', $selectedIdentificationCodes);
		$templateMgr->assign('onixCodes', $onixCodes);
		$identificationCodesPlugin = PluginRegistry::getPlugin('generic', IDENTIFICATIONCODES_PLUGIN_NAME);
		$templateMgr->display($identificationCodesPlugin->getTemplatePath().'identificationCodes.tpl');
	}
}
?>
