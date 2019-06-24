# Projeto TG

Bem vindo ao Repositório do Projeto TG, esse projeto consiste em uma corrida de carros!

Para rodar em sua máquina siga os passos abaixo (é necessário ter o docker instalado e composer):

1 - Abra o terminal e clone o Projeto em sua máquina: <pre> git clone https://github.com/rhuangabrielsantos/ProjectTG.git </pre>
2 - Entre no arquivo <strong> docker-compose.yml </strong>, e em volumes, altere para o caminho apontando para sua pasta; <br><br>
3 - No terminal rode o comando dentro da pasta criada: <pre> composer install </pre>
4 - Após a instalação rode o comando: <pre> docker-compose up -d </pre>
5 - Dê o comando abaixo para visualizar o container criado. <pre> docker ps </pre> 
6 - Agora pegue o ID do container e escreva o seguinte comando substituindo o ID CONTAINER: 
<pre> docker exec -it (ID CONTAINER) bash </pre>
7 - Você está dentro do container! <br><br>
8 - Você já pode testar a aplicação rodando o comando <pre> php race.php </pre>


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

