#!/usr/bin/python
# -*- coding: utf-8 -*-
import os
import json
import codecs
import pandas as pd
import numpy as np
import matplotlib.pyplot as plt
import seaborn as sns
import itertools
import collections

import tweepy as tw
import nltk
from nltk.corpus import stopwords
import re
import networkx
from datetime import datetime, timedelta
import warnings
warnings.filterwarnings('ignore')

sns.set(font_scale=1.5)
sns.set_style('whitegrid')

#

consumer_key = 'on_twitter'
consumer_secret = 'on_twitter'
access_token = 'on_twitter'
access_token_secret = 'on_twitter'

#

auth = tw.OAuthHandler(consumer_key, consumer_secret)
auth.set_access_token(access_token, access_token_secret)
api = tw.API(auth, wait_on_rate_limit=True)

# search_term = "#climate+change -filter:retweets"
yesterday = datetime.strftime(datetime.now() - timedelta(1), '%Y-%m-%d');
search_term = \
    '(disease) -filter:retweets'
tweets = tw.Cursor(api.search, q=search_term, lang='en',
                   since=yesterday).items(1000)

all_tweets = [tweet.text for tweet in tweets]


#

def remove_url(txt):
    return ' '.join(re.sub("([^0-9A-Za-z \t])|(\w+:\/\/\S+)", '',
                    txt).split())


#

all_tweets_no_urls = [remove_url(tweet) for tweet in all_tweets]

#

words_in_tweet = [re.sub(r'[^a-zA-Z ]', '', tweet.lower()).split() for tweet in all_tweets_no_urls]

#
stop_words = set(stopwords.words('english'))
for all_words in words_in_tweet:
    for word in all_words:

        # remove stop words
# Remove stop words from each tweet list of words

        tweets_nsw = [[word for word in tweet_words if not word
                      in stop_words] for tweet_words in words_in_tweet]
print(tweets_nsw[0])
all_words_nsw = list(itertools.chain(*tweets_nsw))
counts_nsw = collections.Counter(all_words_nsw)
# array = np.array(list(counts_nsw.items()))
json.dump(counts_nsw.most_common(15), codecs.open('./data.json', 'w', encoding='utf-8'), separators=(',', ':'), sort_keys=True, indent=4) ### this saves the array in .json format