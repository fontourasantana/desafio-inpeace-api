# Desafio InPeace - Módulo Api

### Primeiros passos
- Primeiro é necessário fazer a cópia do repositório
```bash
git clone https://github.com/fontourasantana/desafio-inpeace-api
```
- Após copiar o repositório é necessário instalar as depedências do projeto
```bash
composer install --optimize-autoloader --no-dev
```
- Copiar exemplo do .env fornecido no repositório
```bash
cp .env.example .env
```
- Com as dependências instaladas e .env configurado, para rodar a aplicação basta executar o seguinte comando:
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

### Rotas da API
|Identificação|URL|METHOD|
|:---:|:---:|:---:|
|    Versão do Lumen     | localhost |**GET**|
|    Listar usuários     | localhost/usuarios |**GET**|
|    Salvar usuário     | localhost/usuarios |**POST**|
|    Ver usuário     | localhost/usuarios/{id} |**GET**|
|    Atualizar usuário     | localhost/usuarios/{id} |**PUT**|
|    Deletar usuário     | localhost/usuarios/{id} |**DELETE**|
