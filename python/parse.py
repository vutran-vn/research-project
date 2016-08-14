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
##########################################################################################################################################
# First layer:  http://www.serchen.co.uk/browse/
# Purpose:  List all category urls, names and counting numbers
##########################################################################################################################################
links = soup.find_all("li")
for link in links:
    try:
        # link.contents[0] = <a href="/category/workforce-management/">Workforce Management</a>
        if '/category/' in link.contents[0].get('href'):
            category_url = url_main + str(link.contents[0].get('href'))
            category_name = str(link.contents[0].text)
            count_number = str(link.contents[1].text)
            print (category_url + ',' + category_name + ',' +count_number)
    except:
        pass
sys.stdout = original
f.close()
# Detection of any updates in new categories. (330 categories. 14 Aug 2016)
if len(glob.glob('*[0-9]*.txt')) == 2:
    file_list = glob.glob('*[0-9]*.txt')

    print ('Comparing ' + file_list[0] + ' and ' + file_list[1] + ' ...')

    if filecmp.cmp(file_list[0], file_list[1]):
        print ('All the same. Exit!')
    else:
        file_old = open(file_list[0])
        file_new = open(file_list[1])

        file_old_line = file_old.readline().rstrip('\n')
        file_new_line = file_new.readline().rstrip('\n')
        line_no = 1
        print('Found difference! Updating ...')
        # Loop if either file_old or file_new has not reached EOF
        while file_old_line != '' or file_new_line != '':
                # Compare the lines from both file
                if file_old_line != file_new_line:
                    # If a line does not exist on file_new then mark the output with + sign
                    if file_new_line != '' and file_new_line == '':
                        print (">+", "Line-%d" % line_no, file_old_line)
                    # otherwise output the line on file_old and mark it with > sign
                    elif file_old_line != '':
                        print(">", "Line-%d" % line_no, file_old_line)
                    # If a line does not exist on file_old then mark the output with + sign
                    if file_old_line == '' and file_new_line != '':
                        print (">+", "Line-%d" % line_no, file_new_line)
                    # otherwise output the line on file_old and mark it with > sign
                    elif file_new_line != '':
                        print(">", "Line-%d" % line_no, file_new_line)
                file_old_line = file_old.readline().rstrip('\n')
                file_new_line = file_new.readline().rstrip('\n')
                line_no += 1
        file_old.close()
        file_new.close()
    print ('Deleting ' + file_list[0] + '...')
    os.remove(file_list[0])

##########################################################################################################################################
# Second layer: e.g. http://www.serchen.co.uk/category/appointments-scheduling/
# Purpose:  List this category name, service urls, names, listed date, star and the number of reviews
##########################################################################################################################################
print ('Second layer scanning ...')
latest_category_list_file = glob.glob('*[0-9]*.txt')[0]

#with open(latest_category_list_file) as f:
#    for line in f:
#        latest_category_url = line.split(',')[0].rstrip('\n')
#        latest_category_name = line.split(',')[1].rstrip('\n')
#        print ('Entering ' + latest_category_url + ' ...')
#        r_category = requests.get(latest_category_url)
#        soup = BeautifulSoup(r_category.content, "html.parser")

# Test with single category website
latest_category_url = 'http://www.serchen.co.uk/category/appointments-scheduling/'
r_category = requests.get(latest_category_url)
soup = BeautifulSoup(r_category.content, "html.parser")
# "campany-tile" needs to be detected dynamically in the future.
links = soup.find_all("div", {"class": "company-tile"})
for link in links:
    try:
        # Not the official website here.
        company_url_at_serchen = url_main + link.contents[0].get('href')
        ##########################################################################################################################################
        # Third layer:  e.g. http://www.serchen.co.uk/company/3sixtylite/
        # Purpose:  List the category name, the service url on serchen.co.uk, url, the service official site, stars, detailed reviews, and the date of comments
        ##########################################################################################################################################
        print ('Entering ' + company_url_at_serchen + ' ...')
        # Test with single company website
        r_company = requests.get('http://www.serchen.co.uk/company/bookingbug/')
        #r_company = requests.get(company_url_at_serchen)
        soup = BeautifulSoup(r_company.content, "html.parser")
        links = soup.find_all("div", {"itemscope": "itemtype"})
        for link in links:
            try:
                print (link)
            except:
                pass
    except:
        pass

# review
# soup.find_all("p", {"class": "review-text"})[0].text, soup.find_all("p", {"class": "review-text"})[1].text ...
