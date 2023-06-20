import mysql.connector
#classe que conecta ao banco de dados
class ConnectMysql:
    
    def __init__(self,host,user,password,database):
        self.host=host
        self.user=user
        self.password=password
        self.database=database
    def conexao(self):
        try:
            con = mysql.connector.connect(
                host=self.host,
                user=self.user,
                password=self.password,
                database=self.database)
            print('Successo na conexão')
            cursor = con.cursor()
            return cursor
        except:
            print('Não foi possivel se conectar ao banco de dados, tente novamente')
   
    def fechaConexao(self):
        if(self.conexao()!="Não foi possivel se conectar ao banco de dados, tente novamente"):
            fechar = self.conexao()
            fechar.close()
            print('Conexao fechada')
        else:
            print('Sem conexão ao banco de dados')
