# laravel-api
## API simples em Laravel com autenticação utilizando Passport


##**Requisitos**

*Obrigatórios*

- [PHP >= 7.1.3](http://php.net/downloads.php)
- [Composer](https://getcomposer.org/download/)
- [Laravel Framework 5.7.10](https://laravel.com/docs/5.7#installation)
- [MySQL](https://dev.mysql.com/downloads/)

*Opcionais*

- [Postman](https://www.getpostman.com/apps)


##**Configurações**

- Clonar este projeto utilizando o comando `git clone https://github.com/jgivago/laravel-api.git `
- Criar um database no **MySQL**
- Criar uma cópia do **.env.example**, renomear para **.env** e preencher com os dados do seu ambiente local (Conexão com DB, Nome do DB, Debug, etc)
- Executar o comando `php artisan config:cache` para limpar o cache do arquivo **.env**
- Executar o comando `php artisan migrate` para rodar as migrations e criar a estrutura do DB
- Executar o comando `php artisan key:generate` para gerar uma nova *Application Key*
- Executar o comando `php artisan serve` para startar um *Server de Dev*


##**Como Testar?**

- Importar o arquivo `API.postman_collection.json` no Postman (Todos os endpoints já estão configurados)
- Alguns métodos funcionarão apenas para o usuário autenticado. Estes estarão identificados com uma notação *[AUT]*.
Para estes casos, será necessário passar o *access_token* (que será retornado após o Login) no header da requisição
Ex: `key: Authorization` `Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6Ijc5MzkyNDgwMjhi`
