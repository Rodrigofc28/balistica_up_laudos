
from playwright.sync_api import sync_playwright
import time



usuario = "leonel.junior"
senha = "PCP2025%"


links_acesso = []  # Lista para armazenar os links únicos
links_existentes = set()  # Conjunto para rastrear descrições únicas

with sync_playwright() as p:
    browser = p.chromium.launch(headless=True)
    page = browser.new_page(ignore_https_errors=True)

    # Acessa a página de login
    page.goto('https://iishml01.pr.gov.br/SAC/GDL_IC_NET/Account/Login.aspx')
    page.fill('input[name="ctl00$Content$txtUser"]', usuario)
    page.fill('input[name="ctl00$Content$txtPass"]', senha)
    page.press('input[name="ctl00$Content$txtPass"]', 'Enter')
    time.sleep(1)

    page.wait_for_load_state('load')
    page.click('input[name="ctl00$Content$ico_MyREPs"]')
    time.sleep(1)

    while True:
        try:
            # Procura pela tabela na página
            table = page.query_selector('table')
            rows = table.query_selector_all('tr')

            for row in rows:
                tds = row.query_selector_all('td')

                for i, td in enumerate(tds):  # i é o índice de cada td
                    if td.inner_text().strip() == 'EXAME DE EFICIÊNCIA E PRESTABILIDADE':

                        if i >= 6:  # Certifica-se de que há pelo menos 6 td atrás
                            td_to_check = tds[i - 6]

                            # Procura o <a> e <span> dentro do td
                            a_text = td_to_check.query_selector('a')
                            span_text = td_to_check.query_selector('span')

                            if a_text and span_text:  # Verifica se ambos existem
                                rep = span_text.inner_text().strip()
                                link = a_text.get_attribute('href')

                                # Adiciona ao JSON apenas se a descrição for única
                                if rep not in links_existentes:
                                    links_acesso.append({
                                        "description": rep,
                                        "link": link
                                    })
                                    links_existentes.add(rep)  # Marca como adicionado

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

# Retorna todos os links únicos encontrados como JSON
print(links_acesso)



