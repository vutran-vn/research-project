#!/usr/bin/env python2
from bs4 import BeautifulSoup
import urllib2

#Get data from a particular page
# - Param: 
# - Return: the expected data
def get_data_from_page(page, url):
    result = {};
    
    #Open this page with BeautifulSoup
    try:
        request = urllib2.Request(url, headers={'User-Agent' : "Magic Browser"})
        p = urllib2.urlopen(request).read()
    except urllib2.HTTPError, e:
        #e.fp.read()
        print "Access denied!"
        return
    
    soup = BeautifulSoup(p);
    soup.prettify();

#    soup = BeautifulSoup(open(page["url"]));
        
    def find_tags(parentNode, structure):
        if structure:
            if len(structure['attributes']) == 0:
                return parentNode.find_all(structure['name']);
            elif len(structure['attributes']) == 1:
                return parentNode.find_all(structure['name'], attrs=structure['attributes']);
            else:
                return None;
            
        return None;
    
    def check_has_descendant(node1, node2):
        return True if node2 in node1.descendants else False;
        
    for obj in page['objects']: 
        result_objects = [];
        search_objects = find_tags(soup, obj['parent_tag'])
            
        if search_objects:
            ancestor_objects = [];
            for se in search_objects:
                #Check if this parent has all the attributes indicated in the structure
                isRightAncestor = True;
                for attr in obj['attributes']:
                    if not find_tags(se, attr['filter_tag']):
                        isRightAncestor = False;
                        pass;

                #If the parent is the right one, loop all attributes defined in Structure, then get the appropriate data
                if isRightAncestor:
                    ancestor_objects.append(se);
                 
            #Check multilevel wrapper 
            parent_objects = [];
            len_ancestor_objects = len(ancestor_objects);
            loopTime = 0;
            if len_ancestor_objects >= 1:
                while loopTime <= len_ancestor_objects - 1:
                    if loopTime == len_ancestor_objects - 1:
                        parent_objects.append(ancestor_objects[loopTime])
                    elif not check_has_descendant(ancestor_objects[loopTime], ancestor_objects[loopTime+1]):
                        parent_objects.append(ancestor_objects[loopTime])
                    loopTime = loopTime + 1;
                
            for par in parent_objects:
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