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
- Com as dependências instaladas, para rodar a aplicação basta executar o seguinte comando:
```bash
docker-compose up -d
```
**Obs:** Para funcionamento da aplicação é necessário rodar as migrations na primeira inicialização. Para isso execute o comando:
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
|    Ver usuário     | localhost/usuarios/{id} |**GET**|
|    Salvar usuário     | localhost/usuarios/{id} |**POST**|
|    Atualizar usuário     | localhost/usuarios/{id} |**PUT**|
|    Deletar usuário     | localhost/usuarios/{id} |**DELETE**|
