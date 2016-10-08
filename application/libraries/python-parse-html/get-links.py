#!/usr/bin/env python2
from bs4 import BeautifulSoup
import urllib2
import json
import re
import time

config_siblings = [];
#Read data from config.json
with open('../../../data/links/config-siblings.json', 'r') as f1:
    try:
        config_siblings = json.load(f1)
    # if the file is empty the ValueError will be thrown
    except ValueError:
        config_siblings = {}
    
#Function get all urls in this page
def get_urls(page_url):
    def customize_links(link_list):
        url_list = []
        for link in link_list:
            if "http" not in link['href']:
                url_list.append(config_siblings['website_url'] + link['href'])
            else:
                url_list.append(link['href'])

        #Return unique item in the list
        return list(url_list)
    
    p = urllib2.urlopen(page_url).read()
    soup = BeautifulSoup(p);
    soup.prettify();
    
#    return customize_links(soup.findAll('a', href=True))

    for pa in config_siblings['pages']:
        if pa['pattern'] != '':
            pa['siblings_urls'].extend(url for url in customize_links(soup.findAll(href=re.compile(pa['pattern']))) if url not in pa['siblings_urls'])

#def find_siblings(urls):
#    for pa in config_siblings['pages']:
#        [pa['siblings_urls'].append(u) for u in urls if pa['pattern'] != '' and u == pa['pattern'] and u not in pa['siblings_urls']]
    
#Step 1: Get_urls from the first page
#get_urls(config_siblings['pages'][0]['url']);
    
#Step 2: Loop all learned sibling urls from step 1
#runTime = 1
#minNumber = 10 * (runTime - 1)
#maxNumber = 10 * runTime
#for chance in range(minNumber, maxNumber):
#    time.sleep(3);
#    get_urls(config_siblings['pages'][1]['siblings_urls'][chance]);

#Step 3: Add detail /detail/ for all compnay urls
for idx, url in enumerate(config_siblings['pages'][2]['siblings_urls']):
    url_merge = {};
    url_merge['url'] = url;
    url_merge['objects'] = [];
    obj = {};
    obj['detail'] = url + 'details/';
    url_merge['objects'].append(obj);
    config_siblings['pages'][2]['siblings_urls'][idx] = url_merge;

with open('../../../data/links/config-siblings.json', 'w') as f2:
    json.dump(config_siblings, f2)