import json
import collections

pathToJsonFile = '../images/gallery/listing.json'

listing = json.loads(open(pathToJsonFile).read(), object_pairs_hook=collections.OrderedDict)

imgString = '<div class="3u"><a href="images/gallery/%s/images/%s" class="image fit"><img src="images/gallery/%s/thumbs/%s" alt="" title="%s" /></a></div>'
vidString = '<div class="3u"><a href="%s" class="image fit"><img src="%s" alt="" title="%s" /></a></div>'

for cat in listing:
	print '<section id="%s">' % cat
	print '\t<div class="container box style2">'
	print '\t\t<h2>%s</h2>' % cat.title()
	print '\t\t<div class="inner gallery">'

	i = 0

	for item in listing[cat]:
		if i == 0:
			print '\t\t\t<div class="row 0%">'

		if cat == "animations":
			print ('\t\t\t\t' + vidString) % (item["file"], item["thumbs"], item["title"])
		else:
			print ('\t\t\t\t' + imgString) % (cat, item["file"], cat, item["file"], item["title"])

		i = i + 1
		if i == 4:
			print '\t\t\t</div>'
			i = 0

	if i != 0:
		print '\t\t\t</div>'

	print '\t\t</div>'
	print '\t</div>'
	print '</section>'