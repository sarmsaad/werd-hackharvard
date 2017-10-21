"""
Parse and manage the Youtube caption

"""

import pysrt
import requests

from word.db import insert
from word.dictionary import Sentence
from word.youtube import extract_info


class Transcript:
    def __init__(self, video_info):
        """
        :param video_info: The video info dump from youtube_dl
        """

        self.video_info = video_info
        self.video_id = self.video_info["id"]
        self.subtitle = self.parse_caption()

    def parse_caption(self, lang="en"):
        if not self.video_info.get("automatic_captions"):
            # When we don't have the caption
            return

        captions = self.video_info.get("automatic_captions")

        caption_tracks = captions[lang]

        url = None
        subtitle = None

        for track in caption_tracks:
            if track["ext"] == "vtt":
                url = track["url"]
        if url:
            r = requests.get(url)
            if r.status_code == 200:
                subtitle = r.text
        if subtitle:
            s = pysrt.from_string(subtitle)
            self.subtitle = s
        return self.subtitle

    def print_subtitle(self):
        for s in self.subtitle:
            print("{} -> {}: {}".format(s.start, s.end, s.text))

    def analyse(self):
        """
        Put all sentences of the subtitle to our nltk pipeline

        :return:
        """

        for s in self.subtitle:
            ss = Sentence(s.text, self.video_id)
            ss.store()
            ss.store_words()

    def to_dict(self):
        return [{
            "start": s.start.to_time().isoformat(),
            "end": s.end.to_time().isoformat(),
            "text": s.text,
        } for s in self.subtitle]

    def store_subtitle(self):
        insert(kind="subtitle", data={
            "video_id": self.video_id,
            "video_info": video_info,
            "sentences": self.to_dict()
        })


if __name__ == '__main__':
    video_info = extract_info("https://www.youtube.com/watch?v=ZZyNwGD3XE0")
    tr = Transcript(video_info)
    tr.print_subtitle()
    tr.store_subtitle()
    tr.analyse()
