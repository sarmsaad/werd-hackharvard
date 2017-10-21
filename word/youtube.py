"""
Dealing with YouTube
"""
from youtube_dl import YoutubeDL
from pprint import pprint as print

ydl_opts = {
    "noplaylist": True,  # For now, we will separate playlist and singles later
    "writeautomaticsub": True
}


def extract_info(url):
    """
    Extract info from an url

    :param url:
    :return:
    """

    with YoutubeDL(ydl_opts) as ydl:
        info = ydl.extract_info(url, download=False)
    return info


if __name__ == '__main__':
    print(extract_info("https://www.youtube.com/watch?v=ZZyNwGD3XE0"))