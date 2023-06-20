import requests
from bs4 import BeautifulSoup
from selenium import webdriver
proxies = {
  'http_proxy': 'http://est.rodrigo.fc:Rodrigo5778@proxycientifica.sesp.parana:8080',
  'https_proxy': 'http://est.rodrigo.fc:Rodrigo5778@proxycientifica.sesp.parana:8080'
}

response = requests.get('http://iishml01.pr.gov.br/SAC/GDL_IC_NET/Account/Login.aspx',proxies=proxies)

# Analisar o HTML da página usando BeautifulSoup
soup = BeautifulSoup(response.text, 'html.parser')
#csrf_token = soup.find('input', {'name': '_token'}).get('value') # pega o token
cookies = response.cookies #pega o cookies
print(cookies)
#csrf = soup.find('meta', {'name': 'csrf-token'}).get('content') # mesmo que o de cima porem pega da tag meta
#print(csrf)

login_data = {
    'email': 'ricardo.maia',
    'password': '123',
    #'_token': csrf,
    
    #'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36'
    # quaisquer outros parâmetros de autenticação necessários
}

response = requests.post('http://iishml01.pr.gov.br/SAC/GDL_IC_NET/Account/Login.aspx', data=login_data, cookies=cookies , proxies=proxies)
if response.status_code == 200 : # se der 200 entro na pagina
    print('sucesso na autenticação')
    #
    #pega a url apos o login bem sucedido
    #
    authenticated_url = response.url
    print(f"URL autenticada: {authenticated_url}")

    # Acessar outra página autenticada
 

    pagNext = requests.post("http://iishml01.pr.gov.br/SAC/GDL_IC_NET/REP/MinhasReps.aspx", cookies=response.cookies,proxies=proxies)
    print(pagNext.status_code)
    acessado=False
    if pagNext.status_code == 200 : # se der 200 entro na pagina
            acessado=True
            print('sucesso na next')
            authenticated = pagNext.url
            print(f"URL autenticada: {authenticated}")
            
            
            
            soup=BeautifulSoup(pagNext._content,'html.parser')

            
            print(soup.prettify())
    #
    #se a senha ou username nao confere ele retorna a pagina
    #
    if acessado == False:
        print('senha ou username errado')
else:
    #
    # solicitação falhou mostra o erro
    #
    print(f" erro:{response.status_code}")