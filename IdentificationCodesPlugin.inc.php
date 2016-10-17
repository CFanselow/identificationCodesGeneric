<?php

/**
 * @file plugins/generic/identificationCodes/IdentificationCodesPlugin.inc.php
 *
 * Copyright (c) 2016 Language Science Press
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING. 
 *
 * @class IdentificationCodesPlugin
 *
 */

import('lib.pkp.classes.plugins.GenericPlugin');

class IdentificationCodesPlugin extends GenericPlugin {


	function register($category, $path) {

		if (parent::register($category, $path)) {
			$this->addLocaleData();
			
			if ($this->getEnabled()) {
				HookRegistry::register ('LoadHandler', array(&$this, 'handleLoadRequest'));
			}
			return true;
		}
		return false;

	}

	function handleLoadRequest($hookName, $args) {

		// get url path components to overwrite them 
		$pageUrl =& $args[0];
		$opUrl =& $args[1];

		if ($pageUrl=="identificationCodes" && $opUrl=="index") {

			define('HANDLER_CLASS', 'IdentificationCodesHandler');
			define('IDENTIFICATIONCODES_PLUGIN_NAME', $this->getName());

			$this->import('IdentificationCodesHandler');
			IdentificationCodesHandler::setPlugin($this);

			return true;
		}
		return false;
	}

	/**
	 * @see Plugin::getActions()
	 */
	function getActions($request, $verb) {
		$router = $request->getRouter();
		import('lib.pkp.classes.linkAction.request.AjaxModal');
		return array_merge(
			$this->getEnabled()?array(
				new LinkAction(
					'settings',
					new AjaxModal(
						$router->url($request, null, null, 'manage', null, array('verb' => 'settings', 'plugin' => $this->getName(), 'category' => 'generic')),
						$this->getDisplayName()
					),
					__('manager.plugins.settings'),
					null
				),
			):array(),
			parent::getActions($request, $verb)
		);
	}

 	/**
	 * @see Plugin::manage()
	 */
	function manage($args, $request) {
		switch ($request->getUserVar('verb')) {
			case 'settings':
				$context = $request->getContext();
				$this->import('SettingsForm');
				$form = new SettingsForm($this, $context->getId());

				if ($request->getUserVar('save')) {
					$form->readInputData();
					if ($form->validate()) {
						$form->execute();
						return new JSONMessage(true);
					}
				} else {
					$form->initData();
				}
				return new JSONMessage(true, $form->fetch($request));
		}
		return parent::manage($args, $request);
	}

	function getDisplayName() {
		return __('plugins.generic.identificationCodes.displayName');
	}

	function getDescription() {
		return __('plugins.generic.identificationCodes.description');
	}

	function getTemplatePath($inCore = false) {
		return parent::getTemplatePath() . 'templates/';
	}
}

?>
