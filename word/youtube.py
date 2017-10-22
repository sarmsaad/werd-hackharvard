"""
Dealing with YouTube
"""
from youtube_dl import YoutubeDL

ydl_opts = {
    "noplaylist": True,  # For now, we will separate playlist and singles later
    "writeautomaticsub": True,
    "allsubtitles": True
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


def extract_playlist(url):
    """
    Extract the whole playlist at once

    :param url: playlist url
    :return:
    """

    with YoutubeDL(ydl_opts) as ydl:
        info = ydl.extract_info(url, download=False)
    return info


if __name__ == '__main__':
    # print(extract_info("https://www.youtube.com/watch?v=ZZyNwGD3XE0"))
    # print(extract_info("https://www.youtube.com/watch?v=lekCh_i32iE"))

    pass
