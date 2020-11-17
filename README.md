![Formula1-Backend](https://socialify.git.ci/rhuangabrielsantos/Formula1-Backend/image?description=1&font=Inter&issues=1&logo=https%3A%2F%2Fimage.flaticon.com%2Ficons%2Fpng%2F512%2F55%2F55299.png&owner=1&pattern=Plus&pulls=1&stargazers=1&theme=Light)

[![Build Status](https://travis-ci.org/rhuangabrielsantos/Formula1-Backend.svg?branch=master)](https://travis-ci.org/rhuangabrielsantos/Formula1-Backend)

Welcome to the "Formula 1 Backend" Project Repository, this project consists of a car race, the rules of the race are in the F1.pdf file.

To execute the project on your local machine, it is necessary to have the docker installed. If you have not installed it, click the link below and install. Remembering that if you are using linux, it is necessary to download the docker-composite as well or use Gitpod :) <br>

<a>https://docs.docker.com/install/</a>

[![Open in Gitpod](https://gitpod.io/button/open-in-gitpod.svg)](https://gitpod.io/#https://github.com/rhuangabrielsantos/F1-Project)

# Setting up environment

- Open the terminal and run the command below to clone the project:

<pre>git clone https://github.com/rhuangabrielsantos/F1-Project.git</pre>

- Through the terminal enter the project folder and run the command:

<pre>docker-compose up -d</pre>

- Run the command below to view the container created.

<pre>docker ps</pre>

- Run the command below to enter the created container 

<pre>docker exec -it Formula1-Backend bash</pre>

- You are inside the container! <br><br>

- Run the following command to install the project dependencies:

<pre>composer install</pre>

- You can now test the application by running the command

<pre>php verificarComandos</pre>
