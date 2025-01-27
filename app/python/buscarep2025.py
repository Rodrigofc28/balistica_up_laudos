
from playwright.sync_api import sync_playwright
import time
import mysql.connector
conexao = mysql.connector.connect(
        host='127.0.0.1',  # Ou o IP do servidor MySQL
        user='root',
        password='',
        database='policiacientifica'
    )
conexao.close()
usuario = "leonel.junior"
senha = "PCP2025%"


links_acesso = []  # Lista para armazenar os links únicos
links_existentes = set()  # Conjunto para rastrear descrições únicas


with sync_playwright() as p:
    browser = p.chromium.launch(headless=False)
    page = browser.new_page(ignore_https_errors=True)
    cidadeOrgao={}
    # Acessa a página de login
    page.goto('https://iishml01.pr.gov.br/SAC/GDL_IC_NET/Account/Login.aspx')
    page.fill('input[name="ctl00$Content$txtUser"]', usuario)
    page.fill('input[name="ctl00$Content$txtPass"]', senha)
    page.press('input[name="ctl00$Content$txtPass"]', 'Enter')
    time.sleep(1)
    page.wait_for_load_state('load')
    page.click('input[name="ctl00$Content$ico_MyREPs"]')
    time.sleep(5)
    while True:
        try:
            # Procura pela tabela na página
            table = page.query_selector('table')
            rows = table.query_selector_all('tr')

            for row in rows:
                tds = row.query_selector_all('td')

                for i, td in enumerate(tds):  # i é o índice de cada td
                    
                    if td.inner_text().strip() == 'EXAME DE EFICIÊNCIA E PRESTABILIDADE':
                        elemento_a = page.locator('xpath=//*[@id="Content_gridSearchMyRequests_lnkRep_2"]').click()
                        time.sleep(5)
                        select_origin = page.locator('xpath=//*[@id="Content_RepMain_ucOrigin_ddlCityOrigin"]')

                        # Todos os <option> do primeiro <select>
                        options_origin = select_origin.locator('option')
                        total_options_origin = options_origin.count()

                        for i in range(total_options_origin):
                            # Seleciona o item atual no primeiro <select>
                            option_value = options_origin.nth(i).get_attribute('value')
                            option_text = options_origin.nth(i).inner_text()
                            

                            # Seleciona o <option> no <select>
                            select_origin.select_option(value=option_value)

                            # Segundo <select> relacionado
                            select_related = page.locator('xpath=//*[@id="Content_RepMain_ucOrigin_ddlOrganOrigin"]')

                            # Captura todos os <option> do segundo <select>
                            options_related = select_related.locator('option')
                            page.wait_for_timeout(2000) 
                            total_options_related = options_related.count()
                            cidade = option_text
                            
                            for j in range(total_options_related):
                                related_option_value = options_related.nth(j).get_attribute('value')
                                related_option_text = options_related.nth(j).inner_text()
                                orgao = related_option_text
                                
                                cidadeOrgao['cidade']=cidade
                                cidadeOrgao['orgao']=orgao
                        print (cidadeOrgao)
            # Tenta navegar para a próxima página
            next_page_button = page.query_selector('input[name="ctl00$Content$rptPagingBottom$ctl03$imgNextPage"]')
            if next_page_button:
                next_page_button.click()
                time.sleep(1)  # Aguarda o carregamento da nova página
            else:
                break  # Sai do loop quando não há mais páginas

        except Exception as e:
            print(f"Erro durante a execução: {e}")
            break

    browser.close()
        

      
    

   

