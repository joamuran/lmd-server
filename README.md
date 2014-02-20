LmdServer
=========

Version 2 of lliurex-ltsp-server, integrated in the LMD Project (LliureX LTSP 2.0), for thin cient creation and management.

class LmdTemplateManager
------------------------

**Description**

Manages template files to create LTSP Fat-thin client images.
 
**N4d Methods**

*getTemplateList():* anonymous
Reads the file list of templates from /etc/ltsp/templates and returna a JSON List.

*getTemplate(template):* anonymous
Reads the file template from /etc/ltsp/templates and returna a JSON string with the config options
	
*setTemplate(template, config):* teachers, admins
Writes in /etc/ltsp/templates the config file "template" with the "config" (JSON format) content.