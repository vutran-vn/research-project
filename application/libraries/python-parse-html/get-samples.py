#!/usr/bin/env python2
#encoding: UTF-8
from lib import settings
from lib import data

settings.init()

samplePages = {};

def get_sample_data(page):
    liveData = data.get_data_from_page(page, page['url']);
    
    #Save data to a file
    print page['url'];
    fileName = 'data/sample/sample-page-'+str(len(samplePages) + 1)+'.json';
    settings.save_data(liveData, fileName)
    samplePages[fileName] = page['url'];
    
    for obj in page['objects']:
        if 'pages' in obj:
            for sub_page in obj['pages']:
                get_sample_data(sub_page);
    
#Loop pages in config_structure and get data from them and from their siblings based on learned structure
for page in settings.config['pages']:
    get_sample_data(page)
    
#Save samplePages to file sample-pages.json
settings.save_data(samplePages, "data/sample/sample-pages.json");
