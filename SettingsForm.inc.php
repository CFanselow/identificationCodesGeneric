<?php

/**
 * @file plugins/generic/identificationCodes/SettingsForm.inc.php
 *
 * Copyright (c) 2015 Language Science Press
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class SettingsForm
 */

import('lib.pkp.classes.form.Form');

class SettingsForm extends Form {

	/** @var int Associated context ID */
	private $_contextId;

	/** @var WebFeedPlugin Web feed plugin */
	private $_plugin;

	/**
	 * Constructor
	 * @param $plugin WebFeedPlugin Web feed plugin
	 * @param $contextId int Context ID
	 */
	function SettingsForm($plugin, $contextId) {
		$this->_contextId = $contextId;
		$this->_plugin = $plugin;

		parent::Form($plugin->getTemplatePath() . 'settingsForm.tpl');
		$this->addCheck(new FormValidatorPost($this));
	}

	/**
	 * Initialize form data.
	 */
	function initData() {
		$contextId = $this->_contextId;
		$plugin = $this->_plugin;

		$this->setData('langsci_identification_codes', $plugin->getSetting($contextId, 'langsci_identification_codes'));

	}

	/**
	 * Assign form data to user-submitted data.
	 */
	function readInputData() {
		$this->readUserVars(array('langsci_identification_codes'));

		// check that recent items value is a positive integer
		//if ((int) $this->getData('recentItems') <= 0) $this->setData('recentItems', '');

		$this->addCheck(new FormValidator($this, 'langsci_identification_codes', 'required', 'plugins.generic.identificationCodes.settings.itemRequired'));

	}

	/**
	 * Fetch the form.
	 * @copydoc Form::fetch()
	 */
	function fetch($request) {
		$templateMgr = TemplateManager::getManager($request);
		$templateMgr->assign('pluginName', $this->_plugin->getName());
		return parent::fetch($request);
	}

	/**
	 * Save settings. 
	 */
	function execute() {
		$plugin = $this->_plugin;
		$contextId = $this->_contextId;

		$plugin->updateSetting($contextId, 'langsci_identification_codes', $this->getData('langsci_identification_codes'));
	}
}

?>
