#!/usr/bin/env python3

'''
    This little scipt is used to add specific balise in header of
    all html files if not present.
'''

import os

analytics = [
    "<script async src=\"https://www.googletagmanager.com/gtag/js?id=UA-151907906-1\"></script>",
    "<script>",
    "window.dataLayer = window.dataLayer || [];",
    "function gtag(){dataLayer.push(arguments);}",
    "gtag('js', new Date());",
    "gtag('config', 'UA-151907906-1');",
    "</script>\n"
]

def getFile(path):
    for subdir, _, files in os.walk(path):
        for file in files:

            filepath = subdir + os.sep + file

            if filepath.endswith(".html"):
                yield filepath


def goToHeader(file):
    line = file.readline()

    while "<head>" not in line:
        if line == "":
            raise Exception("Balise <head> not fount in {}".format(file.name))

        line = file.readline()


def isAnalyticPresent(filePath):
    currentLineTested = 0
    numberOfLine = len(analytics)
    
    with open(filePath, 'r') as file:
        goToHeader(file)

        line = file.readline()

        while line != "":
            if currentLineTested == numberOfLine:
                return True

            if "</head>" in line:
                return False

            if analytics[currentLineTested] in line:
                currentLineTested += 1
            else:
                currentLineTested = 0

            line = file.readline()

        return False
        
def addAnalytics(filePath):
    headEndLine = -1

    with open(filePath, 'r') as file:
        lines = file.readlines()

    for lineNumber, line in enumerate(lines, 0):
        if "</head>" in line:
            headEndLine = lineNumber
            break
    else:
        raise Exception("Balise </head> not in " + filePath)


    lines.insert(headEndLine, '\n'.join(analytics))

    with open(filePath, 'w') as file:
        file.write(''.join(lines))


if __name__ == "__main__":
    rootdir = os.getcwd()

    for filePath in getFile(rootdir):
        hasAnalytics = isAnalyticPresent(filePath)
        print("Checking file : {:30} {}".format(filePath.split('/')[-1], "already present, pass" if hasAnalytics else "not present, adding it..."))

        if not hasAnalytics:
            addAnalytics(filePath)