import json
import re

import speech_recognition as sr

from youtube_dl import YoutubeDL
from youtube_dl.extractor.youtube import YoutubePlaylistIE

ytplie = YoutubePlaylistIE()

ydl_opts = {
    "writeautomaticsub": True,
    "allsubtitles": True,
    "ignoreerrors": True
}


def get_info(url):
    print("Getting info for {}".format(url))
    with YoutubeDL(ydl_opts) as ydl:
        info = ydl.extract_info(url, download=False)
        return info


def audio_urls_solo(info):
    """
    Extract the audio urls from the JSON blob that youtube_dl spits out
    :param info: The JSON blob that youtube_dl spits out

    """

    print(info)
    audio_tracks = [i for i in info['formats'] if i['format_note'] == "DASH audio"]
    print("Got {} tracks".format(len(audio_tracks)))
    # Todo: Convert this to named tuple
    x = [i['url'] for i in audio_tracks]
    return x[0]

# Todo: Merge this with the original extract method.
# There is no point to seperate this out.
# The only different of from the other extract method is that
# this doesn't have the extract playlist option.

def audio_urls_playlist(info):
    """
    Extract the audio urls from the JSON blob that youtube_dl spits out
    :param info: The JSON blob that youtube_dl spits out
    :return: A list of tuples (filesize, format_id, url, ext ) of audio urls sorted by filesize
    """

    urls_list = []
    for video in info['entries']:
        #if video['format_note'] == "DASH audio":
        #    return video.get('url')
        for i in range(len(video)):
            my_url = video.get('webpage_url')

        urls_list += [my_url]

    return urls_list

def extract_playlist(url):
    with YoutubeDL(ydl_opts) as ydl:
        info = ydl.extract_info(url, download=False)

    return info


def is_playlist(url):
    """
    Check if playlist
    :param url: Url from the user
    :return: playlist_id or False
    """
    match = re.match(ytplie._VALID_URL, url)
    if not match:
        return False
    #playlist_id = match.group(1) or match.group(2)
    return True


if __name__ == "__main__":
    # Test playlist download
    # This url has video id in it
    url1 = "https://www.youtube.com/watch?v=B_tjKYvEziI&list=PLOGi5-fAu8bFgbO_BDoWRGRSeEKu6ZvuB"


    info1 = extract_playlist(url1)
    #print(info1)


    retrieved_url = []
    audio_urls = []
    retrieved_url = audio_urls_playlist(info1)
    print('\n\n These are the separated URLs from a playlist\n\n')
    print(retrieved_url)
    print('\n')
    for i in range(len(retrieved_url)):
        info = extract_playlist(retrieved_url[i])
        audio_urls += [audio_urls_solo(info)]

    print(audio_urls)

    '''r = sr.Recognizer()
    for i in range(len(audio_urls)):
        audio = r.listen(audio_urls[i])
        print(r.recognize_google(audio))'''


