Key data
============

- name of the plugin: Identification Codes Plugin
- author: Carola Fanselow
- current version: 1.0.0.0
- tested on OMP version: 1.1.1-1
- github link: 
- community plugin: yes, 1.0.0.0
- date: 28.2.2016

Description
============

This plugin lists the identification code values for a number of code types to be specified in the plugin settings. Submission id, submission title and the publication format id are displayed. The path of the page is [pressPath]/identificationCodes.
 
Implementation
================

Hooks
-----
- used hooks: 1

		LoadHandler

New pages
------
- new pages: 1

		[press]/identificationCodes

Templates
---------
- templates that substitute other templates: 0
- templates that are modified with template hooks: 0
- new/additional templates: 1

		identificationCodes.tpl

Database access, server access
-----------------------------
- reading access to OMP tables: 5

		press_settings
		identification_codes 
		submission_settings
		publication_formats
		publication_format_settings

- writing access to OMP tables: 0
- new tables: 0
- nonrecurring server access: no
- recurring server access: no
 
Classes, plugins, external software
-----------------------
- OMP classes used (php): 5
	
		GenericPlugin
		Handler
		DAO
		ONIXCodelistItemDAO
		Form

- OMP classes used (js, jqeury, ajax): 1

		AjaxFormHandler

- necessary plugins: 0
- optional plugins: 0
- use of external software: no
- file upload: no
 
Metrics
--------
- number of files: 13
- lines of code: 739

Settings
--------
- settings: 1

		code types to be listed, separated by commas

Plugin category
----------
- plugin category: generic

Other
=============
- does using the plugin require special (background)-knowledge?: no
- access restrictions: admin, press manager
- adds css: yes




