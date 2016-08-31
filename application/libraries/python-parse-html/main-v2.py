#!/usr/bin/env python2
#encoding: UTF-8
from bs4 import BeautifulSoup
import json
import re
import sys

config = {"website_url":"http:\/\/www.serchen.co.uk","pages":[{"url":"http:\/\/www.serchen.co.uk\/browse","objects":[{"name":"category", "attributes":[{"name":"category_name", "sample":"Accounting Software"}, {"name":"category_number", "sample":"110"}]}]}, {"url":"http:\/\/www.serchen.co.uk\/category\/accounting-software\/", "objects":[{"name":"company", "attributes":[{"name":"company_name", "sample":"KashFlow"}, {"name":"company_service", "sample":"Accounting Software"}, {"name":"company_last_reviewed", "sample":"Listed 29 Jul 2010"}, {"name":"company_review_count", "sample":"33 Reviews"}]}, {"name":"Similar Categories", "attributes":[{"name":"category_name", "sample":"Accounts Payable"}, {"name":"category_number", "sample":"0"}]}]}, {"url":"http:\/\/www.serchen.co.uk\/company\/kashflow\/", "objects":[{"name":"company", "attributes":[{"name":"company_name", "sample":"KashFlow"}]}, {"name":"Services", "attributes":[{"name":"service_name", "sample":"Accounting Software"}]}, {"name":"Similar Companies", "attributes":[{"name":"similar_company", "sample":"Truly Simple Accounts"}]}, {"name":"Company URL", "attributes":[{"name":"company_url", "sample":"www.kashflow.com"}]}, {"name":"Review", "attributes":[{"name":"review_name", "sample":"Ian Buck"}, {"name":"review_date", "sample":"Tuesday, April 5, 2016"}, {"name":"review_text", "sample":"It was great until like many others I realised I was overpaying,"}]}, {"name":"Page last update date", "attributes":[{"name":"page_last_update_date", "sample":"This page was last updated 04 April 2016 09:51"}]}]}]}
structure = {"website_url":"http:\/\/www.serchen.co.uk","pages":[{"url":"http:\/\/www.serchen.co.uk\/browse","objects":[{"name":"category","parent_tag":"li","attributes":[{"name":"category_name","sample":"Accounting Software","filter_criteria":{"tagName":"a","tagAttributes":[]},"expected_result":{"tagText":"1","tagAttributes":["href"]}},{"name":"category_number","sample":"110","filter_criteria":{"tagName":"span","tagAttributes":[{"name":"class","value":"listing-count"}]},"expected_result":{"tagText":"1","tagAttributes":[]}}]}]}]}

def analyse_structure():
    for page in config['pages']:
        pageStructure = {}
        #Open this page with BeautifulSoup
        if page['url'] == 'http:\/\/www.serchen.co.uk\/browse\/':
            soup = BeautifulSoup(open("categories.html"));
            for obj in page['objects']:
                #Get the object, attribute name and sample. Then analyse the structure of the page
                #Get the sample values from these attribtues
                #Find a direct parent tag
                pageStructure.append(obj);
            structure.append(pageStructure);
        
    #Store the structure in MongoDB
    #...

def get_data():
    result = [];
    
    for page in structure['pages']:
        #Open this page with BeautifulSoup
        soup = BeautifulSoup(open("categories.html"));
        
        for obj in page['objects']:
            #Loop the structure of this page and get the information
            parent_objects = soup.find_all(obj['parent_tag']);
            
            for par in parent_objects:
                #Check if this parent has all the attributes indicated in the structure
                isRightParent = True;
                for attr in obj['attributes']:
                    if not par.find(attr['filter_criteria']['tagName']):
                        isRightParent = False;
                        pass;
                    
                #If the parent is the right one, loop all attributes defined in Structure, then get the appropriate data
                if isRightParent:
                    result_object = [];
                    for attr in obj['attributes']:
                        if par.find(attr['filter_criteria']['tagName']):
                            result_attribute = {};
                            tag = par.find(attr['filter_criteria']['tagName']);
                            
                            #If tagText is set to "1": Get the text content of this tag
                            if attr['expected_result']['tagText'] == "1":
                                result_attribute[attr['name']] = tag.get_text();
                                
                            #Check if there are any expected attribute value to get data, for example "href"
                            for tag_attr in attr['expected_result']['tagAttributes']:
                                tag_attr_value = tag.get(tag_attr);
                                if tag_attr == "href":
                                    tag_attr_value = structure['website_url'] + tag_attr_value;
                                result_attribute[tag_attr] = tag_attr_value;
                                
                            #Append the attribute data to this object
                            result_object.append(result_attribute);
                            
                    #Append the object data to final result 
                    result.append(result_object);
                     
    return result;

#analyse_structure()
result = get_data();
print result;
