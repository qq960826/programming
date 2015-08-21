__author__ = 'Wong Tzuchiang'
import requests
import re
import threading
import os
import time

download_name=[ 'genesis-theme-development', 'django-basics', 'animating-svg-with-css', 'scrum-basics', 'seo-for-wordpress', 'build-a-blog-with-jekyll-and-github-pages', 'mailchimp-api', 'google-play-services', 'responsive-images', 'data-science-basics', 'css-to-sass', 'wordpress-settings-api', 'd3js', 'sketch-basics', 'build-a-rails-api', 'nested-crud-with-laravel-4', 'css-beyond-the-basics', 'php-testing', 'svg-basics', 'angularjs', 'php-standards-and-best-practices', 'emberjs', 'ecommerce-with-wordpress-and-woocommerce', 'genesis-framework-foundations', 'researching-user-needs', 'web-typography', 'moving-from-wordpresscom-to-selfhosted-wordpressorg', 'modular-css-with-sass', 'advanced-sass', 'laravel-basics', 'polishing-ruby-on-rails', 'blank-slates-in-ruby-on-rails', 'ruby-on-rails-forms', 'rails-partials-and-helpers', 'build-a-game-with-sprite-kit', 'the-rails-asset-pipeline-and-styling', 'rails-layouts-and-css-frameworks', 'soft-skills', 'mobile-game-design', 'compass-basics', 'ios-tools', 'how-to-write-a-business-plan', 'learn-buddypress-social-networks-with-wordpress', 'great-wordpresscom-websites', 'mobile-app-design-for-ios', 'framework-basics', 'using-php-with-mysql', 'technology-foundations', 'how-to-freelance', 'html-email-design', 'ruby-foundations', 'website-basics', 'aesthetic-foundations', 'html', 'usability-foundations', 'copyright-basics', 'css-foundations', 'advanced-social-features-in-ruby-on-rails', 'how-to-build-your-business-through-blogging', 'careers-foundations', 'enhancing-a-simple-php-application', 'how-to-run-a-web-design-business', 'building-social-features-in-ruby-on-rails', 'build-a-simple-php-application', 'build-a-simple-ruby-on-rails-application']
print(len(download_name))
list=64

global jishu2




http_agent='http://user:password@hk2.nhpass.com:110'
proxies = {'http':http_agent,'https':http_agent,}


http_agent_backup='http://user:password@hk2.nhpass.com:110'
proxies_backup = {'http':http_agent,'https':http_agent,}
#以上设置HTTP代理，进行下载

class DownloadThread(threading.Thread):#下载的线程

    def __init__(self,canshu_url,canshu_flodoer,canshu_name,canshu_proxy):
        threading.Thread.__init__(self)
        self.url=canshu_url
        self.flodoer=canshu_flodoer
        self.name=canshu_name
        self.proxy=canshu_proxy
    def run(self):
        global jishu2
        print("start downloading "+self.name)
        path1=self.flodoer+"\\"+self.name
        path1=path1.encode("GBK", 'ignore');




        r = requests.get(self.url, proxies=self.proxy)
        with open(path1, "wb") as code:
            code.write(r.content)
            jishu2=jishu2+1
            print("downloading "+self.name+" successfully")

match_name=re.compile(r'<meta property="name" content="(.*)" />')
match_index = re.compile( r'<li>[\s\S]{1,10}<a [class="completed" ]{0,20}href="(/library/.*?)">[\s\S]{1,60}<span class="icon icon-video"></span>[\s\S]*?<p>[\s\S]*?</p>[\s\S]*?<strong>([\s\S]*?)</strong>[\s\S]*?</a></li>')
match_download=re.compile( r'" type="video/webm" /><source src="(https://videos.teamtreehouse.com/videos/([\s\S]{0,60}?)\?token=[\s\S]{0,60}?)" type="video/mp4" /><track kind="subtitles" src="([\s\S]{0,60}?)" srclang="en" /></video>')
match_subtitle=re.compile(r'attachment; filename="([\s\S]*?)"' )
match_appendix=re.compile(r'<a class="button-reveal" href="([\s\S]*)" title="Download">' )
s = requests.session()
s.headers["Cookie"] = "_treehouse_session=b1Z6QmEyeHVaSjBZYy92aWtlWExYMDZJOE9rQktKTjEwa2dhT0hsMENncU4rRHJjc0sra0ZidnhSU1RHNkdYQnhONWxXcGhRTG9aR0ZBbFhuRERrbkFjbHN5QjVJNmIwTkZhaUZwdmVTL1JZMnBkZ3NhV3E1Y29PNkUzQVdXZTRVa1VDOXc1bDV3WGV0NU4xQS9WVEpRRlFOenZGV2pvTjNYOTZQRXRFNTh6TE1nelV1Y2RCUThBczdmb3hhRURuQ2Q5dlBXQVFINjUyYUl2N3hSQTdvRzJlL1Fybkg4bVl2amg4MmNCNDRpbDJjK2VOWTBwbCtsRlBiN05Rbm1Wdkxoc3IwK1ljTWE1M3FBdTYyYzlCSlEzaXJ3Zkd5UHRYMXRYYnBYMERUb3JyYXJIU1UzNGhJZGdQVFBHSGlaYXB2blFjUklxajVabWNQMG03U0ZvZkl2V3QxZ1lJNFcvd3Ntd0JKNEZGaFJuMVM1aXV2bVNDMTRIQk1kQTVDYXI1RzNOVitQT0tlTkJtUVFkazdiOUtYYWpFbVNFdnE2MUhYTVhCRjliaFd1N0FmNWZDa0ZjZUdYRkhOYXFjcDM0ZS0tZUg0MWN5aGN2YkJudUZQQkhGTDR0dz09--4158435b72e736e2ed84dee1443cb88c0859858e; path=/; HttpOnly"
#设置cookies，免登录操作



for k in range(len(download_name)):
    list=list+1
    html = s.get("http://teamtreehouse.com/library/"+download_name[list], proxies=proxies).text
    Result_name=match_name.findall(html)
    strinfo = re.compile(r':')
    saving_name_floder_local="E:\编程资料_国外_散\\"+str(list)+"."+strinfo.sub("",Result_name[0])+"\\"

    Result_index=match_index.findall(html)
    print ("parent location:"+str(list))
    jishu2=0
    jishu1=0#保证一个任务完成后才能进入下一个任务


    for i in range(len(Result_index)):

        url_index="http://teamtreehouse.com"+Result_index[i][0]
        html = s.get(url_index, proxies=proxies).text
        Result_download=match_download.findall(html)
        Result_appendix=match_appendix.findall(html)

        url_download_mp4=Result_download[0][0]
        url_download_subtitle="http://teamtreehouse.com"+Result_download[0][2]

        if(Result_appendix):
                url_download_appendix=Result_appendix[0]

        r=s.get(url_download_subtitle, proxies=proxies,stream=True )
        Result_subtitle=match_subtitle.findall(r.headers["content-disposition"])



        saving_name_floder=Result_index[i][1]
        saving_name_floder=saving_name_floder.strip()
        saving_name_mp4=Result_download[0][1]
        saving_name_subtitle=Result_subtitle[0]
        if(Result_appendix):

          saving_name_appendix=url_download_appendix[url_download_appendix.rfind('/') + 1:]
        strinfo = re.compile(r':')
        saving_name_floder=strinfo.sub('',saving_name_floder)
        saving_name_subtitle=strinfo.sub('',saving_name_subtitle)
        strinfo = re.compile(r'/')
        saving_name_floder=strinfo.sub('slash',saving_name_floder)
        saving_name_mp4=strinfo.sub('slash',saving_name_mp4)
        saving_name_subtitle=strinfo.sub('slash',saving_name_subtitle)
        strinfo = re.compile(r'"')
        saving_name_floder=strinfo.sub('slash',saving_name_floder)
        saving_name_mp4=strinfo.sub('slash',saving_name_mp4)
        saving_name_subtitle=strinfo.sub('slash',saving_name_subtitle)


        path=saving_name_floder_local+str(i)+"."+saving_name_floder

        strinfo = re.compile(r'\?')

        path = strinfo.sub('',path)
        saving_name_subtitle= strinfo.sub('',saving_name_subtitle)
        a=1#不断切换代理的时候使用
        #print( path)
        if(os.path.exists(path)==False):
            os.makedirs(path)

        if(os.path.isfile(path+"\\"+saving_name_mp4)==False):

            jishu1=jishu1+1
            #rint(url_download_mp4)
            if(a==1):
                thread=DownloadThread(url_download_mp4,path,saving_name_mp4,proxies)
                thread.start()
                a=0
            elif(a==0) :
                thread=DownloadThread(url_download_mp4,path,saving_name_mp4,proxies_backup)
                thread.start()
                a=1


        if(os.path.isfile(path+"\\"+saving_name_subtitle)==False):
            jishu1=jishu1+1
            thread=DownloadThread(url_download_subtitle,path,saving_name_subtitle,proxies)
            thread.start()





        if(Result_appendix):
                if(os.path.isfile(path+"\\"+saving_name_appendix)==False):
                    jishu1=jishu1+1
                    #print(saving_name_appendix)
                    thread=DownloadThread(url_download_appendix,path,saving_name_appendix,proxies)
                    thread.start()

    while(jishu1!=jishu2):
        time.sleep(3)
