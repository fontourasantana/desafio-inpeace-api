# Desafio InPeace - Módulo Api

Este repositório tem como objetivo fornecer a API utilizada no desafio proposto.\
O projeto completo pode ser encontrado no repositório [Desafio Inpeace](https://github.com/fontourasantana/desafio-inpeace)

## Requisitos

|Ferramenta|Versão Testada|
|:-:|:-:|
|[Docker Engine](https://docs.docker.com/engine/)|20.10.11|
|[Docker Compose](https://docs.docker.com/compose/)|1.28.5|
|[GNU Make](https://www.gnu.org/software/make/)|4.2.1|

## Primeiros passos

- Primeiro é necessário fazer a cópia do repositório
```bash
git clone https://github.com/fontourasantana/desafio-inpeace-api && cd desafio-inpeace-api
```

- Após copiar o repositório copie o exemplo do .env fornecido no repositório
```bash
cp .env.example .env
```
**Obs:** O webserver por padrão roda na porta **80**, caso essa porta esteja sendo utilizada no sistema, basta alterar a váriavel de ambiente **WEBSERVER_PORT** no .env

- Com as variáveis de ambiente configuradas, para buildar e rodar o projeto execute:
```bash
make
```
- Após execução do comando `make` o projeto já estará executando, para detalhes das rotas acessar [Rotas do webserver](#rotas-do-webserver)

**Atenção:** Para o funcionamento adequado da API, é necessário rodar as migrations. Para isso rode o seguinte comando com o projeto em execução completamente inicializado (na primeira inicialização o serviço do mysql demora um pouco para inicializar por completo):
```bash
make run-migrates
```
- Para mais comandos acessar [Comandos opcionais](#comandos-opcionais)

## Executando projeto

- Para iniciar a execução no projeto rode o comando:
```bash
make up
```
- Para parar a execução no projeto rode o comando:
```bash
make down
```

## Comandos opcionais

- Para uma melhor experiência, caso deseje que o banco de dados seja povoado você pode rodar o comando que faz o seed no banco:
```bash
make run-seeders
```
- Para rodar os testes da API:
```bash
make run-tests
```
**Obs:** Para rodar os testes é necessário estar com a imagem da api buildada
- Para buildar a imagem da api:
```bash
make build-api
```

## Rotas do webserver

|         Identificação         |                   URL                    |
|:-------------------------:|:----------------------------------------:|
|    phpMyAdmin     | [phpmyadmin.localhost](http://phpmyadmin.localhost/) |
|  API  | [localhost](http://localhost/) |

*Rotas considerando webserver na porta 80*

## Rotas da api

|Identificação|URL|METHOD|
|:---:|:---:|:---:|
|    Versão do Lumen     | {API_URL} |**GET**|
|    Listar usuários     | {API_URL}/usuarios |**GET**|
|    Salvar usuário     | {API_URL}/usuarios |**POST**|
|    Ver usuário     | {API_URL}/usuarios/{id} |**GET**|
|    Atualizar usuário     | {API_URL}/usuarios/{id} |**PUT**|
|    Deletar usuário     | {API_URL}/usuarios/{id} |**DELETE**|

**Obs:** Considerar **{API_URL}** a rota para a URL da API fornecida pelo webserver
