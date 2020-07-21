#!/usr/bin/env python3

'''
    This little scipt is used to add specific balise in header of
    all html files if not present.
'''

import os


def getFile(path):
    for subdir, _, files in os.walk(path):
        for file in files:

            filepath = subdir + os.sep + file

            if filepath.endswith(".html"):
                yield filepath


if __name__ == "__main__":
    rootdir = os.getcwd()

    for filePath in getFile(rootdir):
        print(filePath)