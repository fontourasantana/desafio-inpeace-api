# Desafio InPeace - Módulo Api

### Primeiros passos
- Primeiro é necessário fazer a cópia do repositório
```bash
git clone https://github.com/fontourasantana/desafio-inpeace-api
```
- Copiar exemplo do .env fornecido no repositório
```bash
cp .env.example .env
```
**Obs:** O webserver por padrão roda na porta 80, caso essa porta esteja sendo utilizada no sistema, basta alterar a váriavel de ambiente **WEBSERVER_PORT** no .env
- Com o .env configurado para rodar a aplicação basta executar o seguinte comando:
```bash
docker-compose up -d
```
**Obs:** Para funcionamento da aplicação é necessário rodar as migrations na primeira inicialização. Para isso com os containers rodando, execute o comando:
```bash
docker-compose exec api php artisan migrate
```

### Rotas que o webserver fornece
|         Identificação         |                   URL                    |
|:-------------------------:|:----------------------------------------:|
|    phpMyAdmin     | [phpmyadmin.localhost](http://phpmyadmin.localhost/) |
|  API  | [localhost](http://localhost/) |

*Rotas considerando webserver na porta 80*

### Rotas da API
|Identificação|URL|METHOD|
|:---:|:---:|:---:|
|    Versão do Lumen     | localhost |**GET**|
|    Listar usuários     | localhost/usuarios |**GET**|
|    Salvar usuário     | localhost/usuarios |**POST**|
|    Ver usuário     | localhost/usuarios/{id} |**GET**|
|    Atualizar usuário     | localhost/usuarios/{id} |**PUT**|
|    Deletar usuário     | localhost/usuarios/{id} |**DELETE**|

*Rotas considerando webserver na porta 80*
