# Plano — Atividade de Service e Testes

## Implementação

Usar Laravel com SQLite para manter o projeto simples de executar. O domínio terá um modelo `Product`, uma migration e `ProductService` como camada responsável por criação e atualização. O service centraliza a regra de negócio de que o preço deve ser maior que zero. Um controller HTTP demonstra a injeção do service, e testes de unidade usam `RefreshDatabase`.

## Estrutura

- `app/Models/Product.php`: entidade persistida.
- `app/Services/ProductService.php`: criação, atualização e regra de negócio.
- `app/Http/Controllers/ProductController.php`: endpoints de exemplo.
- `database/migrations/...create_products_table.php`: tabela SQLite.
- `tests/Unit/ProductServiceTest.php`: três testes solicitados.

## Estilo

- **Service-first pragmático** (0,07): código direto, legível e adequado a uma atividade acadêmica.
- **API minimalista** (0,05): endpoints pequenos para demonstrar a integração.
- **Arquitetura corporativa** (0,04): separação mais extensa de contratos e DTOs.

Escolha: Service-first pragmático, priorizando clareza para leitura e execução pelo aluno.
