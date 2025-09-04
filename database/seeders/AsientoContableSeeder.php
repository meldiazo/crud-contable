<?php

namespace Database\Seeders;

use App\Models\AsientoContable;
use Illuminate\Database\Seeder;

class AsientoContableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        AsientoContable::create([
            'fecha' => now(),
            'descripcion' => 'Venta de mercaderia a cliente XYZ',
            'monto_debe' => 1500.00,
            'monto_haber' => 1500.00,
            'cuenta_debe' => 'Caja',
            'cuenta_haber' => 'Ingresos por Ventas',
        ]);

        AsientoContable::create([
            'fecha' => now()->subDays(2),
            'descripcion' => 'Pago de salario a empleados',
            'monto_debe' => 500.50,
            'monto_haber' => 500.50,
            'cuenta_debe' => 'Gastos de Salario',
            'cuenta_haber' => 'Bancos',
        ]);
    }
}
