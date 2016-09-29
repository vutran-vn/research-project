#!/usr/bin/env python2
#encoding: UTF-8
import settings
import structure
import data

settings.init()

def analyse_structure_main():
    #Check if config requires analyse structure (analyse_structure = 'yes') => Loop all pages to analyse structure
    if settings.config['analyse_structure'] == 'yes':
        #....Compare something here to check where to analyse_structure -> .....
        for page in settings.config['pages']:
            #call Function: analyse_structure
            structure.analyse_structure(page);

        settings.config['analyse_structure'] = 'no'
        #Save the config to config.json
        settings.save_config()
        
def get_sample_data():
    #Loop pages in config_structure and get data from them and from their siblings based on learned structure
    count = 0;
    for page in settings.config['pages']:
        #Get data from this page based on its learned structure
        liveData = data.get_data_from_page(page, page['url']);
        settings.save_data(liveData, 'page'+str(count)+'.json')
        
        count = count + 1;
        
def get_data_main():
    #Check if this page has siblings -> get data based on its learned structure
    if page['siblings_urls']:
        print data.get_data_from_page(page, page['siblings_urls'][0]);
        print data.get_data_from_page(page, page['siblings_urls'][1]);
#        for sib_url in page['siblings_urls']:
#            print data.get_data_from_page(page, sib_url)
        
#Call functions
analyse_structure_main()
get_sample_data()
