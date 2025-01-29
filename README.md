# Messenger

Projeto simples para teste e aprendizado de uso de websockets.
Para tal feito, foram utilizadas as seguintes tecnologias:

* PHP;
* Laravel;
* Pacotes:
    * [Laravel Reverb](https://laravel.com/docs/11.x/reverb);
    * [vyuldashev/laravel-queue-rabbitmq](https://github.com/vyuldashev/laravel-queue-rabbitmq);
* MongoDB;
* Sqlite;
* Docker.

## Instalação

Após clonar o projeto rode os seguintes comandos para configurar o ambiente:
* Faça uma cópia do escopo do arquivo de configuração ```cp .env.example .env``` e altere, de acordo com suas preferências, as seguintes credenciais do Reverb ```REVERB_APP_ID```, ```REVERB_APP_KEY```, ```REVERB_APP_SECRET``` dentro do arquivo copiado ```.env```.


Rode:
``` 
docker-compose up -d
```
Após a construção dos containers, rode o seguinte comando para entrar no container e instalar os pacotes:
```
docker exec -it messenger_app bash
```
Logo após:
```
composer install
```
e:
```
npm install && npm run build
```

### Banco de dados

É de suma importância que crie um arquivo denominado ```database.sqlite``` dentro da pasta raiz ``` database ```.

### Recomendações

Para alterações ou possíveis bugs, entrar dentro do continer ``` messenger_app ``` e rodar :
```
npm run build
```
e
```
php artisan optimize:clear
```