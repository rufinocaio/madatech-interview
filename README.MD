# Interview Madatech

Os arquivos do projeto CodeIgniter estão presentes na pasta /src.

Para o desenvolvimento do projeto foi utilizado Code Igniter 4 e docker para criação do ambiente isolado.
Para sua execução:
``` bash
docker compose up
```
Após a execução do compose, e com o container rodando, executar a instalação dos pacotes composer e a migração do banco de dados:
``` bash
docker exec -it madatech-interview-app composer update
docker exec -it madatech-interview-app php spark migrate
```

A aplicação ficará acessível pelo link localhost:8080.
Uma aplicação do phpMyAdmin também ficará acessível pelo link localhost:9090.

Há uma coleção do Postman no arquivo 'Madatech Interview.postman_collection.json' para testes da api criada no programa.