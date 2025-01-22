


import base64
import subprocess
import time 
import requests
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.chrome.options import Options
from bs4 import BeautifulSoup
from webdriver_manager.chrome import ChromeDriverManager
import sys
import json
import mysql.connector
import datetime
import re

conn = mysql.connector.connect(
host="127.0.0.1",
user="root",
password="",
database="policiacientifica")

cursor = conn.cursor()
    

#parametros passados
#args = sys.argv[1:] 
#arg_count = len(args) 
#password = sys.argv[1]
#usuario = sys.argv[2]

#data = sys.argv[3] if arg_count == 3 else None 
#conectando ao banco

cursor.execute("SELECT userGDL,senhaGDL FROM users") 
results = cursor.fetchall()
#print(results[2][0])
#sys.exit() 
options = webdriver.ChromeOptions()
#options.add_argument('--headless')
#instala a versão que esta instalado no pc(navegador)
driver = webdriver.Chrome(ChromeDriverManager().install(), options=options)

options.add_argument('--headless')

#driver = webdriver.Chrome(options=options)
for listMsl in results:
    conn = mysql.connector.connect(
    host="127.0.0.1",
    user="root",
    password="",
    database="policiacientifica")

    cursor = conn.cursor()
    try:
        if  listMsl[0] != None:
            try:
                decrypted = decrypt_password(listMsl[1], 'JtKS')
            except:
                decrypted = 'sem valor'
            print(decrypted)   
            password ='PCP2025%' #listMsl[1]
            usuario = 'leonel.junior'#listMsl[0]
            options = webdriver.ChromeOptions()
#options.add_argument('--headless')
#instala a versão que esta instalado no pc(navegador)
            driver = webdriver.Chrome(ChromeDriverManager().install(), options=options)
            # Inicia o driver do Chrome com a opção '--headless' para iniciar o servidor do Selenium em segundo plano
            #options = webdriver.ChromeOptions()
            #options.add_argument('--headless')

            #driver = webdriver.Chrome(options=options)

            # Abre o navegador e navega para a página do GDL e faz o login
            driver.get('http://iishml01.pr.gov.br/SAC/GDL_IC_NET/Account/Login.aspx')#http://www.gdl.sesp.parana/SAC/GDL_IC_NET/Account/Login.aspx

            perito=usuario
            senhaPerito=password
            username=driver.find_element(By.ID, 'Content_txtUser')

            username.send_keys(perito)
            senha=driver.find_element(By.ID,'Content_txtPass')
            senha.send_keys(senhaPerito)
            loga=driver.find_element(By.ID,'Content_btnLogin')
            loga.click()

            #Abre a minhas Requisições e rpocura por exame de confronto balistico
            abriRep=driver.find_element(By.ID,'Content_ico_MyREPs')
            abriRep.click()
            html=driver.page_source
            soup=BeautifulSoup(html,'html.parser')
            time.sleep(10)
            #sys.exit() para o codigo
            tabela=soup.find('table',{'id':'Content_gridSearchMyRequests'})
            armazena=[]
            armazenaENV=[]

            listEnvolvido=[]
            #
            #percorre verifica todas as td procurando por EXAME DE CONFRONTO BALÍSTICO, data igual ao parametro passado se for entra na rep
            #

            def percorre(tabela):
                repComp=""
                numBO=""
                orgao=""
                unidade=""
                numOficio=""
                for celula in tabela.find_all('td'):
                    #recupera o id da linha correspondente 
                    
                    if "EXAME DE EFICIÊNCIA E PRESTABILIDADE" in celula:
                        
                        tr = celula.find_parent('tr')
                        envolvidos=tr.find_all('span')
                        for envolvido in envolvidos:
                            listEnvolvido.append(envolvido.text)
                        
                        
                        
                        rep=tr.find('span')
                        rep=rep.text
                        """ for spa in envolvido:
                            sd=str(spa.text)

                            armazenaENV.append(sd) """
                            
                        
                        
                        link = tr.find_all('a')
                        texto = tr.find_all('td')
                        data_designacao = texto[6].text[:10]
                    #verifica a data
                        
                    # if data is not None:
                        #    dat=data.replace("-","/")
                        #else:
                        #   dat="ok"
                        #if dat == texto[6].text[:10] or dat=="ok" : 
                        #titulos=link.attrs(['title'])
                            
                        for links in link:
                                #ENTRA NA REP
                                if links.get('title') == "Visualizar a REP":
                                    #armazenaEFP.append(links.text) #texto da rep
                                    id=links.get('id')
                                    sclick=driver.find_element(By.ID,id)
                                    sclick.click()
                                    paginaAlvo=driver.page_source
                                    soup=BeautifulSoup(paginaAlvo,'html.parser')

                                    #time.sleep(15)
                                    #print(soup)
                                    tabelaListaEnvolvidos=soup.find('table',{'id':'Content_RepMain_ucInvolved_gridInvolved'})
                                    tdEnvolvidos=tabelaListaEnvolvidos.find_all('td')
                                    gt=[]
                                    #pegando os envolvidos e armazenando no gt
                                    for tdenvolve in tdEnvolvidos:
                                        tdenvolve=tdenvolve.text.replace("\n","")

                                        
                                        
                                        gt.append(tdenvolve)
                                    
                                    
                                    tabelaListaOrigens=soup.find('table',{'id':'Content_RepMain_ucOrigin_gridOrigin'})
                                    td=tabelaListaOrigens.find_all('td')
                                    
            # Imprimindo a URL atual
                                    pagAdicional=driver.find_element(By.ID,'tabAddicionalInfo')
                                    pagAdicional.click()
                                    
                                    paginaAdc=driver.page_source
                                    soupPagAdc=BeautifulSoup(paginaAdc,'html.parser')
                                    tableAdc=soupPagAdc.find('table',{'id':'Content_RepMain_dtLog'})
                                    span=tableAdc.find_all('span')
                                    
                                    data_recebimento = 'NDA'
                                    for spn in span:
                                        
                                        
                                        if "Material entregue" in spn.text[0:17]:
                                            
                                            data_recebimento=spn.text[29:40]
                                            print(data_recebimento)
                                            
                                          
                                    pagAdicionalfecha=driver.find_element(By.ID,'Content_RepMain_lblTabsTitle')
                                    
                                    pagAdicionalfecha.click()
                                    # print(rep, dataSoli, data_recebimento, orga, cidade, unidade, oficio, ip, json_data, usuario,bo,data_designacao,ipOn,ipPm,boc,orgaOn,orgaPm,orgaOc,cidadeOn,cidadePm,cidadeOc,ipAi,orgaAi,cidadeAi,cidadeBo,orgaBo)
                                    orgaBo="NDA"
                                    ipOn="NDA"
                                    ipPm="NDA"
                                    boc="NDA"
                                    orgaOn="NDA"
                                    orgaPm="NDA"
                                    orgaOc="NDA"
                                    cidadeOn="NDA"
                                    cidadePm="NDA"
                                    cidadeOc="NDA"
                                    ipAi="NDA"
                                    orgaAi="NDA"
                                    cidadeAi="NDA"
                                    cidadeBo="NDA"                                  
                                    bo="NDA"
                                    ip="NDA"
                                    orgao="NDA"
                                    cidade="NDA"
                                    dataSoli="NDA"
                                    if "NDA" in data_recebimento:
                                        data_recebimento="NDA"
                                    
                                    
                                    oficio="NDA"
                                    orga="NDA"
                                    
                                    unidade="NDA"
                                    json_data="NDA"
                                    
                                    for tds in td:
                                        #ai e bo foi colocado não via migrate, adicionado direto no banco
                                            if re.search(r'(?<![^\s])AI(?![^\s])', tds.text):
                                                ipAi = tds.find_next_sibling('td').text.split()
                                                ipAi=str(ipAi)
                                                ipAi=ipAi.replace(",","").replace("\'","").replace("[","").replace("]","")
                                                orgaoAi=tds.find_next_sibling('td').find_next_sibling('td').find_next_sibling('td').find_next_sibling('td').text
                                                orgaoAi=str(orgaoAi)
                                                orgaAi=orgaoAi.replace("\n","").replace("\'","").replace("[","").replace("]","")
                                                cidadeAi=tds.find_next_sibling('td').find_next_sibling('td').find_next_sibling('td').text
                                                cidadeAi=str(cidadeOc)
                                                cidadeAi=cidadeAi.replace("\n","").replace("\'","").replace("[","").replace("]","")
                                            if re.search(r'(?<![^\s])BOC(?![^\s])', tds.text):
                                                boc = tds.find_next_sibling('td').text.split()
                                                boc=str(boc)
                                                boc=boc.replace(",","").replace("\'","").replace("[","").replace("]","")
                                                orgaoOc=tds.find_next_sibling('td').find_next_sibling('td').find_next_sibling('td').find_next_sibling('td').text
                                                orgaoOc=str(orgaoOc)
                                                orgaOc=orgaoOc.replace("\n","").replace("\'","").replace("[","").replace("]","")
                                                cidadeOc=tds.find_next_sibling('td').find_next_sibling('td').find_next_sibling('td').text
                                                cidadeOc=str(cidadeOc)
                                                cidadeOc=cidadeOc.replace("\n","").replace("\'","").replace("[","").replace("]","")
                                            if "IP/PM" in tds.text:
                                                ipPm = tds.find_next_sibling('td').text.split()
                                                ipPm=str(ipPm)
                                                ipPm=ipPm.replace(",","").replace("\'","").replace("[","").replace("]","")
                                                orgaoPm=tds.find_next_sibling('td').find_next_sibling('td').find_next_sibling('td').find_next_sibling('td').text
                                                orgaoPm=str(orgaoPm)
                                                orgaPm=orgaoPm.replace("\n","").replace("\'","").replace("[","").replace("]","")
                                                cidadePm=tds.find_next_sibling('td').find_next_sibling('td').find_next_sibling('td').text
                                                cidadePm=str(cidadePm)
                                                cidadePm=cidadePm.replace("\n","").replace("\'","").replace("[","").replace("]","")
                                            if re.search(r'(?<![^\s])BO(?![^\s])', tds.text):
                                                bo = tds.find_next_sibling('td').text
                                                orgaoBo=tds.find_next_sibling('td').find_next_sibling('td').find_next_sibling('td').find_next_sibling('td').text
                                                orgaoBo=str(orgaoBo)
                                                orgaBo=orgaoBo.replace("\n","").replace("\'","").replace("[","").replace("]","")
                                                cidadeBo=tds.find_next_sibling('td').find_next_sibling('td').find_next_sibling('td').text
                                                cidadeBo=str(cidadeBo)
                                                cidadeBo=cidadeBo.replace("\n","").replace("\'","").replace("[","").replace("]","")
                                            if "OFÍCIO REQUISITANTE" in tds.text:
                                                oficio = tds.find_next_sibling('td').text.split()
                                                oficio=str(oficio)
                                                oficio=oficio.replace(",","").replace("\'","").replace("[","").replace("]","")
                                            if "IP ONLINE" in tds.text:
                                                ipOn = tds.find_next_sibling('td').text.split()
                                                ipOn=str(ipOn)
                                                ipOn=ipOn.replace(",","").replace("\'","").replace("[","").replace("]","")
                                                orgaoOn=tds.find_next_sibling('td').find_next_sibling('td').find_next_sibling('td').find_next_sibling('td').text
                                                orgaoOn=str(orgaoOn)
                                                orgaOn=orgaoOn.replace("\n","").replace("\'","").replace("[","").replace("]","")
                                                cidadeOn=tds.find_next_sibling('td').find_next_sibling('td').find_next_sibling('td').text
                                                cidadeOn=str(cidadeOn)
                                                cidadeOn=cidadeOn.replace("\n","").replace("\'","").replace("[","").replace("]","")
                                            if re.search(r'(?<![^\s])IP/APFD(?![^\s])', tds.text):
                                                ip = tds.find_next_sibling('td').text.split()
                                                ip=str(ip)
                                                ip=ip.replace(",","").replace("\'","").replace("[","").replace("]","")
                                                orgao=tds.find_next_sibling('td').find_next_sibling('td').find_next_sibling('td').find_next_sibling('td').text
                                                orgao=str(orgao)
                                                orga=orgao.replace("\n","").replace("\'","").replace("[","").replace("]","")
                                                cidade=tds.find_next_sibling('td').find_next_sibling('td').find_next_sibling('td').text
                                                cidade=str(cidade)
                                                cidade=cidade.replace("\n","").replace("\'","").replace("[","").replace("]","")
                                            if "OFÍCIO REQUISITANTE" in tds.text:
                                                
                                                uni= "NDA"
                                               
                                                unidade=str(uni)
                                                unidade=unidade.replace("\n","").replace("\'","").replace("[","").replace("]","")
                                               
                                                dataSoli=tds.find_next_sibling('td').find_next_sibling('td').find_next_sibling('td').find_next_sibling('td').find_next_sibling('td').text
                                                dataSoli=dataSoli.replace("\n","").replace(" ","")
                                                
                                                
                                                
                                                
                                                current_url = driver.current_url
                                                #numBO=bo(td)
                                                json_data = json.dumps(gt)

                                                
                                                
                                     
                                    try:      
                                        cursor.execute("SELECT rep,dataSoli,data_solicitacao,orgao,cidade,unidade,oficio,ip,envolvidos,nome,bo,data_designacao,ipOn,ipPm,boc,ipOnOrgao,ipPmOrgao,bocOrgao,ipOnCidade,ipPmCidade,bocCidade,ipAi,orgaoAi,cidadeAi,cidadeBo,orgaBo FROM _nome_da_tabela WHERE rep = %s AND dataSoli = %s AND data_solicitacao = %s AND orgao = %s AND cidade = %s AND unidade = %s AND oficio = %s AND ip = %s AND envolvidos = %s AND nome = %s AND bo = %s AND data_designacao = %s AND ipOn = %s AND ipPM = %s AND boc = %s AND ipOnOrgao = %s AND ipPmOrgao = %s AND bocOrgao = %s AND ipOnCidade = %s AND ipPmCidade = %s AND bocCidade = %s AND ipAi = %s AND orgaoAi = %s AND cidadeAi = %s AND cidadeBo = %s AND orgaBo = %s AND status = 'Pendente'", (rep, dataSoli, data_recebimento, orga, cidade, unidade, oficio, ip, json_data, usuario,bo,data_designacao,ipOn,ipPm,boc,orgaOn,orgaPm,orgaOc,cidadeOn,cidadePm,cidadeOc,ipAi,orgaAi,cidadeAi,cidadeBo,orgaBo))
                                    except  mysql.connector.Error as error:
                                        print(f"Erro de conexão ao MySQL: {error}")
                                    if cursor.fetchone() is None:
                                        cursor.execute("INSERT INTO _nome_da_tabela (rep,dataSoli,data_solicitacao,orgao,cidade,unidade,oficio,ip,envolvidos,nome,bo,data_designacao,ipOn,ipPm,boc,ipOnOrgao,ipPmOrgao,bocOrgao,ipOnCidade,ipPmCidade,bocCidade,ipAi,orgaoAi,cidadeAi,cidadeBo,orgaBo) VALUES (%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)",(rep, dataSoli, data_recebimento, orga, cidade, unidade, oficio, ip, json_data, usuario,bo,data_designacao,ipOn,ipPm,boc,orgaOn,orgaPm,orgaOc,cidadeOn,cidadePm,cidadeOc,ipAi,orgaAi,cidadeAi,cidadeBo,orgaBo))
                                        conn.commit()
                                                    #sql = "DELETE FROM _nome_da_tabela WHERE status = 'Pendente' AND rep IN (SELECT rep FROM _nome_da_tabela WHERE status = 'OK')" # deleta o pendente
                                                    #cursor.execute(sql)
                                                    #conn.commit()
                                    else:
                                        print("Os valores já existem na tabela.")
                                               
                                    
                                         
                                    sair=driver.find_element(By.CLASS_NAME,'text')
                                    sair.click()
                                    
                                    gt=[]
                                    json_data=""
                                    #break
                    
                #resultado= "-".join(str(rep) for rep in arrayArmazenaRep )
            
            percorre(tabela)
            #time.sleep(10)
            pagAnexo=driver.find_element(By.ID,'Content_rptPagingBottom_imgNextPage_1') 
            #
            #clickPagAnexo busca a proxima pagina caso exista
            #
            def clickPagAnexo():   
                if bool(pagAnexo):
                    try:
                        pagAnexo.click()
                        html=driver.page_source
                        soup=BeautifulSoup(html,'html.parser')
                        tabelaNext=soup.find('table',{'id':'Content_gridSearchMyRequests'})
                        percorre(tabelaNext)
                        #time.sleep(10)
                        clickPagAnexo()
                    except:
                        return     
                
                    
            clickPagAnexo()

            if conn.is_connected():
                print("Conexão bem-sucedida!")
            else:
                print("Falha ao conectar-se ao banco de dados.")

            conn.close()

            driver.quit()
    except:
        print("Ocorreu uma exceção.")
        conn.close()

        driver.quit()


    





