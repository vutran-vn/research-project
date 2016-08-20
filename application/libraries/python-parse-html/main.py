#!/usr/bin/env python2
#encoding: UTF-8
from bs4 import BeautifulSoup
import json
import re
import sys
    
soup = BeautifulSoup(open("categories.html"))
url_main = "http://www.serchen.co.uk"
url_browse = url_main + "/browse/"
url_category = url_main + "/category"

knowledge = {
'mainAreaKeys': ['main', 'main-containter'], 
'categoryKeys': ['categories'],
'commonTagKeys': ['div', 'ul', 'li'],
'selectorKeys': ['id', 'class']
}

#This function is to get the main area of the harvested Web page
#Currently not in use
def main_area():
    mainAreaKeys = knowledge['mainAreaKeys']
    result = ""
    for key in mainAreaKeys:
        if soup.find(id=key):
            return soup.find(id=key)
    return result

#User regular expression, intelligent techniques to detect repetitive patterns in the Web page
#Develop in a later stage
def repetitive_attributes():
    return

#Analyse the structure of a particular object based on the Tag, Selector and Object Key
def analyze_structure(commonTagKey, selectorKey, objectKey):
    #Get all children class name and available text
        
    #Analyse structure of this type of Object to know its children attributes
    
    data = []
    
    #These lines of code for now focus on getting data from this web page: http://www.serchen.co.uk/browse/
    #These code needs to be dynamic -> develop more features later
    objects = soup.findAll(commonTagKey, {selectorKey: objectKey})
    for ob in objects:
        for child in ob.descendants:  
            try:
                subChild = {}
                if child.name == 'a':
                    objectURL = url_main + str(child.get('href'))
                    objectText = child.get_text()
                    subChild['URL'] = objectURL
                    subChild['URLText'] = objectText   
                    data.append(subChild) 
            except: 
                pass
    return data

#Analyse the page to get the exact Tag, Selector and Category name for getting categories 
def categories():
    #Find out categoryKey, commonTagKey, selectorKey for categories section
    for categoryKey in knowledge['categoryKeys']:
        for commonTagKey in knowledge['commonTagKeys']:
            for selectorKey in knowledge['selectorKeys']:
                if soup.findAll(commonTagKey, {selectorKey: categoryKey}):
                    return analyze_structure(commonTagKey, selectorKey, categoryKey)

dataJSON = json.dumps(categories())
#For now, this code is for writing the JSON string to a file in python/JSON/categories
#In later stage we will store the data in a database
with open('../../../python/JSON/categories', 'w') as f:
    f.write(dataJSON)
