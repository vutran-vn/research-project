#!/usr/bin/env python2
from bs4 import BeautifulSoup
import settings

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
                        tag = par.find(attr['filter_tag']['name']);

                        #If tagText is set to "1": Get the text content of this tag
                        if attr['expected_result']['text'] == "1":
                            result_object[attr['name']] = tag.get_text();

                        #Check if there are any expected attribute value to get data, for example "href"
                        for tag_attr in attr['expected_result']['attributes']:
                            tag_attr_value = tag.get(tag_attr);
                            if tag_attr == "href":
                                tag_attr_value = settings.config['website_url'] + tag_attr_value;
                            result_object[tag_attr] = tag_attr_value;

                #Append the object data to final result 
                result_objects.append(result_object);
        
        #Assign the object name to the retrieve list
        obj_name = obj['name'];
        result[obj_name] = result_objects;
        
    return result;

#Get data based on the structure learned from the User configuration and sample
# - Return: All expected data
def get_data():
    result = [];
    
    for page in settings.config['pages']:
        result.append(get_data_from_page(page))
        
    return result;