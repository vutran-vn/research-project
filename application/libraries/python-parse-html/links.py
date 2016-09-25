#!/usr/bin/env python2
from bs4 import BeautifulSoup
import settings
import urllib2
import time
    
settings.init();

pages_siblings = [];
for pa in settings.config['pages']:
    page_config = {};
    page_config['url'] = pa['url'];
    page_config['pattern'] = pa['pattern'];
    page_config['siblings_urls'] = [];
    
    pages_siblings.append(page_config);
    
#Function get all urls in this page
def get_urls(page_url):
    def customize_links(link_list):
        url_list = []
        for link in link_list:
            if "http" not in link['href']:
                url_list.append(settings.config['website_url'] + link['href'])
            else:
                url_list.append(link['href'])

        #Return unique item in the list
        return list(url_list)
    
    p = urllib2.urlopen(page_url).read()
    soup = BeautifulSoup(p);
    soup.prettify();
    
    return customize_links(soup.findAll('a', href=True))

def find_siblings(urls):
    for pa in pages_siblings:
        [pa['siblings_urls'].append(u) for u in urls if pa['pattern'] != '' and pa['pattern'] in u and u not in pa['siblings_urls']]
    
#Get all urls from this page -> assign siblings_urls for the pages configuration appropriately
urls = get_urls(pages_siblings[1]['url']);
find_siblings(urls)
settings.save_links(pages_siblings)

count = 0;
for url in urls:
    count = count + 1;
    
    sub_urls = get_urls(url);
    find_siblings(sub_urls);
    
    if count == 10:
        settings.save_links(pages_siblings);
        time.sleep(15);
#
#print pages_siblings;

#count = 0;
#for chance in range(340, 357):
#    time.sleep(2);
#    count = count + 1;
#    
#    sub_urls = get_urls(settings.categories[1]['siblings_urls'][chance]);
#    find_siblings(sub_urls);
#    
#    settings.save_links(pages_siblings, '340_356_category.json');
#    settings.save_position(count);