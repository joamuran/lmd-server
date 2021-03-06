import json
import StringIO
import os
import ConfigParser
import shlex

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
		try:
			config = StringIO.StringIO()
			config.write('[meta_inf]\n')
			config.write('name="'+template+'"\n')
			
			
			config.write('[default]\n')
			config.write(open(str(self.templatepath)+"/"+str(template)).read())
			config.seek(0, os.SEEK_SET)
			cp = ConfigParser.ConfigParser()
			cp.readfp(config)
			aux = cp._sections
			for x in aux.keys():
				for y in aux[x]:
					if aux[x][y][0] == '"' and aux[x][y][-1] == '"':
						aux[x][y] = aux[x][y][1:-1]

			return json.dumps(aux)
			#return json.dumps(cp.items('default'));
			
			
		except Exception as e:
			return "Exception: "+str(e)
		# END def getListTemplate(self, template)
		
		
	def checkTemplateExists(self, template):
		if(os.path.isfile(str(self.templatepath)+"/"+str(template))):
			return "True"
		else:
			return "False"
		
	
	def setTemplate(self, template, config):
		'''
		Writes in /etc/ltsp/templates the config file "template" with
		the "config" (JSON format) content.
		'''
		try:
			f = open(str(self.templatepath)+"/"+str(template), 'w')
			f.write("# LMD Customuzation file for LTSP\n\n")
			
			conf=json.loads(config)
			for (key, value) in conf:
				f.write("{0}={1}\n\n".format(key.upper(), value))
			
			f.close()
			return True
		except Exception as e:
			return "Exception: "+str(e)
	
	# def setTemplate(self, template, config)
