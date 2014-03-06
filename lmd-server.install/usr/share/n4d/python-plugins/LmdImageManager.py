import json
import os


class LmdImageManager:
	
		
	def __init__(self):
		self.imagepath="/etc/ltsp/images/"

		
		pass
	#def __init__
	
	def getImageList(self):
		'''
		Reads the file list of templates from /etc/ltsp/images
		Returna a JSON List.
		'''
		imagelist=[]
		
		for i in os.listdir(self.imagepath):
			if '.json' in i:
				imagelist.append(str(i))
				
		return json.dumps(imagelist)
			
			
	# END def GetListImages(self)

	def getImage(self, image):
		'''
		Returns the metadata from certain image
		'''
		try:
			json_data=open(self.imagepath+image)
			data = json.load(json_data)
			json_data.close()
			return json.dumps(data)
			#return data;
		except Exception as e:
			return str(e);

		# END def getListTemplate(self, image)
		
		
	def setImage(self, image, *data):
		'''
		Saves metadata from *data to image
		'''
		
		datafile="";
		for i in data:
			datafile=datafile+i+" ";
		
				
		jsondata=json.loads(datafile)
		print "type is:"+str(type(jsondata))
		fd=open(self.imagepath+image, 'w')
		fd.write('{"id":"'+jsondata['id']+'",\n')
		fd.write('"name":"'+jsondata['name']+'",\n')
		fd.write('"desc":"'+(jsondata['desc']).encode('utf8')+'",\n')
		fd.write('"img":"'+jsondata['img']+'"}\n')
		fd.close()
	
	# def setImage(self, image, data)
