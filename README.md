# SWAPI
Repositório criado para consumir a API do star wars (https://swapi.py4e.com/api/)



<h1>Instalação do projeto</h1>

1. Extrair as pastas do arquivo win.rar, para um diretório de sua escolha.

2. Docker:
    ["Instale o docker pelo site oficial do docker: 'https://www.docker.com/' logo em seguida instale o docker compose, também utilizando o site oficial 'https://docs.docker.com/compose/' na aba 'Install compose'-> selecione seu sistema operacional e faça o download."]

3. Abra seu terminal, e cosntrua os container do docker:
    ["Navegue até a pasta do diretório e digite: 'docker-compose up --build -d' sem aspas. Este comando criará e inicializara um container."]

4. Abra seu gerenciador de banco de dados:
    ["As configurações necessárias para seu banco de dados:"]
    ["Hostname: 127.0.0.1"]
    ["Port: 3307"]
    ["Username: root"]
    ["Password: 123"]
    ["Selecione o banco que deseja utilizar: 'USE l5-networks'"]

5. Faça um Dump do banco:
    ["Abra a pasta Dump"]
    ["Abra o arquivo: Dump20250120.Sql, em qualquer editor de texto."]
    ["Copie o material que está dentro"]
    ["Cole no espaço de query do seu banco de dados"]
    ["Execute"]

6. Abra o seu navegador:
    [Em seu navegador utilize a url: http://localhost:8080/]

<br>   
<hr>
<br>

<h1>Documentação da api</h1>

Introdução:
    
    BASE_URL: http://localhost:8080

    Tipo: GET [BASE_URL/?page=home]

    Parametros padrões:    
    [page] home
    [page]f ilms

    Designada para trazer o HTML das paginas

<hr>

    Tipo: GET [BASE_URL/?page=films&id=1&type=films]

    Parametros padrões:
    [page] films
    [id] 1 até 7
    [type] films

    Designado para realizar consumo da api [https://swapi.py4e.com/api/films] e exibir o retorno em tela.

<hr>

    Tipo: POST [BASE_URL/controller/LoginControl.php/?user=teste&pass=teste&login=1]

    Parametros padrões:
    [login] 1
    
    Designado para realizar Login

    
<hr>

    Tipo: POST [BASE_URL/controller/LoginControl.php/?user=teste&pass=teste&create=1]

    Parametros padrões:
    [create] 1
    
    Designado para realizar Criar o usuário

<hr>

    Tipo: POST [BASE_URL/controller/LoginControl.php/?user=teste&pass=teste&edit=1]

    Parametros padrões:
    [edit] 1

    Designado para realizar Edições no usuário logado

<hr>

    Tipo: POST [BASE_URL/controller/LoginControl.php/?user=teste&pass=teste&login=1]

    Parametros padrões:
    [login] 1
    
    Designado para realizar Login

<br>
<hr>
<br>

<h1>Lista das melhorias aplicadas:</h1>

* Tela de login
* Editar usuário
* Criar usuáario
* imagem dos persoangens (Sei que não é uma boa prática chumbar o valor das imagens assim, mas foi a melhor solução que obtive para situação)
* imagem dos filmes (Sei que não é uma boa prática chumbar o valor das imagens assim, mas foi a melhor solução que obtive para situação)
