# Projeto TG

Bem vindo ao Repositório do Projeto TG,
esse projeto consiste em uma corrida de carros,
as regras da corrida estão no arquivo Formula TG, dentro da pasta Rules.

# Rodando o Projeto

<h3> Ubuntu: </h3>

- Abra o terminal e rode o comando abaixo para clonar o projeto:

<pre> git clone https://github.com/rhuangabrielsantos/ProjectTG.git </pre>

- Pelo terminal entre na pasta criada e rode o comando abaixo para dar permissão ao arquivo e para instalar
os programas necessários para rodar a aplicação:

<pre> chmod +x install.sh </pre>

<pre> install.sh </pre>

- Verifique se a instalação ocorreu da maneira certa rodando o comando abaixo:

<pre> docker --version </pre>
<pre> docker-compose --version </pre>

Agora você já pode rodar o Projeto!

<h3> Windows: </h3>

1 - Faça o download do <a href="https://download.docker.com/win/beta/InstallDocker.msi">Docker</a>. <br>
2 - Clique duas vezes em InstallDocker.msi para executar o instalador. <br>
3 - Siga o Assistente de Instalação: aceite a licença, autorize o instalador e continue com a instalação. <br>
4 - Clique em Concluir para iniciar o Docker. <br>
5 - O Docker é iniciado automaticamente. <br>
6 - O Docker carrega uma janela de boas-vindas, fornecendo dicas e acesso à documentação do Docker. <br>
7 - Abra o terminal de sua preferência e rode o comando abaixo para verificar a versão do Docker:

<pre> docker --version </pre>

8 - Rode o comando abaixo para instalar as dependências do composer:

<pre> docker run --rm --interactive --tty --volume $PWD:/app --user $(id -u):$(id -g) composer install </pre>

Agora você já pode rodar o Projeto!

# Rodando a Projeto

Para rodar em sua máquina siga os passos abaixo:

1 - Abra o terminal e clone o Projeto em sua máquina:

<pre> git clone https://github.com/rhuangabrielsantos/ProjectTG.git </pre>

2 - Entre no arquivo <strong> docker-compose.yml </strong>, e em volumes, altere para o caminho apontando para sua pasta; <br><br>

3 - No terminal rode o comando dentro da pasta criada: 

<pre> composer install </pre>

4 - Após a instalação rode o comando:

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

