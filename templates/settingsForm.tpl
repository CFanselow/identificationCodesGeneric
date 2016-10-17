{**
 * @file plugins/generic/identificationCodes/templates/settingsForm.tpl
 *
 * Copyright (c) 2016 Language Science Press
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 *}

<div id="identificationCodesSettings">

<script>
	$(function() {ldelim}
		// Attach the form handler.
		$('#identificationCodesSettingsForm').pkpHandler('$.pkp.controllers.form.AjaxFormHandler');
	{rdelim});
</script>

<form class="pkp_form" id="identificationCodesSettingsForm" method="post" action="{url router=$smarty.const.ROUTE_COMPONENT op="manage" category="generic" plugin=$pluginName verb="settings" save=true}">
	{include file="controllers/notification/inPlaceNotification.tpl" notificationId="identificationCodesSettingsFormNotification"}

	<h3>{translate key="plugins.generic.identificationCodes.settings.title"}</h3>

	{fbvFormArea id="identificationCodesSettingsFormArea"}

		{fbvFormSection list=true}
			<span>{translate key="plugins.generic.identificationCodes.intro.codes"}</span>
			{fbvElement type="text" id="langsci_identification_codes" value=$langsci_identification_codes label="plugins.generic.identificationCodes.lable.codes" maxlength="200" size=$fbvStyles.size.MEDIUM}
		{/fbvFormSection}


	{/fbvFormArea}

	{fbvFormButtons}
</form>

<p><span class="formRequired">{translate key="common.requiredField"}</span></p>
</div>
