# osTicketKanban
Olá pessoas, 

Este é o repositório que criei para compartilhar com vocês o desenvolvimento do projeto de criação de uma Kanboard para ser usada com os dados do [OsTicket](https://github.com/osTicket).

# O que é o OsTicket

Resumidamente é um sistema de bilhetagem/ordem de serviços *open source* muito bom, simples e leve que
é usado largamente mundo afora.

# Imagens do docker

Para facilitar meus testes e desenvolvimento, criei containers do docker para uso de uma instalação limpa do OsTicket.

No fim eles acabaram se ficando prontos para uso de quem quiser testar o sistema de tickets sem instalar toda a base em seu local de trabalho. Disponibilizei as imagens em meu hub docker no link abaixo:

> LEIA ISTO ANTES DE CONTINUAR! **DISCLAIMER**

> Esta *stack* foi criada para o desenvolvimento do meu projeto e ela é livre para uso em forma de testes. Contudo, se você gostou da aplicação e pretende usar ela em seu ambiente de produção, utilize sempre os repositórios oficiais (que estão *linkados* dentro do texto).

https://hub.docker.com/r/mronh/ticket/tags

Percebam que eu criei tags diferentes dentro desse hub para deixar cada imagem responsável por suas próprias questões.

mronh/ticket:base é a imagem que contém o apache2 + php7.4 (e suas libs auxiliaries)

mronh/ticket:dbinit como o nome supõe é a imagem que contém o mariadb cru. Que será populado pelo setup existente na primeira execução do ticket base.

# Executando cada imagem separadamente
Caso você queira executar cada uma das imagens separadamente para conhecer o ecossistema *docker+osticket* que eu propus, siga os passos abaixo (contudo, deixo aqui registrado que este não é o cenário ideal. Idealmente deve-se usar o docker compose para o uso de sistemas *multicontainer*)

* Criar uma rede que englobará os contêineres 

`docker network create osTicketNetwork`

* Rodar mariaDB a partir da imagem *mronh/ticket:dbinit* 

`docker run --network osTicketNetwork -p 3306:3306 -v d:/dbticket:/var/lib/mysql --name ticketDB -e MYSQL_ROOT_PASSWORD=osticket -d mronh/ticket:dbinit`


> Observe que há o mapeamento da pasta de persistência do DB para que não haja perda dos dados ao reinstanciar a imagem. Modifique conforme sua necessidade. `-v d:/dbticket:/var/lib/mysql`

> Observe o nome  da instância *ticketDB* pois ela será usada durante o setup do osTicket *MySQL Hostname:*

* Rodar o osTicket a partir da imagem disponibilizada em  *mronh/ticket:base* (para usar estas imagens para customização de seu OsTicket e testar coisas, recomendo usar o mapeamento da pasta `/var/www/html/` nos moldes do mapeamento usado acima)

`docker.exe run --network osTicketNetwork --name ticketSRV -dp 80:80 -p443:443 mronh/ticket:base`


# Docker compose

Neste repositório há o arquivo *Docker-compose.yml* que contém os parâmetros necessários para que ambas imagens iniciais conversem entre si, executando somente o seguinte comando:

`Docker-compose up -d` para iniciar a orquestração
`Docker-compose down`  para parar a orquestração

> lembre-se de que para executar esse comando é necessário que o docker esteja instalado na máquina destino E que o comando seja executado na pasta onde o aquivo yml se encontra. Maiores informações de uso do docker-compose verifique a ótima [documentação](http://localhost/tutorial/using-docker-compose/) do próprio docker.

# ATENÇÃO

Lembre-se de alterar os dados de mapeamento, sejam eles na execução direta do container, seja pela execução do compose (veja o arquivo docker-compose.yml para maiores detalhes). Note também que ao mapear uma pasta compartilhada no servidor apache *ticketSRV* você precisará copiar arquivos do OsticketKanban para esta pasta (o servidor estará usando uma pasta do seu computador e não uma pasta interna do container, isto é muito útil e prático para desenvolvimento e testes).

Uma forma que fazer isto é clonando este repositório do git na pasta destino do mapeamento. Use o comando:

`git clone https://github.com/marioneis/osTicketKanban.git <diretorio mapeado>` (os fontes ficarão dentro da pasta `src`).


**DISCLAIMER 2**
O desenvolvimento da dash de kanban será feito durante os períodos de calma durante meu expediente no trabalho, então tanto pode ser que ele se desenvolva rápido como pode ser que seja lentamente (a sorte e o tempo dirão). Quando houver alguma versão utilizável de fato, colocarei ela na master e atualizarei os dados aqui. Deste modo, use a branch `dev` por sua conta e risco. Ela pode estar com muita coisa *quebrada* (certamente estará).

Todo feedback e sugestão de melhoria é bem vindo, as issues ficarão abertas. Se você também é um usuário do OsTicket e gosta de kanban sinta-se à vontade para colaborar.


> DICA

> Observe que estas imagens pode ser utilizada para outros projetos que utilizem o php7.4+apache+mariaDB, apenas precisando adicionar novos volumes no arquivo yml e os direcionando para a pasta `/var/www/html` do apache que existe no container. 


# UPDATE (21/08/2020)

O acesso ao board se dará pelo link adicionado à dash de suporte (limitação para apenas admins será implementado no futuro). Conforme imagem.

<img style='height: 100%; width: 100%; object-fit: contain' src="/img_readme/acesso_kanban.JPG">


Os arquivos vinculados ao projeto estão dentro de `scp/kanban` (no momento há apenas um mock das divs a serem usadas pela implementação)