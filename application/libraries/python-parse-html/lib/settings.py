#!/usr/bin/env python2
import json

def init():
    global config
    
    #Read data from config.json
    with open('../../../config.json', 'r') as f1:
        try:
            config = json.load(f1)
        # if the file is empty the ValueError will be thrown
        except ValueError:
            config = {}

def save_config():
    with open('../../../config.json', 'w') as f1:
        json.dump(config, f1)
        
def save_data(liveData, filename):
    with open('../../../'+filename, 'w') as f2:
        json.dump(liveData, f2)