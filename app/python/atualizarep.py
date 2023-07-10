"""""" 
import subprocess
import time 
import requests
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.chrome.options import Options
import os
from bs4 import BeautifulSoup
import sys
import json
import mysql.connector
import datetime
import re
from selenium.common.exceptions import WebDriverException
from selenium.webdriver.chrome.service import Service

import pecasGdl 
#conectando ao banco
conn = mysql.connector.connect(
  host="127.0.0.1",
  user="root",
  password="",
  database="policiacientifica"
)

cursor = conn.cursor()


#parametros passados para o script
args = sys.argv[1:] 
arg_count = len(args) 
password = sys.argv[1]
usuario = sys.argv[2]
exame = sys.argv[3]

if "EFICIÊNCIA" in exame:
    exame = "EXAME DE EFICIÊNCIA E PRESTABILIDADE"
elif "CONFRONTO" in exame:
    exame = "EXAME DE CONFRONTO BALÍSTICO"

#data = sys.argv[3] if arg_count == 3 else None 

# Obtém o diretório atual do script Python
dir_path = os.path.dirname(os.path.realpath(__file__))

# Cria o caminho relativo ao driver do Chrome
driver_path = os.path.join(dir_path, 'chromedriver')


# Define as opções do Chrome
options = Options()

options.add_argument('--headless')
# Adicione as opções desejadas aqui
options = webdriver.ChromeOptions()
#options.add_argument('--proxy-server=http://proxycientifica.sesp.parana:8080')

# Inicializa o driver do Chrome com as opções e o caminho relativo ao driver
try:
    driver = webdriver.Chrome(options=options)
except WebDriverException as e:
    print(e)

#cursor.execute("SELECT userGDL,senhaGDL FROM users") 
results = [[usuario,password]]
#print(results[2][0])
#sys.exit() 

for listMsl in results:
    conn = mysql.connector.connect(
    host="127.0.0.1",
    user="root",
    password="",
    database="policiacientifica")

    cursor = conn.cursor()
    try:
        if  listMsl[0] != None:
            
            password = listMsl[1]
            usuario = listMsl[0]

            # Inicia o driver do Chrome com a opção '--headless' para iniciar o servidor do Selenium em segundo plano
           # options = webdriver.ChromeOptions()
            #options.add_argument('--headless')

            #driver = webdriver.Chrome(options=options)
            
            # Abre o navegador e navega para a página do GDL e faz o login
            driver.get('http://www.gdl.sesp.parana/SAC/GDL_IC_NET/Account/Login.aspx')#
            # http://iishml01.pr.gov.br/SAC/GDL_IC_NET/Account/Login.aspx 

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
                    
                    if exame in celula:
                        
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
                                    #TABELA DAS PEÇAS
                                    tabelaPecas=soup.find('table',{'id':'Content_RepMain_ucParts_gridParts'})
                                    tdPecas=tabelaPecas.find_all('td')
                                    collectionPecas=[]
                                    #contador usado para ir a proxima tabela
                                    contador = 0
                                    for pecagdl in tdPecas:
                                        try:
                                            #encontra o elemento usando o selenium
                                            acaoEditePecas=driver.find_element(By.ID,f'Content_RepMain_ucParts_gridParts_imgEditParts_{contador}')
                                            acaoEditePecas.click()
                                            time.sleep(3)
                                            #tipo do item
                                            tipo_item = driver.find_element(By.ID, 'Content_RepMain_ucParts_ddlTypeParts')
                                            opcao_selecionada_item = tipo_item.find_element(By.CSS_SELECTOR, 'option:checked')
                                            tipo_item = opcao_selecionada_item.text
                                            print("Item ",tipo_item)
                                            #lacre de entrada
                                            try:
                                                lacre_entrada_gdl=driver.find_element(By.ID,'Content_RepMain_ucParts_txtSealEntryParts')
                                                lacre_entrada_gdl = lacre_entrada_gdl.get_attribute('value')
                                                print("Lacre de Entrada ",lacre_entrada_gdl)
                                            except Exception:
                                                lacre_entrada_gdl=""
                                            #numero de serie
                                            try:
                                                num_serie=driver.find_element(By.ID,'Content_RepMain_ucParts_rptPartsFields_txtField_0')
                                                num_serie = num_serie.get_attribute('value')
                                                print("Numero de Serie ",num_serie)
                                            except Exception:
                                                num_serie=""
                                                print("sem numero de serie")
                                            
                                            
                                            #quantidade
                                            quantidade=driver.find_element(By.ID,'Content_RepMain_ucParts_txtQtdeColorParts')#quantidade
                                            quantidade = quantidade.get_attribute('value')
                                            print("Quantidade ",quantidade)

                                            #Marca
                                            try:
                                                marca= driver.find_element(By.ID, 'Content_RepMain_ucParts_rptPartsFields_txtField_1')
                                                marca = marca.get_attribute('value')
                                                
                                                print("Marca ",marca)
                                            except Exception:
                                                marca=""
                                                print("Sem Marca")
                                            
                                            #Estado Geral
                                            try:
                                                estado_geral= driver.find_element(By.ID, 'Content_RepMain_ucParts_rptPartsFields_ddlField_8')
                                                opcao_selecionada_estado_geral = estado_geral.find_element(By.CSS_SELECTOR, 'option:checked')
                                                estado_geral = opcao_selecionada_estado_geral.text
                                                print("Estado Geral ",estado_geral)
                                            except Exception:
                                                estado_geral=""
                                                print("Sem estado_geral")

                                            #Funcionamento
                                            try:
                                                funcionamento= driver.find_element(By.ID, 'Content_RepMain_ucParts_rptPartsFields_ddlField_9')
                                                opcao_selecionada_funcionamento = funcionamento.find_element(By.CSS_SELECTOR, 'option:checked')
                                                funcionamento = opcao_selecionada_funcionamento.text
                                                print("Funcionamento ",funcionamento)
                                            except Exception:
                                                funcionamento=""
                                                print("Sem funcionamento")
                                            
                                            #status do numero de serie
                                            try:
                                                status_num_serie= driver.find_element(By.ID, 'Content_RepMain_ucParts_rptPartsFields_ddlField_5')
                                                opcao_selecionada_status_num_serie = status_num_serie.find_element(By.CSS_SELECTOR, 'option:checked')
                                                status_num_serie = opcao_selecionada_status_num_serie.text
                                                print("status_num_serie ",status_num_serie)
                                            except Exception:
                                                status_num_serie=""
                                                print("Sem status de numero de serie")
                                            
                                            #calibre Nominal
                                            try:
                                                calibre_Nominal= driver.find_element(By.ID, 'Content_RepMain_ucParts_rptPartsFields_ddlField_6')
                                                opcao_selecionada_calibre_Nominal = calibre_Nominal.find_element(By.CSS_SELECTOR, 'option:checked')
                                                calibre_Nominal = opcao_selecionada_calibre_Nominal.text
                                                print("calibre_Nominal ",calibre_Nominal)
                                            except Exception:
                                                calibre_Nominal=""
                                                print("Sem calibre Nominal")
                                            
                                            #Fabricação
                                            try:
                                                fabricacaoArmaCartucho= driver.find_element(By.ID, 'Content_RepMain_ucParts_rptPartsFields_ddlField_10')
                                                opcao_selecionada_fabricacaoArmaCartucho = fabricacaoArmaCartucho.find_element(By.CSS_SELECTOR, 'option:checked')
                                                fabricacaoArmaCartucho = opcao_selecionada_fabricacaoArmaCartucho.text
                                                print("fabricacao ",fabricacaoArmaCartucho)
                                            except Exception:
                                                fabricacaoArmaCartucho=""
                                                print("Sem Fabricacao")
                                            
                                            #Consumido
                                            try:
                                                consumido= driver.find_element(By.ID, 'Content_RepMain_ucParts_ddlItemsConsumedExaminationParts')
                                                opcao_selecionada_consumido = consumido.find_element(By.CSS_SELECTOR, 'option:checked')
                                                consumido = opcao_selecionada_consumido.text
                                                print("Consumido ",consumido)
                                            except Exception:
                                                consumido=""
                                                print("Sem consumido")

                                            #lacre de saida
                                            try:
                                                lacre_saida_gdl=driver.find_element(By.ID,'Content_RepMain_ucParts_txtSealExitParts')
                                                lacre_saida_gdl = lacre_saida_gdl.get_attribute('value')
                                                print("Lacre de saida_gdl ",lacre_saida_gdl)
                                            except Exception:
                                                lacre_saida_gdl=""
                                                print("sem lacre de saida")
                                            #modelo
                                            try:
                                                modelo_gdl=driver.find_element(By.ID,'Content_RepMain_ucParts_rptPartsFields_txtField_2')
                                                modelo_gdl = modelo_gdl.get_attribute('value')
                                                print(" modelo ",modelo_gdl)
                                            except Exception:
                                                modelo_gdl=""
                                                print("sem modelo")

                                            #observação
                                            try:
                                                observacao_gdl=driver.find_element(By.ID,'Content_RepMain_ucParts_txtObservation')
                                                observacao_gdl = observacao_gdl.get_attribute('value')
                                                print("modelo ",observacao_gdl)
                                            except Exception:
                                                observacao_gdl=""
                                                print("sem Observação")
                                            
                                            #descricao
                                            try:
                                                descricao=driver.find_element(By.ID,'Content_RepMain_ucParts_txtQtdeDescColorParts')
                                                descricao = descricao.get_attribute('value')
                                                print("descricao ",descricao)
                                            except Exception:
                                                descricao=""
                                                print("sem descricao")
                                            #capacidade
                                            try:
                                                capacidade=driver.find_element(By.ID,'Content_RepMain_ucParts_rptPartsFields_txtField_3')
                                                capacidade = capacidade.get_attribute('value')
                                                print("capacidade ",capacidade)
                                            except Exception:
                                                capacidade=""
                                                print("sem capacidade")

                                            #patrimonio
                                            try:
                                                patrimonio=driver.find_element(By.ID,'Content_RepMain_ucParts_rptPartsFields_txtField_11')
                                                patrimonio = patrimonio.get_attribute('value')
                                                print("patrimonio ",patrimonio)
                                            except Exception:
                                                patrimonio=""
                                                print("sem patrimonio")

                                            #estojo
                                            try:
                                                estojo_gdl= driver.find_element(By.ID, 'Content_RepMain_ucParts_ddlItemsConsumedExaminationParts')
                                                opcao_selecionada_estojo_gdl = estojo_gdl.find_element(By.CSS_SELECTOR, 'option:checked')
                                                estojo_gdl = opcao_selecionada_estojo_gdl.text
                                                print("estojo ",estojo_gdl)
                                            except Exception:
                                                estojo_gdl=""
                                                print("Sem estojo")
                                            
                                            #lote
                                            try:
                                                lote_gdl=driver.find_element(By.ID,'Content_RepMain_ucParts_rptPartsFields_txtField_6')
                                                lote_gdl = lote_gdl.get_attribute('value')
                                                print("lote ",lote_gdl)
                                            except Exception:
                                                lote_gdl=""
                                                print("sem lote")
                                            
                                            #acabamento
                                            try:
                                                ti_acabamento= driver.find_element(By.ID, 'Content_RepMain_ucParts_rptPartsFields_ddlField_7')
                                                opcao_selecionada_ti_acabamento = ti_acabamento.find_element(By.CSS_SELECTOR, 'option:checked')
                                                ti_acabamento = opcao_selecionada_ti_acabamento.text
                                                print("acabamento ",ti_acabamento)
                                            except Exception:
                                                ti_acabamento=""
                                                print("Sem acabamento")
                                            #identificacao
                                            try:
                                                identificacao=driver.find_element(By.ID,'Content_RepMain_ucParts_txtIdentifyParts')
                                                identificacao = identificacao.get_attribute('value')
                                                print("identificacao ",identificacao)
                                            except Exception:
                                                identificacao=""
                                                print("sem identificacao")
                                            
                                            try:
                                                #Incluindo no banco de dados
                                                cursor.execute("SELECT tipo_item,lacre_entrada,descricao,quantidade,consumida,rep,perito,num_serie,marca,funcionamento,status_serie,calibre_nominal,fabricacao,lacre_saida,modelo,observacao,patrimonio,acabamento,lote,estojo,capacidade,identificacao FROM tabela_pecas_gdl WHERE tipo_item = %s AND lacre_entrada = %s AND descricao = %s AND quantidade = %s AND consumida = %s AND rep = %s AND perito = %s AND num_serie = %s AND marca = %s AND estado_geral = %s AND funcionamento = %s AND status_serie = %s AND calibre_nominal = %s AND fabricacao = %s AND lacre_saida = %s AND modelo = %s AND observacao = %s AND patrimonio = %s AND acabamento = %s AND lote = %s AND estojo = %s AND capacidade = %s AND identificacao = %s ", (tipo_item,lacre_entrada_gdl,descricao,quantidade,consumido,rep,perito,num_serie,marca,estado_geral,funcionamento,status_num_serie,calibre_Nominal,fabricacaoArmaCartucho,lacre_saida_gdl,modelo_gdl,observacao_gdl,patrimonio,ti_acabamento,lote_gdl,estojo_gdl,capacidade,identificacao))
                                                if cursor.fetchone() is None:
                                                    cursor.execute("INSERT INTO tabela_pecas_gdl (tipo_item,rep,perito,lacre_entrada,estado_geral,marca,status_serie,num_serie,modelo,funcionamento,calibre_nominal,fabricacao,lacre_saida,consumida,quantidade,descricao,observacao,capacidade,patrimonio,estojo,lote,acabamento,identificacao) VALUES (%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)",(tipo_item,rep,perito,lacre_entrada_gdl,estado_geral,marca,status_num_serie,num_serie,modelo_gdl,funcionamento,calibre_Nominal,fabricacaoArmaCartucho,lacre_saida_gdl,consumido,quantidade,descricao,observacao_gdl,capacidade,patrimonio,estojo_gdl,lote_gdl,ti_acabamento,identificacao,))
                                                    conn.commit()
                                            except Exception as ex:
                                                print("erro de conexao", ex)
                                          
                                            contador+=1
                                        except:
                                            break

                                        
                                        
                                    
                                    
                                    
                                    #TABELA ENVOLVIDOS
                                    
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
                                            
                                    pagAdicionalfecha=driver.find_element(By.ID,'Content_RepMain_lblTabsTitle')
                                    pagAdicionalfecha.click()
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

                                                
                                                
                                           
                                    cursor.execute("SELECT rep,dataSoli,data_solicitacao,orgao,cidade,unidade,oficio,ip,envolvidos,nome,bo,data_designacao,ipOn,ipPm,boc,ipOnOrgao,ipPmOrgao,bocOrgao,ipOnCidade,ipPmCidade,bocCidade,ipAi,orgaoAi,cidadeAi,cidadeBo,orgaBo FROM _nome_da_tabela WHERE rep = %s AND dataSoli = %s AND data_solicitacao = %s AND orgao = %s AND cidade = %s AND unidade = %s AND oficio = %s AND ip = %s AND envolvidos = %s AND nome = %s AND bo = %s AND data_designacao = %s AND ipOn = %s AND ipPM = %s AND boc = %s AND ipOnOrgao = %s AND ipPmOrgao = %s AND bocOrgao = %s AND ipOnCidade = %s AND ipPmCidade = %s AND bocCidade = %s AND ipAi = %s AND orgaoAi = %s AND cidadeAi = %s AND cidadeBo = %s AND orgaBo = %s AND status = 'Pendente'", (rep, dataSoli, data_recebimento, orga, cidade, unidade, oficio, ip, json_data, usuario,bo,data_designacao,ipOn,ipPm,boc,orgaOn,orgaPm,orgaOc,cidadeOn,cidadePm,cidadeOc,ipAi,orgaAi,cidadeAi,cidadeBo,orgaBo))
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







