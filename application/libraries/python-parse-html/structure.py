#!/usr/bin/env python2
from bs4 import BeautifulSoup
import urllib2
import settings
import re

def analyse_structure(page):
    p = urllib2.urlopen(page["url"]).read()
    soup = BeautifulSoup(p);
    soup.prettify();
    
    def reduce_string(string):
        return string[:25] if len(string) > 25 else string;
        
    #Find all tags which have the text of sample
    # - Param 1: stringSample - String of sample provided by User config
    # - Param 2: soup - BeautifulSoup instance
    # - Return: List of tags OR empty list
    def find_tags_by_text(parentNode, stringSample):
        if parentNode:
            return [text.parent for text in parentNode.find_all(text=re.compile("^" + reduce_string(stringSample)))]
        return None;
    
    def analyse_parent_tag(tag):
        result = {};
        if tag:
            result["name"] = tag.name;
            result["attributes"] = [];

            if tag.get('class'):
                result["attributes"].append({"name": "class", "value": tag.get('class')});
            if tag.get('id'):
                result["attributes"].append({"name": "id", "value": tag.get('id')});
        
        return result;
    
    def analyse_tag(parentTag, tag):
        result = {};
        if tag:
            result["name"] = tag.name;
            result["position"] = [reduce_string(t.get_text()) for t in parentTag.find_all(tag.name)].index(reduce_string(tag.get_text()));
        
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
        def find_root_parent_chances(tag, chanceNumber):
            parentTag = tag.parent
            for chance in range(0, chanceNumber):
                count = 0;
                for attr in object["attributes"]:
                    if find_tags_by_text(parentTag, attr['sample']):
                        count = count + 1;
                        
                if count == len(object["attributes"]):
                    return parentTag;
                parentTag = parentTag.parent
            
            return None
            
        firstSample = object["attributes"][0]['sample'];
        
        firstSampleTags = find_tags_by_text(soup, firstSample);
        for sampleTag in firstSampleTags:
            parent_tag = find_root_parent_chances(sampleTag, 3);
            if parent_tag:
                return parent_tag;
            else:
                parent_tag = find_root_parent_chances(sampleTag, 5);
                if parent_tag:
                    return parent_tag;
                else:
                    parent_tag = find_root_parent_chances(sampleTag, 7);
                    if parent_tag:
                        return parent_tag;
                    else:
                        return None;
                
    
    #Find parent tag of the samples, analyse structures of samples to get "filter_tag" and "expected_result"
    for obj in page["objects"]:
        parentTag = find_root_parent(obj);
        #Analyse parent tag
        obj['parent_tag'] = analyse_parent_tag(parentTag);
        
        #Loop all attribute and analyse filter tag and expected result for each attribute
        for attr in obj["attributes"]:
            attr_tags = find_tags_by_text(parentTag, attr['sample']);
            
            if attr_tags:
                #Analyse attributes' filter tag
                attr['filter_tag'] = analyse_tag(parentTag, attr_tags[0]);
                #Analyse attrubutes' expected result
                attr['expected_result'] = analyse_expected_result(attr_tags[0]);
                
                #Change the attribute has_structure to 1
                page['has_structure'] = '1'