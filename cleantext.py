#!/usr/bin/env python

"""Clean comment text for easier parsing."""

from __future__ import print_function

import re
import string
import argparse
import sys
import json
import pprint as pp


__author__ = ""
__email__ = ""

# Some useful data.
_CONTRACTIONS = {
    "tis": "'tis",
    "aint": "ain't",
    "amnt": "amn't",
    "arent": "aren't",
    "cant": "can't",
    "couldve": "could've",
    "couldnt": "couldn't",
    "didnt": "didn't",
    "doesnt": "doesn't",
    "dont": "don't",
    "hadnt": "hadn't",
    "hasnt": "hasn't",
    "havent": "haven't",
    "hed": "he'd",
    "hell": "he'll",
    "hes": "he's",
    "howd": "how'd",
    "howll": "how'll",
    "hows": "how's",
    "id": "i'd",
    "ill": "i'll",
    "im": "i'm",
    "ive": "i've",
    "isnt": "isn't",
    "itd": "it'd",
    "itll": "it'll",
    "its": "it's",
    "mightnt": "mightn't",
    "mightve": "might've",
    "mustnt": "mustn't",
    "mustve": "must've",
    "neednt": "needn't",
    "oclock": "o'clock",
    "ol": "'ol",
    "oughtnt": "oughtn't",
    "shant": "shan't",
    "shed": "she'd",
    "shell": "she'll",
    "shes": "she's",
    "shouldve": "should've",
    "shouldnt": "shouldn't",
    "somebodys": "somebody's",
    "someones": "someone's",
    "somethings": "something's",
    "thatll": "that'll",
    "thats": "that's",
    "thatd": "that'd",
    "thered": "there'd",
    "therere": "there're",
    "theres": "there's",
    "theyd": "they'd",
    "theyll": "they'll",
    "theyre": "they're",
    "theyve": "they've",
    "wasnt": "wasn't",
    "wed": "we'd",
    "wedve": "wed've",
    "well": "we'll",
    "were": "we're",
    "weve": "we've",
    "werent": "weren't",
    "whatd": "what'd",
    "whatll": "what'll",
    "whatre": "what're",
    "whats": "what's",
    "whatve": "what've",
    "whens": "when's",
    "whered": "where'd",
    "wheres": "where's",
    "whereve": "where've",
    "whod": "who'd",
    "whodve": "whod've",
    "wholl": "who'll",
    "whore": "who're",
    "whos": "who's",
    "whove": "who've",
    "whyd": "why'd",
    "whyre": "why're",
    "whys": "why's",
    "wont": "won't",
    "wouldve": "would've",
    "wouldnt": "wouldn't",
    "yall": "y'all",
    "youd": "you'd",
    "youll": "you'll",
    "youre": "you're",
    "youve": "you've"
}

# You may need to write regular expressions.

def sanitize(text):
    # pass
    """Do parse the text in variable "text" according to the spec, and return
    a LIST containing FOUR strings 
    1. The parsed text.
    2. The unigrams
    3. The bigrams
    4. The trigrams
    """
    temp = text
    # 1. Replace new lines and tab characters with a single space.
    text = text.replace("\t", " ")
    text = text.replace("\n", " ")

    # 2. Remove URLs. Replace them with the empty string ''. URLs typically look like [some text](http://www.ucla.edu) in the JSON.

    # text = re.sub(r'^https?:\/\/.*[\r\n]*', '', text, flags=re.MULTILINE)

    # urls = re.findall(r'\[.*\]\(https?://\S*\s|\Z', text)
    # urls = re.findall(r'https?://\S*\s|\Z', text)
    # print (urls)
    text = re.sub(r'\[.*\]\(https?://\S*\s|\Z', '', text)
    text = re.sub(r'https?://\S*\s|\Z', '', text)

    punctuation = {',', '.', ';', '?', ':', '!', '"', '*'}
    # 3. Split text on a single space. If there are multiple contiguous spaces, you will need to remove empty tokens after doing the split.
    splitted_text = text.split()
    for index, word in enumerate(splitted_text):
        if word in _CONTRACTIONS.keys():
            splitted_text[index] = _CONTRACTIONS[word]

    # 4. Separate all external punctuation such as periods, commas, etc. into their own tokens (a token is a single piece of text with no spaces), but maintain punctuation within words (otherwise he'll gets parsed to hell and thirty-two gets parsed to thirtytwo). The phrase "The lazy fox, jumps over the lazy dog." should parse to "the lazy fox , jumps over the lazy dog ."
    for index, word in enumerate(splitted_text):

        # if len(word) > 3 and word[-3:] == '...':
        #     word1, word2 = word[:-3], word[-3:]
        #     splitted_text[index] = word1
        #     splitted_text.insert(index+1, word2)

        # elif word[-1] in punctuation and len(word) > 1 and word[0] not in punctuation:
        #     word1, word2 = word[:-1], word[-1]
        #     splitted_text[index] = word1
        #     splitted_text.insert(index+1, word2)
        # print(index)
        # print(word)
        # print(len(splitted_text))
        for i, char in enumerate(word):
            if char in punctuation:
                if i == 0:
                    word1 = char
                    word2 = word[1:]
                else:
                    word1, word2 = word[:i], word[i:]
                splitted_text[index] = word1
                if word2 != '':
                    splitted_text.insert(index+1, word2)

                break



    # 5. Remove all punctuation (including special characters that are not technically punctuation) except punctuation that ends a phrase or sentence and except embedded punctuation (so thirty-two remains intact). Common punctuation for ending sentences are the period (.), exclamation point (!), question mark (?). Common punctuation for ending phrases are the comma (,), semicolon (;), colon (:). While quotation marks and parentheses also start and end phrases, we will ignore them as it can get complicated. We can also RRR's favorite em-dash (--) as it varies (two hyphens, one hyphen, one dash, two dashes or an em-dash).


    # 6. Convert all text to lowercase.
    text = text.lower()
    # 7. The order of these operations matters, but you are free to experiment and you may get the same results.

    parsed_text = " ".join(splitted_text)

    # puarsed text
    # new_str = ""
    # for splitted in splitted_text:
    #     new_str = new_str + splitted + " "
    # parsed_text = new_str[:-1]

    # unigrams
    new_str = ""
    for splitted in splitted_text:
        if not splitted in punctuation: 
            new_str = new_str + splitted + " "
    unigrams = new_str[:-1]


    # bigrams
    new_str = ""
    for i in range( len(splitted_text) -1):
        if (not splitted_text[i] in punctuation) and (not splitted_text[i+1] in punctuation):
            new_str = new_str + splitted_text[i] + "_" + splitted_text[i+1] + " "
    bigrams = new_str[:-1]

    # trigrams
    new_str = ""
    for i in range( len(splitted_text) -2):
        if (not splitted_text[i] in punctuation) and (not splitted_text[i+1] in punctuation) and (not splitted_text[i+2] in [',', '.', ';', '?', ':', '!', '...']):
            new_str = new_str + splitted_text[i] + "_" + splitted_text[i+1] + "_" + splitted_text[i+2] + " "
    trigrams = new_str[:-1]

    print (temp, '\n', parsed_text,'\n', unigrams,'\n', bigrams,'\n', trigrams, '\n')

if __name__ == "__main__":
    filename = sys.argv[1]
    print (filename)

    lines_to_read = 100

    with open(filename) as fp:
        for _ in range(lines_to_read):
            line = fp.readline()
            content = json.loads(line)
            comment = content['body']

            sanitize(comment)
            # print()
            # pp.pprint(comment)

    # This is the Python main function.
    # You should be able to run
    # python cleantext.py <filename>
    # and this "main" function will open the file,
    # read it line by line, extract the proper value from the JSON,
    # pass to "sanitize" and print the result as a list.

    # YOUR CODE GOES BELOW.
