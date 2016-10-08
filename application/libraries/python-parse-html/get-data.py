#!/usr/bin/env python2
#encoding: UTF-8
from lib import settings
from lib import data
import json
import re

settings.init()

config_siblings = [];
#Read data from config.json
with open('../../../data/links/config-siblings.json', 'r') as f1:
    try:
        config_siblings = json.load(f1)
    # if the file is empty the ValueError will be thrown
    except ValueError:
        config_siblings = {}
  
def search_config_page(page_url):
    page = {};
    for pa in settings.config['pages']:
        pa_pattern = re.compile(pa['pattern']);
        if pa['url'] == page_url:
            return pa;
        if pa['pattern'] != '' and pa_pattern.search(page_url):
            return pa;
        for obj in pa['objects']:
            if "pages" in obj:
                for sub_pa in obj['pages']:
                    sub_pa_pattern = re.compile(sub_pa['pattern']);
                    if sub_pa['url'] == page_url:
                        return sub_pa;
                    if sub_pa['pattern'] != '' and sub_pa_pattern.search(page_url):
                        return sub_pa;
    return page;

def get_data_multiple_siblings(siblings, startPosition, endPosition):
    result = {};
    for chance in range(startPosition, endPosition + 1):
        entity = siblings[chance];
        if isinstance(entity, basestring):
            config_page = search_config_page(entity);
            result = data.get_data_from_page(config_page, entity);
        else:
            config_page = search_config_page(entity['url']);
            result = data.get_data_from_page(config_page, entity['url']);
#            print result;
            if len(entity['objects']) > 0:
                for obj in entity['objects']:
                    for key, url in obj.iteritems():
                        config_sub_page = search_config_page(url);
                        for result_obj in result:
                            if result_obj['object_name'] == key:
                                for d in result_obj['data']:
                                    d['sub_data'] = data.get_data_from_page(config_sub_page, url);
            print result;
    return result;
        
def get_data(page):
    result = {};
    if len(page['siblings_urls']) == 0:
        config_page = search_config_page(page['url']);
        result = data.get_data_from_page(config_page, page['url']);
    else:
        result = get_data_multiple_siblings(page['siblings_urls'], 0, 1);
    
    return result;
    
    #Save data to mongoDB
    

#Loop pages in config_structure and get data from them and from their siblings based on learned structure
#for page in config_siblings['pages']:
#    get_data(page)

get_data(config_siblings['pages'][2]);
