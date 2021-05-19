# zf1-usersregister-withupload
CRUD de usuários com upload de arquivos

# Tecnologias
PHP 7.4
Zend Framework 1.12 (Full)
PostgreSQL
Bootsrap 3.3.7
JQuery 1.12

# Observações
Após clonar repositório, executar o
dump do banco de dados que se encontra 
dentro de \database\dump_pgsql.sql

# EndPoints API Rest
Busca por id de Usuário
[url]/user/rest?method=getUser&id=[id]

Listar todos os usuários ativos
[url]/user/rest?method=listUsers