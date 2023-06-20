
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erro</title>
</head>
<body>
<style>
    div{
        display:table-cell;
        max-width: 100%;
    }
    h1{
        color:red;
        max-width: 100%;
        
        
    }
    textarea{
        padding: 10px;
        margin-left: 30%;
    }
    input{
        margin-left: 30%;
        width: 252px;
    }
</style>
<h1>Reportar erros</h1>
<hr>
     <div>
        

         <form action="/reportar.store" method="POST">
            {{ csrf_field() }}  
        <input name="nome" id="nome" type="text" placeholder="Nome"></label> <br>
        <textarea name="erro" id="" cols="30" rows="10" placeholder="Qual o erro:"></textarea><br>
        <textarea name="solucao" id="" cols="30" rows="10" placeholder="Qual a solução ideal:"></textarea><br>

        <input type="submit" value="enviar">
        </form>
    </div> 
</body>
</html>



