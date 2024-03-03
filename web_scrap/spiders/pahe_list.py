import scrapy
import json

filename = "pahe.json"  # To save store data

class IntroSpider(scrapy.Spider):
    name = "pahe_spider"     # Name of the scraper

    start_urls = [
        'https://pahe.ink/category/tv-action/page/{x}/'.format(x=x) for x in range(1, 50)   # x denotes page number
    ]
    
    def parse(self, response):
        list_data=[]

        book_list = response.css('h2.post-box-title > a::text').getall()  # accessing the titles
        link_list = response.css('h2.post-box-title > a::attr(href)').getall()  # accessing the titles
        price_list = response.css('div.entry > p::text').getall()
        image_link = response.css('div.post-thumbnail > a > img::attr(src)').getall()  # accessing the titles

        i=0
        for book_title in book_list:
            data={
                'book_title' : book_title,
                'price' : price_list[i],
                'image-url' : image_link[i],
                'url' : link_list[i]
            }
            i+=1
            list_data.append(data)
            
        with open(filename, 'a+') as f:   # Writing data in the file
            for data in list_data : 
                app_json = json.dumps(data)
                f.write(app_json+"\n")