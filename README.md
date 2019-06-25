# Projeto TG

Bem vindo ao Repositório do Projeto TG,
esse projeto consiste em uma corrida de carros,
as regras da corrida estão no arquivo Formula TG, dentro da pasta Rules.

Para rodar o projeto, você precisa ter o docker instalado em sua máquina, se não tiver instalado acesse o link abaixo e faça a instalação. <br>

<a>https://docs.docker.com/install/</a>

# Rodando o Projeto

<h3> Ubuntu: </h3>

- Abra o terminal e rode o comando abaixo para clonar o projeto:

<pre> git clone https://github.com/rhuangabrielsantos/ProjectTG.git </pre>

- Pelo terminal entre na pasta criada e rode o comando abaixo para dar permissão ao arquivo e para instalar
os programas necessários para rodar a aplicação:

<pre>chmod +x install.sh</pre>

<pre>./install.sh</pre>

Agora você já pode rodar o Projeto!

# Rodando a Projeto

- Entre no arquivo docker-compose.yml e altere o caminho em volumes para o caminho que sua pasta está. <br>

- Pelo terminal entre na pasta do projeto e rode o comando:

<pre> docker-compose up -d </pre>

5 - Dê o comando abaixo para visualizar o container criado.

<pre> docker ps </pre> 

6 - Agora pegue o ID do container e escreva o seguinte comando substituindo o ID CONTAINER: 

<pre> docker exec -it (ID CONTAINER) bash </pre>

7 - Você está dentro do container! <br><br>

8 - Você já pode testar a aplicação rodando o comando

<pre> php race.php </pre>


# Funções

Para fazer alterações na corrida, abra o arquivo <strong> race.php </strong> em seu software preferido.

<ul>
  <li><strong>newCar</strong>: Adiciona um novo carro com os parâmetros Piloto, Marca, Modelo, Cor e Ano.</li>  
  <li><strong>setPosition</strong>: Ele seta as posições para os carros criados, pra corrida começar os carros precisam de suas posições definidas</li>
  <li><strong>startRace</strong>: Inicia a corrida!</li>
  <li><strong>overtake</strong>: Comando para as ultrapassagens, primeiro parâmetro é quem irá passar, e o segundo, quem ficou pra trás!</li>
  <li><strong>finishRace</strong>: Finaliza a corrida.</li>
  <li><strong>report</strong>: Mostra um relatório com todas as ultrapassagens da corrida.</li>
</ul>

