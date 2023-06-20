from time import sleep 
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support import expected_conditions as ec
from selenium.webdriver.support.ui import WebDriverWait

def main():
    chrome_options = webdriver.ChromeOptions()
    # chrome_options.add_argument('--headless')
    driver = webdriver.Chrome(options=chrome_options)
    driver.get('http://iishml01.pr.gov.br/SAC/GDL_IC_NET/Account/Login.aspx')
    
    print("okgo:")
    version = WebDriverWait(driver, 30).until(ec.presence_of_element_located((By.XPATH, '//*[@id="main-content"]/div[4]/div[2]/div[2]/table/tbody/tr[1]/td'))).text
    print(version)
    print("--")
    sleep(555555)

if __name__ == '__main__':
    main()