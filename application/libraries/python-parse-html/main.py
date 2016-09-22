#!/usr/bin/env python2
#encoding: UTF-8
from bs4 import BeautifulSoup
import json
import re
import sys

global config
config = {"website_url":"http:\/\/www.serchen.co.uk","pages":[{"url":"dedicated_hosting.html","objects":[{"name":"company","parent_tag":{"name":"div","attributes":[{"name":"class","value":"company-tile-info"}]},"attributes":[{"name":"company_name","sample":"NameHOG"},{"name":"company_service","sample":"Dedicated Server"}]}]}]}

import settings
import structure
import data

settings.init()

for page in settings.config['pages']:
    structure.analyse_structure(page);

data = data.get_data();
print data