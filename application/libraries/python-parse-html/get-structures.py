#!/usr/bin/env python2
#encoding: UTF-8
from lib import settings
from lib import structure

settings.init()

#Check if config requires analyse structure (analyse_structure = 'yes') => Loop all pages to analyse structure
if settings.config['analyse_structure'] == 'yes':
    #....Compare something here to check where to analyse_structure -> .....
    for page in settings.config['pages']:
        #call Function: analyse_structure
        structure.analyse_structure(page);

    settings.config['analyse_structure'] = 'no'
    #Save the config to config.json
    settings.save_config()
