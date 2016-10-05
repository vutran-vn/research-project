#!/usr/bin/env python2
#encoding: UTF-8
from lib import settings
from lib import data

settings.init()

#Check if this page has siblings -> get data based on its learned structure
#if page['siblings_urls']:
#    print data.get_data_from_page(page, page['siblings_urls'][0]);
#    print data.get_data_from_page(page, page['siblings_urls'][1]);
#        for sib_url in page['siblings_urls']:
#            print data.get_data_from_page(page, sib_url)
