__author__ = 'Wong Tzuchiang'
import requests
import re
from bs4 import BeautifulSoup

s=requests.session()
proxies={"http":"http://user:password@hk1.nhpass.com:110"}
html=s.get("http://teamtreehouse.com/library/type:course",proxies=proxies).text

match_all=re.compile(r'<li class="card course syllabus [\s\S]*?<a class="title" href="/library/(.*)">[\s\S]*?<h3>(.*?)</h3>')
match_track_index=re.compile(r'<a class="button secondary" href="(.*)">Explore</a>')
match_track_detail=re.compile(r'<a href="/library/(.*)">[\s\S]{0,70}?<span class="lesson-progress " title="Stages Completed">')
array_all=[]
array_track=[]
result_all=match_all.findall(html)

for i in range(len(result_all)):#获取所有课程列表
    array_all.append(result_all[i][0])

html=s.get("http://teamtreehouse.com/tracks",proxies=proxies).text
result_track_index=match_track_index.findall(html)
for i in range (len(result_track_index)):#获取系列课程列表
    url_track_index="http://teamtreehouse.com"+result_track_index[i]
    print(url_track_index)
    html=s.get(url_track_index,proxies=proxies).text
    #print(html)
    result_track_detail=match_track_detail.findall(html)
    for j in range(len(result_track_detail)):
        array_track.append(result_track_detail[j])

print(array_track)

for i in range (len(array_track)):#排除
    print(i)
    for j in range (len(array_all)):
        if(array_track[i]==array_all[j]):
            array_all.pop(j)
            break


print(array_all)
