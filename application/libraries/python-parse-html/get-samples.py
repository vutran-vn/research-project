#!/usr/bin/env python2
#encoding: UTF-8
from lib import settings
from lib import data

settings.init()

#Loop pages in config_structure and get data from them and from their siblings based on learned structure
count = 0;
for page in settings.config['pages']:
    #Get data from this page based on its learned structure
    liveData = data.get_data_from_page(page, page['url']);
    settings.save_data(liveData, 'page'+str(count)+'.json')

    count = count + 1;
