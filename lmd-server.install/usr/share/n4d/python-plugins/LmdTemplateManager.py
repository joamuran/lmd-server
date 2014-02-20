import json

class LmdTemplateManager:
	
		
	def __init__(self):
		self.templatepath="/etc/ltsp/templates"

		
		pass
	#def __init__
	
	def getTemplateList(self):
		'''
		Reads the file list of templates from /etc/ltsp/templates
		Returna a JSON List.
		'''
		templatelist=[]
		
		for i in os.listdir(self.templatepath):
			if '.conf' in i:
				templatelist.append(str(i))
				
		return json.dumps(templatelist)
			
			
	# END def GetListTemplates(self)



	def getTemplate(self, template):
		'''
		Reads the file template from /etc/ltsp/templates
		Returna a JSON string with the config options
		'''
		pass	
	# END def getListTemplate(self, template)
		
		
		
	def setTemplate(self, template, config):
		'''
		Writes in /etc/ltsp/templates the config file "template" with
		the "config" (JSON format) content.
		'''
		pass
	
	# def setTemplate(self, template, config)