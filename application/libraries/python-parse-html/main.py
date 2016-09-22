#!/usr/bin/env python2
#encoding: UTF-8
from bs4 import BeautifulSoup
import json
import re
import sys

config = {"website_url":"http:\/\/www.serchen.co.uk","pages":[{"url":"dedicated_hosting.html","objects":[{"name":"company","parent_tag":{"name":"div","attributes":[{"name":"class","value":"company-tile-info"}]},"attributes":[{"name":"company_name","sample":"NameHOG"},{"name":"company_service","sample":"Dedicated Server"}]}]}]}

def analyse_structure(page):
    soup = BeautifulSoup(open(page["url"]));
    
    #Find all tags which have the text of sample
    # - Param 1: stringSample - String of sample provided by User config
    # - Param 2: soup - BeautifulSoup instance
    # - Return: List of tags OR empty list
    def find_tags_by_text(stringSample):
        return [text.parent for text in soup.find_all(text=stringSample)]
    
    def analyse_tag(tag):
        result = {};
        result["name"] = tag.name;
        result["attributes"] = [];
        
        if tag.get('class'):
            result["attributes"].append({"name": "class", "value": tag.get('class')});
        if tag.get('id'):
            result["attributes"].append({"name": "id", "value": tag.get('id')});
        
        return result;

    def analyse_expected_result(tag):
        result = {};
        result["text"] = "1";
        result["attributes"] = [];
        
        if tag.name == "a":
            result["attributes"].append("href");
        
        return result;
        
    #Find the common parent which has all attributes of a particular object
    # - Param 1: the list of Tags get from function find_tags
    # - Param 2: the object with a list of its attributes
    # - Return: the root parent tag of these attribute AND analyse the necessary structure of this parent
    def find_root_parent(object):
        firstSample = object["attributes"][0]['sample'];
        
        firstSampleTags = find_tags_by_text(firstSample);
        for sampleTag in firstSampleTags:
            parentTag = sampleTag.parent
            for chance in range(1,3):
                count = 0;
                for attr in object["attributes"]:
                    if attr['sample'] in parentTag.find_all(text=True):
                        count = count + 1;
                        
                if count == len(object["attributes"]):
                    return parentTag;
                parentTag = parentTag.parent
    
    for obj in page["objects"]:
        parentTag = find_root_parent(obj);
        #Analyse parent tag
        obj['parent_tag'] = analyse_tag(parentTag);
        
        #Loop all attribute and analyse filter tag and expected result for each attribute
        for attr in obj["attributes"]:
            #Analyse attributes' filter tag
            attr_tags = find_tags_by_text(attr['sample']);
            attr['filter_tag'] = analyse_tag(attr_tags[0]);
            #Analyse attrubutes' expected result
            attr['expected_result'] = analyse_expected_result(attr_tags[0]);

#Get data from a particular page
# - Param: 
# - Return: the expected data
def get_data_from_page(page):
    result = {};
    result_objects = [];
    
    #Open this page with BeautifulSoup
    soup = BeautifulSoup(open(page["url"]));
        
    def find_tags(parent_structure):
        if len(parent_structure['attributes']) == 0:
            return soup.find_all(parent_structure['name']);
        elif parent_structure['attributes'][0]["name"] == "class":
            return soup.find_all(parent_structure['name'], parent_structure['attributes'][0]["value"]);
        elif parent_structure['attributes'][0]["name"] == "id":
            return soup.find_all(id=parent_structure['attributes'][0]["value"]);
        else:
            return []
        
    for obj in page['objects']: 
        parent_objects = find_tags(obj['parent_tag'])
            
        for par in parent_objects:
            #Check if this parent has all the attributes indicated in the structure
            isRightParent = True;
            for attr in obj['attributes']:
                if not par.find(attr['filter_tag']['name']):
                    isRightParent = False;
                    pass;

            #If the parent is the right one, loop all attributes defined in Structure, then get the appropriate data
            if isRightParent:
                result_object = {};
                for attr in obj['attributes']:
                    if par.find(attr['filter_tag']['name']):
#                        result_attribute = {};
                        tag = par.find(attr['filter_tag']['name']);

                        #If tagText is set to "1": Get the text content of this tag
                        if attr['expected_result']['text'] == "1":
                            result_object[attr['name']] = tag.get_text();

                        #Check if there are any expected attribute value to get data, for example "href"
                        for tag_attr in attr['expected_result']['attributes']:
                            tag_attr_value = tag.get(tag_attr);
                            if tag_attr == "href":
                                tag_attr_value = config['website_url'] + tag_attr_value;
                            result_object[tag_attr] = tag_attr_value;

                        #Append the attribute data to this object
#                        result_object.append(result_attribute);

                #Append the object data to final result 
                result_objects.append(result_object);
#                insert_db(result_object);
        
        #Assign the object name to the retrieve list
        obj_name = obj['name'];
        result[obj_name] = result_objects;
        
    return result;

#Get data based on the structure learned from the User configuration and sample
# - Return: All expected data
def get_data():
    result = [];
    
    for page in config['pages']:
        result.append(get_data_from_page(page))
        
    return result;

#print result;

from pymongo import MongoClient;
client = MongoClient();
db = client.test;
datadb = db.data;

def insert_db(data):
    datadb.insert_many(data);

def query_db():
    print datadb.find();
    
#query_db();

for page in config['pages']:
    analyse_structure(page);

data = get_data();
print data
#insert_db(data)

#for page in config['pages']:
#    analyse_structure(page);
#    print page