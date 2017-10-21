"""
Provide interface to process, lookup, and manage (?) words

**Process**
- The first major goal is to be able to process the transcript that we garthered from the audio files of YouTube
video. We going to achieve this by tokenising all the text.
- After we have tokenise all the text, we would create a dictionary of all the words that we found.

**Lookup**
- This is different from the API for the interface of our project. This is for providing the dictionary functionality
of our project.
"""
import string

from pprint import pprint as print

from nltk import RegexpTokenizer

from word.db import insert, db

from nltk.tokenize import word_tokenize

PUNC = string.punctuation


class Sentence:
    """
    Wrapper for a sentence or a long run of text.
    """

    def __init__(self, text, video_id):
        """
        Create a new Sentence instance

        :param str text: the string of text
        :param str video_id: the video id of the video that the text came from
        """


        self.text = text
        self.video_id = video_id
        self.tokens = self.tokenise()
        self.word_count = self.count_token()

    def store(self):
        """
        Store the sentence into database.

        """
        return insert(kind="sen", data=self.to_dict())

    def to_dict(self):
        """
        Represent ourself as dict
        :return: dict representation of this object
        :rtype: dict
        """

        return {
            "kind": "Sentence",
            "video_id": self.video_id,
            "text": self.text,
            "tokens": self.tokens,
            "word_count": self.word_count
        }

    def tokenise(self):
        """
        Split sentence into words.

        :return: list of tokens (words)
        :rtype: list
        """

        # Lowercase everything
        text = self.text.lower()
        tokenizer = RegexpTokenizer(r'\w+')
        # Tokenise text into words
        tokens = tokenizer.tokenize(text)

        # Remove all punctuations
        tokens = [token for token in tokens if token not in PUNC]

        self.tokens = tokens
        return self.tokens

    def count_token(self):
        """
        Count the words in the sentence's tokens

        :return: word count
        :rtype: dict
        """

        # Make sure we have a list of tokens
        if not self.tokens:
            self.tokens = self.tokenise()

        wc = {w: self.tokens.count(w) for w in set(self.tokens)}

        self.word_count = wc
        return self.word_count

    def store_words(self):
        for token in self.tokens:
            w = Word(token, self.video_id)
            w.upsert()


class Word:
    def __init__(self, word, video_id):
        self.word = word
        self.video_id = video_id

    def upsert(self):
        """
        Update the word or insert the word into the database

        :return:
        """

        wrdb = db["words"].find_one({"_id": self.word})
        if wrdb:
            if self.video_id not in wrdb["videoIds"]:
                # The word currently exist in the database
                wrdb["videoIds"].append(self.video_id)
                wrdb["videoId"] = ",".join(wrdb["videoIds"])
                return insert(kind="words", data=wrdb, key=self.word, mode="upsert")
        else:
            wrdb = {
                "_id": self.word,
                "videoIds": [self.video_id],
                "videoId": ",".join([self.video_id]),
            }
            return insert(kind="words", data=wrdb)


if __name__ == '__main__':
    # test_sent = Sentence("The quick brown fox jumps over the lazy dog.", "test")
    # print(test_sent.to_dict())
    # print(test_sent.store())
    test_word = Word("genuine", "testvideoid")
    test_word2 = Word("genuine", "video_id3")
    test_word3 = Word("genuine", "video_id4")
    print(test_word.upsert())
    print(test_word2.upsert())
    print(test_word3.upsert())
