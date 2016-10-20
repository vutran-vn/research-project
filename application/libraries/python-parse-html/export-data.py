#!/usr/bin/env python2
from lib import database
import csv
import json
import unicodedata

database.init()

with open('../../../data/config/runTimeExport.json', 'r') as f1:
    try:
        runTimeJSON = json.load(f1)
        runTime = int(runTimeJSON['runTime'])
    # if the file is empty the ValueError will be thrown
    except ValueError:
        quit()
        
limit = 100
skip = limit * (runTime - 1)
documents = database.find_many_documents('company_specific', None, limit, skip)

companies_data = [];
companies_reviews = [];

for doc in documents:
    company_data = {};
    company_reviews = {};
    for obj in doc['data']:
        if obj['object_name'] == "detail":
            company_data['company_name'] = obj['data'][0]['company_name'];
            if len(obj['data'][0]['sub_data'][0]['data']) > 0:
                company_data['about'] = obj['data'][0]['sub_data'][0]['data'][0]['about_content'];
            else:
                company_data['about'] = '';
            if len(obj['data'][0]['sub_data'][1]['data']) > 0:
                company_data['key_features'] = obj['data'][0]['sub_data'][1]['data'][0]['key_feature_value'];
            else:
                company_data['key_features'] = '';
        elif obj['object_name'] == "services":
            company_data['services'] = obj['data'][0]['service_name'];
        elif obj['object_name'] == "more_info":
            company_data['company_url'] = obj['data'][0]['company_url'];
        elif obj['object_name'] == "review":
            company_reviews['company_name'] = company_data['company_name'];
            company_reviews['company_url'] = company_data['company_url'];
            company_reviews['reviews'] = obj['data'];
    
    companies_data.append(company_data);
    companies_reviews.append(company_reviews);

with open('../../../data/csv/companies.csv', 'ab') as f1:
    writer1 = csv.writer(f1)
    #Apply for first run
    if runTime == 1:
        writer1.writerow(['Service Name', 'Service URL', 'Service Key Features', 'Service Categories', 'Service Description']);
    for company_data in companies_data:
        com_name = unicodedata.normalize('NFKD', company_data['company_name']).encode('ascii', 'ignore');
        com_url = unicodedata.normalize('NFKD', company_data['company_url']).encode('ascii', 'ignore');
        key_features = '\r\n'.join(company_data['key_features']).encode('ascii', 'ignore');
        services = '\r\n'.join(company_data['services']).encode('ascii', 'ignore');
        about = company_data['about'].encode('ascii', 'ignore');
        
        writer1.writerow([com_name, com_url, key_features, services, about])
        
with open('../../../data/csv/companies_reviews.csv', 'ab') as f2:
    writer2 = csv.writer(f2)
    #Apply for first run
    if runTime == 1:
        writer2.writerow(['Service Name', 'Service URL', 'Review Name', 'Review Date', 'Review Content']);
    for company_reviews in companies_reviews:
        for review in company_reviews['reviews']:
            com_name = unicodedata.normalize('NFKD', company_reviews['company_name']).encode('ascii', 'ignore');
            com_url = unicodedata.normalize('NFKD', company_reviews['company_url']).encode('ascii', 'ignore');
            rev_name = unicodedata.normalize('NFKD', review['review_name']).encode('ascii', 'ignore');
            rev_date = unicodedata.normalize('NFKD', review['review_date']).encode('ascii', 'ignore');
            rev_comment = unicodedata.normalize('NFKD', review['review_comment']).encode('ascii', 'ignore');
            
            writer2.writerow([com_name, com_url, rev_name, rev_date, rev_comment])
            
#Save back runTime with increment 1
runTime = runTime + 1
runTimeJSON = {"runTime": runTime}
with open('../../../data/config/runTimeExport.json', 'w') as f3:
    json.dump(runTimeJSON, f3)