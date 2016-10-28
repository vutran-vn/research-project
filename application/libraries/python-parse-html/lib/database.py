#!/usr/bin/env python2
from pymongo import MongoClient;

def init():
    #Connect MongoDB Client
    client = MongoClient();

    #Access database. This case is "dev"
    global db
    db = client.dev;

#Access collection (a group of documents) = equivalent of a table in relational database

#Get all current collections in the database
# - Return: Collections (List)
def list_collections():
    return db.collection_names(include_system_collections=False)

#Insert one document to a particular collection
# - Param: collection_name, collection_document
# - Return: InsertOneResult Object
def insert_one_document(collection_name, collection_document):
    #Access collection and insert data
    collection = db[collection_name];
    return collection.insert_one(collection_document);

#Insert many documents to a particular collection
# - Param: collection_name, collection_document
# - Return: InsertOneResult Object
def insert_many_documents(collection_name, collection_document):
    #Access collection and insert data
#    if not collection_name in db.collection_names():
#        db.createCollection(collection_name)
        
    collection = db[collection_name];
    return collection.insert_many(collection_document);

def find_one_document(collection_name, query_dictionary):
    #Access collection and insert data
    collection = db[collection_name];
    if query_dictionary:
        return collection.find_one(query_dictionary);
    else:
        return collection.find_one();

def find_many_documents(collection_name, query_dictionary, limit, skip):
    #Access collection and insert data
    collection = db[collection_name];
    if query_dictionary:
        return collection.find(query_dictionary).limit(limit).skip(skip);
    else:
        return collection.find().limit(limit).skip(skip);
    
def count_document(collection_name):
    #Access collection and insert data
    collection = db[collection_name];
    return collection.count();
