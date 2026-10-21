<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Validation\ValidationException;

class ProductService
{
    /**
     * Regra de negócio: um produto só pode ter preço maior que zero.
     *
     * @param  array{name:string,price:numeric}  $data
     */
    public function create(array $data): Product
    {
        $this->validateBusinessRule($data['price'] ?? null);

        return Product::create([
            'name' => $data['name'],
            'price' => $data['price'],
        ]);
    }

    /**
     * Atualiza um produto respeitando a mesma regra de negócio da criação.
     *
     * @param  array{name?:string,price?:numeric}  $data
     */
    public function update(Product $product, array $data): Product
    {
        if (array_key_exists('price', $data)) {
            $this->validateBusinessRule($data['price']);
        }

        $product->fill($data);
        $product->save();

        return $product->refresh();
    }

    private function validateBusinessRule(mixed $price): void
    {
        if (! is_numeric($price) || (float) $price <= 0) {
            throw ValidationException::withMessages([
                'price' => 'O preço do produto deve ser maior que zero.',
            ]);
        }
    }
}
