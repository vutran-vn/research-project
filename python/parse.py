import requests
import sys
import datetime
import glob
import filecmp
import os
from bs4 import BeautifulSoup

now = datetime.datetime.now().strftime("%Y-%m-%d-%H-%M-%S")

original = sys.stdout
f = open('%s.txt' % now, 'w')
sys.stdout = f

url_main = "http://www.serchen.co.uk"
url_browse = url_main + "/browse/"
url_category = url_main + "/category"

r = requests.get(url_browse)
soup = BeautifulSoup(r.content, "html.parser")
# First layer: list category urls, names and counting numbers
links = soup.find_all("li")
for link in links:
    try:
        # link.contents[0] = <a href="/category/workforce-management/">Workforce Management</a>
        if '/category/' in link.contents[0].get('href'):
            category_url = url_main + str(link.contents[0].get('href'))
            category_name = str(link.contents[0].text)
            count_number = str(link.contents[1].text)
            print (category_url, category_name, count_number)
    except:
        pass
sys.stdout = original
f.close()
# Detection of any updates in new categories
if len(glob.glob('./*[0-9]*.txt')) == 2:
    file_list = glob.glob('*[0-9]*.txt')

    print ('Comparing ' + file_list[0] + ' and ' + file_list[1] + ' ...')

    if filecmp.cmp(file_list[0], file_list[1]):
        print ('All the same. Exit!')
    else:
        print('Found difference! Updating...')

    print ('Deleting ' + file_list[0] + '...')
    os.remove(file_list[0])

# Second layer: List this category name, service urls, names, listed date, star and the number of reviews
# Third layer: list the category name, the service url on serchen.co.ul, the service official site, stars, detailed reviews, and the date of comments
