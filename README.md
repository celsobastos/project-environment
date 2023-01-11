# Project Environment

## Docker
### Run an embed server
 - docker run -d --name php-server02 -p 9000:9000 -v "/home/celso/projeto-docker-php:/var/www/html/" -w "/var/www/html/" php -S 0.0.0.0:9000 -t public/

### Create dockerfile
 - FROM php:latest
 - LABEL Celso Bastos
 - COPY . /var/www/html/
 - WORKDIR /var/www/html/
 - ENV MODE_ENV=development
 - #RUN composer install
 - ENTRYPOINT php -S 0.0.0.0:9000 -t ./public
 - EXPOSE 9000

### Execute Dockerfile
 - docker build -f Dockerfile -t celsob/php .
 - docker run -d -p 9000:9000 --network net-app celsob/php

### docker virtual network default
The network default is not permission to create the your owner host name, so you will need create a new network.
 - install ping to test
  - apt-get update && apt-get install -y iputils-ping
 - Inspect detais of the container
  - docker inspect <id-container>

### Create your network
 - Create network: docker network create --driver bridge <name-network>
 - List network: docker network ls
 - Add container in the network: docker run -it --name meu-container --network <name-network> ubuntu
 - Ping container by name: ping <container-name>
 - inspect the nework: docker network inspect <name-network>

### docker composer
 - Create the images: docker-compose build
 - Up service: docker-compose up

### Create mysql service
 - docker run --name=m-server -p 3306:3306 -v "/mysql/dbdata:/var/lib/mysql" -e MYSQL_ROOT_PASSWORD=123456 -d mysql/mysql-server:5.7.29
 - access bash: docker exec -it m-server bash
 - Access mysql:  mysql -u root -p
 - Add permissions: mysql -u root -p
    Enter password: <enter password>
    mysql> GRANT ALL ON *.* to root@'123.123.123.123' IDENTIFIED BY 'put-your-password';
    mysql>FLUSH PRIVILEGES;
    mysql>exit

### docker ps
 - reset && docker ps --format "table {{.ID}}\t{{.Image}}\t{{.Ports}}\t{{.Names}}"

### Segue a lista com os principais comandos utilizados durante o curso:

#### Comandos relacionados às informações
 - docker version - exibe a versão do docker que está instalada.
 - docker inspect ID_CONTAINER - retorna diversas informações sobre o container.
 - docker ps - exibe todos os containers em execução no momento.
 - docker ps -a - exibe todos os containers, independentemente de estarem em execução ou não.
 - docker rm <container-id> --force "Stop and delete the container"

#### Comandos relacionados à execução
 - docker run NOME_DA_IMAGEM - cria um container com a respectiva imagem passada como parâmetro.
 - docker run -it NOME_DA_IMAGEM - conecta o terminal que estamos utilizando com o do container.
 - docker run -d -P --name NOME dockersamples/static-site - ao executar, dá um nome ao container e define uma porta aleatória.
 - docker run -d -p 12345:80 dockersamples/static-site - define uma porta específica para ser atribuída à porta 80 do container, neste caso 12345.
 - docker run -v "CAMINHO_VOLUME" NOME_DA_IMAGEM - cria um volume no respectivo caminho do container.
 - docker run -it --name NOME_CONTAINER --network NOME_DA_REDE NOME_IMAGEM - cria um container especificando seu nome e qual rede deverá ser usada.

#### Comandos relacionados à inicialização/interrupção
 - docker start ID_CONTAINER - inicia o container com id em questão.
 - docker start -a -i ID_CONTAINER - inicia o container com id em questão e integra os terminais, além de permitir interação entre ambos.
 - docker stop ID_CONTAINER - interrompe o container com id em questão.

#### Comandos relacionados à remoção
 - docker rm ID_CONTAINER - remove o container com id em questão.
 - docker container prune - remove todos os containers que estão parados.
 - docker rmi NOME_DA_IMAGEM - remove a imagem passada como parâmetro.

#### Comandos relacionados à construção de Dockerfile
 - docker build -f Dockerfile - cria uma imagem a partir de um Dockerfile.
 - docker build -f Dockerfile -t NOME_USUARIO/NOME_IMAGEM - constrói e nomeia uma imagem não-oficial.
 - docker build -f Dockerfile -t NOME_USUARIO/NOME_IMAGEM CAMINHO_DOCKERFILE - constrói e nomeia uma imagem não-oficial informando o caminho para o Dockerfile.

#### Comandos relacionados ao Docker Hub
 - docker login - inicia o processo de login no Docker Hub.
 - docker push NOME_USUARIO/NOME_IMAGEM - envia a imagem criada para o Docker Hub.
 - docker pull NOME_USUARIO/NOME_IMAGEM - baixa a imagem desejada do Docker Hub.

#### Comandos relacionados à rede
 - hostname -i - mostra o ip atribuído ao container pelo docker (funciona apenas dentro do container).
 - docker network create --driver bridge NOME_DA_REDE - cria uma rede especificando o driver desejado.

#### Comandos relacionados ao docker-compose
 - docker-compose build - Realiza o build dos serviços relacionados ao arquivo docker-compose.yml, assim como verifica a sua sintaxe.
 - docker-compose up - Sobe todos os containers relacionados ao docker-compose, desde que o build já tenha sido executado.
 - docker-compose down - Para todos os serviços em execução que estejam relacionados ao arquivo docker-compose.yml.

#### Segue também uma breve lista dos novos comandos utilizados:
 - docker-compose up - sobe os serviços criados
 - docker-compose down - para os serviços criados.
 - docker-compose ps - lista os serviços que estão rodando.
 - docker exec -it alura-books-1 ping node2- executa o comando ping node2 dentro do container alura-books-1

## Docker Swarm
 - Orquestrador de containers (to work with this technologic we needed install the virtualbox to create the a cluster and we needed also the docker-machine to creater VMs)

### Basic commands
 - docker-machine ls
 - docker-machine -v
 - docker-machine create -d virtualbox <name-of-vm>
 - docker-machine rm -y <name-of-vm>
 - docker-machine start <name-of-vm>
 - docker-machine ssh <name-of-vm> (to enter on machine)
 - docker swarm init --advertise-addr 192.168.99.100 (create the manage swarm or Cluster)
 - docker info (list if swarm is active)
 - docker swarm join-token worker (Get the command that will be puted into the machine workers, this command will be executed inside the machine manage)

### Error when create IP, you can fix with step below:
  Thanks to this comment on Reddit, I was able to figure the issue out:

  find all the machines with docker-machine ls
  remove the ones you don't need with docker-machine rm -y <machineName>
  find all the "host-only ethernet adapters" with VBoxManage list hostonlyifs
  Remove the orphaned ones with VBoxManage hostonlyif remove <networkName>
  Create a vbox folder in the etc directory with sudo mkdir
  Create a file networks.conf in the vbox folder, for example by sudo touch
  place the below line there
  - * 0.0.0.0/0 ::/0
  create a new machine with docker-machine create -d virtualbox <machineName>

  This font: https://stackoverflow.com/questions/70281938/docker-machine-unable-to-create-a-machine-on-macos-vboxmanage-returning-e-acces

  ### Into of the manage machine to manage the node
   - docker node ls
   - docker node rm <id-machine> (where: into manage machine)
   - docker node leave (where: into of the node or worker)
   -

## NGINX
 - Servidor web
### Commands
 - nginx -h [Return the a lis of commands]
 - nginx -s [reload (Reload the nginx]
 - nginx -t [Return ok if your default.conf is with correct sintaxe]
 -

## Setings XDEBUG
 - [https://www.google.com/search?q=configurando+xdebug+com+docker&oq=configurando+xdebug+com+docker&aqs=chrome..69i57.11878j0j7&sourceid=chrome&ie=UTF-8#fpstate=ive&vld=cid:46e47605,vid:kbq3FJOYmQ0]

### documentation
 - [https://xdebug.org/docs/]

### Install KCacheGrind to test performance
 - sudo apt install kcachegrind
 - kcachegrind <file-name> [ex: kcachegrind cachegrind.out.17]

### Configure the webgrind
 - php -dxdebug.output_dir=/home/celso/projeto-docker-php/logs/php/performance -S localhost:8124

## log errors of the PHP with docker
 - docker logs -f --details <containerName>

## Install workbench
 - sudo snap install mysql-workbench-community
### Settings password error
 - Vá para Ubuntu Software.
 - Pesquise mysql-workbenche clique em Mysql Workbench Community.
 - Clique em Permissions.
 - Habilite Read, add, change, or remove saved password̀se ssh-keys(se você também estiver usando chaves ssh)

## PHPCS Install and settings
 - Install PHPCS: composer require "squizlabs/php_codesniffer=*" [https://github.com/squizlabs/PHP_CodeSniffer]
 - Install Standard Drupal: composer require drupal/coder [https://www.drupal.org/docs/contributed-modules/code-review-module/installing-coder-sniffer]
 - Install extension: PHP Sniffer v1.3.0 [https://marketplace.visualstudio.com/items?itemName=wongjn.php-sniffer]
 - Execute tests: ./vendor/bin/phpcs --standard=Drupal ./src/Controller/ProfileAnalisePerformance.php
 - Setttings auto save in user formatter on VSCODE do phpcbf
 - This congig settings:
 - {
    "phpSniffer.autoDetect": true,
    "phpSniffer.executablesFolder": "/home/celso/projeto-docker-php/vendor/bin/",
    "[php]": {
      "editor.defaultFormatter": "wongjn.php-sniffer"
    },
    "phpSniffer.standard": "Drupal",
    "phpSniffer.run": "onSave",
  }

## Settings environmet variables
 - Create the ".env" file
 - Add in the docker-compose the env_file and put the file "- ./.env", how the first index of the array.
 - To conclude the process access the variable with global variable "$_SERVER".
 - This reference [https://stackoverflow.com/questions/46917831/how-to-load-several-environment-variables-without-cluttering-the-dockerfile]
