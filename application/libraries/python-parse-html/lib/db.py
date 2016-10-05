#!/usr/bin/env python2
from pymongo import MongoClient;
client = MongoClient();
db = client.test;
datadb = db.data;

def insert_db(data):
    datadb.insert_many(data);

def query_db():
    print datadb.find();
