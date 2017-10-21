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
from word.db import insert
from nltk import SnowballStemmer, tokenize

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

    def store(self):
        """
        Store the sentence into database.

        """
        insert(kind="sen", data=self.to_dict())

    def to_dict(self):
        """
        Represent ourself as dict
        :return: dict representation of this object
        :rtype: dict
        """

        return {
            "kind": "Sentence",
            "video_id": self.video_id,
            "text": self.text
        }

    def tokenise(self):
        """
        Split sentence into words.

        :return: list of tokens (words)
        :rtype: list
        """

        # Lowercase everything
        text = self.text.lower()




if __name__ == '__main__':
    test_sent = Sentence("The quick brown fox jumps over the lazy dog.", "test")
    print(test_sent.to_dict())
