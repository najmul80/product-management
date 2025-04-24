<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            ['name' => 'ACI Pure Salt', 'description' => 'Refined iodized salt for daily use.', 'price' => 25.00, 'stock' => 100],
            ['name' => 'Fresh Atta', 'description' => 'Whole wheat flour ideal for making roti.', 'price' => 45.00, 'stock' => 80],
            ['name' => 'Radhuni Turmeric Powder', 'description' => 'High-quality turmeric powder for curries.', 'price' => 30.00, 'stock' => 60],
            ['name' => 'Pran Mustard Oil', 'description' => 'Pure mustard oil for traditional cooking.', 'price' => 120.00, 'stock' => 50],
            ['name' => 'Teer Sugar', 'description' => 'Refined white sugar for household use.', 'price' => 90.00, 'stock' => 75],
            ['name' => 'Molla Ghee', 'description' => 'Deshi-style ghee perfect for biryani.', 'price' => 210.00, 'stock' => 40],
            ['name' => 'Bashundhara Tissue', 'description' => 'Soft and absorbent facial tissue.', 'price' => 35.00, 'stock' => 90],
            ['name' => 'Parachute Coconut Oil', 'description' => 'Natural coconut oil for hair care.', 'price' => 85.00, 'stock' => 65],
            ['name' => 'Ruchi Chanachur', 'description' => 'Spicy and crunchy snack mix.', 'price' => 20.00, 'stock' => 120],
            ['name' => 'Horlicks 500g', 'description' => 'Health drink with essential nutrients.', 'price' => 380.00, 'stock' => 30],
            ['name' => 'Moov Pain Relief Cream', 'description' => 'Effective cream for joint and muscle pain.', 'price' => 120.00, 'stock' => 25],
            ['name' => 'Fay Tissue Box', 'description' => 'Decorative box tissue for home/office.', 'price' => 50.00, 'stock' => 100],
            ['name' => 'Meril Baby Lotion', 'description' => 'Gentle lotion for baby skin care.', 'price' => 140.00, 'stock' => 45],
            ['name' => 'Bombay Sweets Potato Crackers', 'description' => 'Crunchy and salty snack.', 'price' => 15.00, 'stock' => 130],
            ['name' => 'Coca-Cola 1L', 'description' => 'Classic soft drink for refreshment.', 'price' => 45.00, 'stock' => 200],
            ['name' => 'Nestlé Nido Milk Powder', 'description' => 'Full cream milk powder for kids.', 'price' => 520.00, 'stock' => 20],
            ['name' => 'Lux Soap', 'description' => 'Beauty soap with floral fragrance.', 'price' => 45.00, 'stock' => 85],
            ['name' => 'Lifebuoy Handwash Refill', 'description' => 'Anti-bacterial hand wash.', 'price' => 75.00, 'stock' => 60],
            ['name' => 'Pran Mango Juice 1L', 'description' => 'Delicious mango-flavored juice.', 'price' => 85.00, 'stock' => 50],
            ['name' => 'Dettol Soap', 'description' => 'Antiseptic soap for hygiene.', 'price' => 40.00, 'stock' => 70],
            ['name' => 'Marks Full Cream Milk Powder', 'description' => 'Creamy milk powder for tea and coffee.', 'price' => 490.00, 'stock' => 35],
            ['name' => 'Surf Excel Detergent 1kg', 'description' => 'Powerful cleaning for clothes.', 'price' => 120.00, 'stock' => 90],
            ['name' => 'Wheel Washing Powder', 'description' => 'Affordable detergent for laundry.', 'price' => 65.00, 'stock' => 100],
            ['name' => 'ACI Aerosol', 'description' => 'Insect spray for mosquitoes and flies.', 'price' => 130.00, 'stock' => 55],
            ['name' => 'Radhuni Biryani Masala', 'description' => 'Perfect blend for cooking biryani.', 'price' => 50.00, 'stock' => 40],
            ['name' => 'Pepsodent Toothpaste', 'description' => 'Fresh mint toothpaste for oral care.', 'price' => 80.00, 'stock' => 75],
            ['name' => 'Closeup Toothpaste', 'description' => 'Red gel toothpaste with long-lasting freshness.', 'price' => 85.00, 'stock' => 60],
            ['name' => 'Tata Tea Gold 250g', 'description' => 'Premium blend of Assam tea.', 'price' => 120.00, 'stock' => 70],
            ['name' => 'Dano Power Milk Powder', 'description' => 'Nutrient-rich powdered milk.', 'price' => 500.00, 'stock' => 25],
            ['name' => 'Bashundhara Toilet Tissue', 'description' => 'Soft and strong toilet tissue.', 'price' => 20.00, 'stock' => 150],
        ];

        DB::table('products')->insert($products);
    }
}
