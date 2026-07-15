<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::firstOrCreate([
            'email' => 'test@example.com',
        ], [
            'name' => 'Test User',
            'password' => bcrypt('password'),
        ]);

        $products = [
            ['name' => 'Auriculares inalámbricos', 'description' => 'Auriculares Bluetooth con cancelación de ruido y batería de larga duración.', 'price' => 999.00, 'stock' => 20],
            ['name' => 'Cargador rápido USB-C', 'description' => 'Cargador de 65W con cable USB-C incluido para laptops y móviles.', 'price' => 740.02, 'stock' => 94],
            ['name' => 'Teclado mecánico retroiluminado', 'description' => 'Teclado con switches táctiles y luces RGB personalizables.', 'price' => 410.63, 'stock' => 5],
            ['name' => 'Mouse óptico gamer', 'description' => 'Mouse ergonómico de alta precisión con botones programables.', 'price' => 253.44, 'stock' => 30],
            ['name' => 'Smartwatch deportivo', 'description' => 'Reloj inteligente con monitor de ritmo cardíaco y GPS integrado.', 'price' => 645.28, 'stock' => 6],
            ['name' => 'Altavoz Bluetooth portátil', 'description' => 'Altavoz resistente al agua con sonido estéreo y batería para 12 horas.', 'price' => 122.00, 'stock' => 56],
            ['name' => 'Disco SSD 1TB', 'description' => 'Unidad de estado sólido NVMe de 1TB para velocidad de transferencia superior.', 'price' => 74.15, 'stock' => 3],
            ['name' => 'Memoria RAM 16GB', 'description' => 'Módulo DDR4 de 16GB para mejorar el rendimiento de tu PC.', 'price' => 300.06, 'stock' => 52],
            ['name' => 'Monitor 24" Full HD', 'description' => 'Pantalla LED 24 pulgadas con 75Hz y soporte ajustable.', 'price' => 751.10, 'stock' => 79],
            ['name' => 'Cámara web HD', 'description' => 'Cámara para videollamadas con micrófono integrado y enfoque automático.', 'price' => 715.83, 'stock' => 57],
            ['name' => 'Impresora multifunción', 'description' => 'Impresora con escáner y conexión Wi-Fi para oficina en casa.', 'price' => 395.90, 'stock' => 91],
            ['name' => 'Bolsa para laptop 15"', 'description' => 'Bolsa acolchada resistente al agua para portátiles y accesorios.', 'price' => 817.13, 'stock' => 30],
            ['name' => 'Cámara de seguridad Wi-Fi', 'description' => 'Cámara digital con visión nocturna y detección de movimiento.', 'price' => 896.82, 'stock' => 29],
            ['name' => 'Router dual band', 'description' => 'Router inalámbrico con antenas externas y configuración fácil.', 'price' => 270.07, 'stock' => 75],
            ['name' => 'Teclado inalámbrico compacto', 'description' => 'Teclado Bluetooth con diseño compacto y batería recargable.', 'price' => 878.95, 'stock' => 100],
            ['name' => 'Lámpara LED de escritorio', 'description' => 'Lámpara con intensidad ajustable y carga inalámbrica para móviles.', 'price' => 199.50, 'stock' => 40],
            ['name' => 'Soporte para laptop', 'description' => 'Soporte ajustable para portátiles con ventilación integrada.', 'price' => 129.99, 'stock' => 15],
            ['name' => 'Adaptador HDMI 4K', 'description' => 'Adaptador de vídeo HDMI compatible con resoluciones hasta 4K.', 'price' => 89.90, 'stock' => 65],
            ['name' => 'Cámara instantánea', 'description' => 'Cámara fotográfica instantánea para imprimir al momento.', 'price' => 249.00, 'stock' => 12],
            ['name' => 'Batería externa 20.000 mAh', 'description' => 'Power bank de alta capacidad con carga rápida para varios dispositivos.', 'price' => 179.99, 'stock' => 34],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate([
                'name' => $product['name'],
            ], array_merge($product, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
