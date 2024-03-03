import scrapy
import json

filename = "movie.json"  # To save store data

class IntroSpider(scrapy.Spider):
    name = "movie_spider"     # Name of the scraper

    def start_requests(self):
        urls = [
            'https://www.yst.mx/browse-movies?page={x}.html'.format(x=x) for x in range(1, 50)   # x denotes page number
        ]

        for url in urls:
            yield scrapy.Request(url=url, callback=self.parse)
    
    def parse(self, response):
        list_data=[]

        title_list = response.css("div.browse-movie-wrap > div.browse-movie-bottom > a.browse-movie-title::text").getall()  #ganti title movie
        link_list = response.css("div.browse-movie-wrap > a.browse-movie-link::attr(href)").getall() #link movie
        year_list = response.css("div.browse-movie-wrap > div.browse-movie-bottom > div.browse-movie-year::text").getall()
        image_link = response.css("div.browse-movie-wrap > a.browse-movie-link > figure > img.img-responsive::attr(src)").getall()

        i=0;
        for book_title in title_list:
            data={
                'movie_list' : book_title,
                'year' : year_list[i],
                'image-url' : image_link[i],
                'url' : link_list[i]
            }
            i+=1
            list_data.append(data)
            
        with open(filename, 'a+') as f:   # Writing data in the file
            for data in list_data : 
                app_json = json.dumps(data)
                f.write(app_json+"\n")