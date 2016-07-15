#Webservice Restfull with Slim Framework PHP using JWT Authentication (Json Web Token)

### Instalar dependências do composer:
php composer.phar install

### Iniciar o servidor php
php -S localhost:8080 -t public/

### Gerar token (Postman)
POST em http://localhost:8080/auth

### Testar Permissão de Acesso (Postman)
GET em http://localhost:8080/api <br>
Deve ser passado o header: Autorization: Bearer + token (gerado anteriormente) <br>

Pode-se testar o jwt em seu site oficial (jwt.io) <br>
A validação do token é feita a partir de uma key secret, a mesma esta defina em app.php -> $container["secret"]

