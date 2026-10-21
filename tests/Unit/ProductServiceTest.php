<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class ProductServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_product_is_not_created_when_price_does_not_follow_business_rule(): void
    {
        try {
            app(ProductService::class)->create([
                'name' => 'Produto inválido',
                'price' => 0,
            ]);
            $this->fail('Era esperada uma ValidationException.');
        } catch (ValidationException $exception) {
            $this->assertSame(
                'O preço do produto deve ser maior que zero.',
                $exception->errors()['price'][0]
            );
        }

        $this->assertDatabaseCount('products', 0);
    }

    public function test_update_changes_product_name_and_price(): void
    {
        $product = Product::create([
            'name' => 'Nome antigo',
            'price' => 10,
        ]);

        $updated = app(ProductService::class)->update($product, [
            'name' => 'Nome atualizado',
            'price' => 25.50,
        ]);

        $this->assertSame($product->id, $updated->id);
        $this->assertSame('Nome atualizado', $updated->name);
        $this->assertSame('25.50', $updated->price);
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'Nome atualizado',
            'price' => 25.50,
        ]);
    }

    public function test_update_rejects_a_price_that_breaks_the_business_rule(): void
    {
        $product = Product::create([
            'name' => 'Produto válido',
            'price' => 10,
        ]);

        try {
            app(ProductService::class)->update($product, ['price' => -1]);
            $this->fail('Era esperada uma ValidationException.');
        } catch (ValidationException $exception) {
            $this->assertSame('10.00', $product->fresh()->price);
            $this->assertSame(
                'O preço do produto deve ser maior que zero.',
                $exception->errors()['price'][0]
            );
        }
    }
}
