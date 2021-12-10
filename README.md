# Desafio InPeace - Módulo Api
Este repositório tem como objetivo fornecer a API utilizada no desafio proposto.\
O projeto completo pode ser encontrado no repositório [Desafio Inpeace](https://github.com/fontourasantana/desafio-inpeace)

## Requisitos
|Ferramenta|Versão Testada|
|:-:|:-:|
|[Docker Engine](https://docs.docker.com/engine/)|20.10.11|
|[Docker Compose](https://docs.docker.com/compose/)|1.28.5|
|[GNU Make](https://www.gnu.org/software/make/)|4.2.1|

### Primeiros passos
- Primeiro é necessário fazer a cópia do repositório
```bash
git clone https://github.com/fontourasantana/desafio-inpeace-api
```
- Para preparar o projeto para execução, rode:
```bash
make
```
**Obs:** O webserver por padrão roda na porta **80**, caso essa porta esteja sendo utilizada no sistema, basta alterar a váriavel de ambiente **WEBSERVER_PORT** no .env\
\
**Atenção:** Para o funcionamento adequado da API, é necessário rodar as migrations. Para isso rode o seguinte comando com o projeto em execução:
```bash
make run-migrates
```

### Executando projeto
```bash
make up
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
|    Versão do Lumen     | {API_URL} |**GET**|
|    Listar usuários     | {API_URL}/usuarios |**GET**|
|    Salvar usuário     | {API_URL}/usuarios |**POST**|
|    Ver usuário     | {API_URL}/usuarios/{id} |**GET**|
|    Atualizar usuário     | {API_URL}/usuarios/{id} |**PUT**|
|    Deletar usuário     | {API_URL}/usuarios/{id} |**DELETE**|

**Obs:** Considerar **{API_URL}** a rota para a URL da API fornecida pelo webserver
