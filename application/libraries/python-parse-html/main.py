#!/usr/bin/env python2
#encoding: UTF-8
import settings
import structure
import data

settings.init()

for page in settings.config['pages']:
    #Check if this page doesn't have structures for its object -> call Function: analyse_structure
    if page['has_structure'] == '0':
        structure.analyse_structure(page);
    
    #Get data for this page based on its learned structure
    print data.get_data_from_page(page, page['url']);
    
    #Check if this page has siblings -> get data based on its learned structure
    if page['siblings_urls']:
        for sib_url in page['siblings_urls']:
            print data.get_data_from_page(page, sib_url)
    
#print settings.config

#data = data.get_data();
#print data

#data.get_hrefs();