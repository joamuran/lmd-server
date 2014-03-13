LmdServer
=========

Version 2 of lliurex-ltsp-server, integrated in the LMD Project (LliureX LTSP 2.0), for thin cient creation and management.

class LmdTemplateManager
------------------------

### Description

Manages template files to create LTSP Fat-thin client images.
 
### N4d Methods

* *_getTemplateList():_* anonymous
Reads the file list of templates from /etc/ltsp/templates and returna a JSON List.

* *_getTemplate(template):_* anonymous
Reads the file template from /etc/ltsp/templates and returna a JSON string with the config options
	
* *setTemplate(template, config):* teachers, admins
Writes in /etc/ltsp/templates the config file "template" with the "config" (JSON format) content.


class LmdImageManager
------------------------

### Description

Manages client images (.img files) metadata. This data will be stored in server, under /etc/ltsp/images.

The image metadata data will be:

* *id:* Image id
* *name:* Image name
* *desc:* Image descripion
* *img:* image .png file
* *template:* template file which is the image based in

Other fields such as: img file, chroot, date of last modification, SO version, error codes, etc. will be calculated automatically.

 
### N4d Methods

* *_getImageList():_* anonymous
Reads the file list of images from /etc/ltsp/images and returna a JSON List.

* *_getImage(image):_* anonymous
Reads the file image from /etc/ltsp/images and returna a JSON string with the image metadata
	
* *_setTemplate(template, {config})_:* teachers, admins
Writes in /etc/ltsp/images the config file "template" with the "config" (JSON/Parameter list) content.