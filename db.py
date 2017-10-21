"""
Manage the database connection

"""
import logging

from pymongo import MongoClient

l = logging.getLogger(__name__)

client = MongoClient()
db = client["word"]


def insert(kind, data, key=None, mode="gen"):
    """
    Insert the data into db

    :param str kind: collection of the item
    :param str key: str to be id of the item
    :param dict data: data dictionary
    :return:
    """

    col = kind

    # Check if the key already exist
    if db[col].find_one({"_id": key}):
        l.debug("Key %s already exist in col %s.", key, col)
        if mode == "upsert":
            # Overwrite the key
            db[col].update_one({"_id": key}, data, upsert=True)
        elif mode == "incr":
            # Only work on integer key. Increment by one.
            # Assume that we have key that are monotonically increasing.
            key_ins = int(key) + 1
            data["_id"] = key_ins
            db[col].insert_one(data)
        elif mode == "gen":
            # Let mongoDB generate the key
            db[col].insert_one(data)
        else:
            raise Exception("Invalid mode of insertion")



# def authenticate(cred='/Users/zui/kode/etc/hack/HackHarvard/word-277d2c088f30.json'):
#     """
#     Authenticate into Google Datastore
#
#     :param cred: path to the credential file
#     :return: datastore client
#     :rtype: datastore.Client
#     """
#
#     from google.cloud import datastore
#
#     datastore_client = datastore.Client.from_service_account_json(cred)
#
#     return datastore_client
