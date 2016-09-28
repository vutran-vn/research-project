#!/usr/bin/env python2
import json

def init():
    global config
    global config_structure
    
    #Read data from config.json
    with open('../../../config.json', 'r') as f1:
        try:
            config = json.load(f1)
        # if the file is empty the ValueError will be thrown
        except ValueError:
            config = {}
    
    #Read data from config_structure.json
    with open('../../../config_structure.json', 'r') as f2:
        try:
            config_structure = json.load(f2)
        # if the file is empty the ValueError will be thrown
        except ValueError:
            config_structure = {}
            
#init();
#print config;

def save_config():
    with open('../../../config.json', 'w') as f1:
        json.dump(config, f1)

def save_config_structure():
    with open('../../../config_structure.json', 'w') as f2:
        json.dump(config_structure, f2)