# Entrega da atividade

Este projeto implementa o método `update` no `App\Services\ProductService`.

A regra de negócio adotada é que o preço do produto deve ser maior que zero. Por isso, uma tentativa de criar ou atualizar um produto com preço zero, negativo ou não numérico lança `ValidationException` e não salva a alteração.

## Como executar

```bash
cd /home/ubuntu/laravel-service-tests
php artisan migrate
php artisan test
php artisan serve
```

A aplicação usa SQLite em `database/database.sqlite`, então não depende de MySQL ou outro serviço externo.

## Testes entregues

`tests/Unit/ProductServiceTest.php` contém um teste para garantir que um produto inválido não é criado e dois testes para `update`: um cenário de sucesso e um cenário em que a regra de negócio impede o novo preço.

## Endpoints

- `POST /api/products`: cria produto com `name` e `price`.
- `PUT /api/products/{product}`: atualiza nome e/ou preço.
- `PATCH /api/products/{product}`: atualização parcial.
