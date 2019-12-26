# Projeto F1

[![Build Status](https://travis-ci.org/rhuangabrielsantos/F1-Project.svg?branch=master)](https://travis-ci.org/rhuangabrielsantos/F1-Project)

Bem vindo ao Repositório do Projeto F1,esse projeto consiste em uma corrida de carros, as regras da corrida estão no arquivo F1.pdf.

Para rodar o projeto, você precisa ter o docker instalado em sua máquina, se não tiver instalado acesse o link abaixo e faça a instalação. Lembrando que se estiver usando linux é necessário o download do docker-compose também. <br>

<a>https://docs.docker.com/install/</a>

# Configurando Ambiente

- Abra o terminal e rode o comando abaixo para clonar o projeto:

<pre>git clone https://github.com/rhuangabrielsantos/F1-Project.git</pre>

- Pelo terminal entre na pasta do projeto e rode o comando:

<pre>docker-compose up -d</pre>

- Dê o comando abaixo para visualizar o container criado.

<pre>docker ps</pre>

- Agora pegue o ID do container e escreva o seguinte comando substituindo o ID CONTAINER: 

<pre>docker exec -it (ID CONTAINER) bash</pre>

- Você está dentro do container! <br><br>

- Rode os comandos a seguir para instalar as dependências do projeto:

<pre>composer install</pre>

- Você já pode testar a aplicação rodando o comando

<pre>php verificarComandos</pre>
