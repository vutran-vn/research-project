#!/usr/bin/env python2
from bs4 import BeautifulSoup
import urllib2
import settings

#Get data from a particular page
# - Param: 
# - Return: the expected data
def get_data_from_page(page, url):
    result = {};
    
    #Open this page with BeautifulSoup
    p = urllib2.urlopen(url).read()
    soup = BeautifulSoup(p);
    soup.prettify();
        
    def find_tags(parent_structure):
        if parent_structure:
            if len(parent_structure['attributes']) == 0:
                return soup.find_all(parent_structure['name']);
            elif parent_structure['attributes'][0]["name"] == "class":
                return soup.find_all(parent_structure['name'], parent_structure['attributes'][0]["value"]);
            elif parent_structure['attributes'][0]["name"] == "id":
                return soup.find_all(id=parent_structure['attributes'][0]["value"]);
            else:
                return None;
        return None;
        
    for obj in page['objects']: 
        result_objects = [];
        parent_objects = find_tags(obj['parent_tag'])
            
        if parent_objects:
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
                        if par.find_all(attr['filter_tag']['name']):
                            tags = par.find_all(attr['filter_tag']['name']);
                            
                            if(attr['multiple'] == 'yes'):
                                result_object[attr['name']] = [];
                                for tag in tags:
                                    #If tagText is set to "1": Get the text content of this tag
                                    if attr['expected_result']['text'] == "1":
                                        result_object[attr['name']].append(tag.get_text());
                            else:
                                tag = tags[attr['filter_tag']['position']];

                                #If tagText is set to "1": Get the text content of this tag
                                if attr['expected_result']['text'] == "1":
                                    result_object[attr['name']] = tag.get_text();

                                #Check if there are any expected attribute value to get data, for example "href"
#                                for tag_attr in attr['expected_result']['attributes']:
#                                    tag_attr_value = tag.get(tag_attr);
#                                    if tag_attr == "href":
#                                        tag_attr_value = settings.config['website_url'] + tag_attr_value;
#                                    result_object[tag_attr] = tag_attr_value;

                    #Append the object data to final result 
                    result_objects.append(result_object);
        
        #Assign the object name to the retrieve list
        obj_name = obj['name'];
        result[obj_name] = result_objects;
    
    return result;