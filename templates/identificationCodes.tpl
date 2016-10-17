{**
 * plugins/generic/identificationCodes/templates/identificationCodes.tpl
 *
 * Copyright (c) 2016 Language Science Press
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 *}

{strip}
	{if !$contentOnly}
		{include file="common/header.tpl"}
	{/if}
{/strip}

<link rel="stylesheet" href="{$baseUrl}/plugins/generic/identificationCodes/css/identificationCodes.css" type="text/css" />

<div id="identificationCodes">

	{if $selectedIdentificationCodes}

	<p>{translate key="plugins.generic.identificationCodes.introduction"}</p>

	<ul>
		{foreach from=$selectedIdentificationCodes item=code}
		<li>{$onixCodes[$code]}</li>
		{/foreach}
	</ul>

	<table>
		<tr>
			<th>SubId</th>
			<th>Title</th>
			<th>PubFormat</th>
			{foreach from=$selectedIdentificationCodes item=code}
			<th>{$onixCodes[$code]}</th>
			{/foreach}
		</tr>
		{foreach from=$identificationCodes item=identificationCode}
		<tr>
			<td>{$identificationCode.subId}</td>
			<td>{$identificationCode.title}</td>
			<td>{$identificationCode.publicationFormat}</td>
			{foreach from=$selectedIdentificationCodes item=code}
			<td>{$identificationCode[$code]}</td>
			{/foreach}
		</tr>
		{/foreach}
	</table> 

	{else}

		<p>{translate key="plugins.generic.identificationCodes.noCodesSelected"}</p>

	{/if}

</div> 

{strip}
	{include file="common/footer.tpl"}
{/strip}
