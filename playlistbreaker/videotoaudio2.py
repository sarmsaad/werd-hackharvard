import re

from youtube_dl import YoutubeDL
from youtube_dl.extractor.youtube import YoutubePlaylistIE

ydl_opts = {
    'ignoreerrors': True,
    'quiet': True
}

def extract_playlist(url):

    #input_file = open("https://www.youtube.com/watch?v=RD0xvSuzReI&list=PL8C493B2C62C1BE31")
    for playlist in url:
        with YoutubeDL(ydl_opts) as ydl:
            playlist_dict = ydl.extract_info(playlist, download=False)
            for video in playlist_dict['entries']:
                print()
                if not video:
                    print('ERROR: Unable to get info. Continuing...')
                    continue
                for property in ['thumbnail', 'id', 'title', 'description', 'duration']:
                    print(property, '--', video.get(property))


if __name__ == "__main__":
    # Test playlist download
    # This url has video id in it
    url1 = "https://www.youtube.com/watch?v=RD0xvSuzReI&list=PL8C493B2C62C1BE31"

    #print(is_playlist(url1))
    #hi = get_info(url1)
    #print(hi)
    extract_playlist(url1)