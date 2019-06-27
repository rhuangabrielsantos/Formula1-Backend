# Projeto TG

Bem vindo ao Repositório do Projeto TG,esse projeto consiste em uma corrida de carros, as regras da corrida estão no arquivo Formula TG, dentro da pasta Rules.

Para rodar o projeto, você precisa ter o docker instalado em sua máquina, se não tiver instalado acesse o link abaixo e faça a instalação. Lembrando que se estiver usando linux é necessário o download do docker-compose também. <br>

<a>https://docs.docker.com/install/</a>

# Configurando Ambiente

- Abra o terminal e rode o comando abaixo para clonar o projeto:

<pre>git clone https://github.com/rhuangabrielsantos/ProjectTG.git</pre>

- Pelo terminal entre na pasta criada e rode o comando abaixo para dar permissão ao arquivo e para instalar
os programas necessários para rodar a aplicação:

<pre>chmod +x install.sh</pre>

<pre>./install.sh</pre>

- Entre no arquivo docker-compose.yml e altere o caminho em volumes para o caminho que sua pasta está. <br>

- Pelo terminal entre na pasta do projeto e rode o comando:

<pre>docker-compose up -d</pre>

- Dê o comando abaixo para visualizar o container criado.

<pre>docker ps</pre> 

- Agora pegue o ID do container e escreva o seguinte comando substituindo o ID CONTAINER: 

<pre>docker exec -it (ID CONTAINER) bash</pre>

- Você está dentro do container! <br><br>

- Você já pode testar a aplicação rodando o comando

<pre>./verificarComandos</pre>
