#!/usr/bin/env python2
from bs4 import BeautifulSoup

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
            for chance in range(1, 3):
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
