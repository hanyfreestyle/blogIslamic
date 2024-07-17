<?php

namespace App\AppPlugin\AppPuzzle;

class AppPuzzleTreeProduct {


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #  ProductTree
    static function ProductTree() {
        $modelTree = [
            'Product' => self::treeProduct(),
            'Customers' => self::treeCustomers(),
            'CustomersAdmin' => self::treeCustomersAdmin(),
            'Orders' => self::treeOrders(),
        ];
        return $modelTree;
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   treeProduct
    static function treeProduct() {
        return [
            'view' => true,
            'id' => "Product",
            'CopyFolder' => "Product",
            'appFolder' => 'Product',
            'viewFolder' => 'Product',
            'routeFolder' => null,
            'routeFile' => 'proProduct.php',

            'migrations' => [
                '2023_01_01_000001_create_products_table.php',
                '2023_01_02_000001_create_category_brand_table.php',
                '2023_01_03_000001_create_attributes_table.php',
                '2023_01_04_000001_create_tags_photo_table.php',
            ],

            'seeder' => [
                'pro_attribute_translations.sql',
                'pro_attribute_value_translations.sql',
                'pro_attribute_values.sql',
                'pro_attributes.sql',
                'pro_brand_translations.sql',
                'pro_brands.sql',
                'pro_categories.sql',
                'pro_category_product.sql',
                'pro_category_translations.sql',
                'pro_product_photos.sql',
                'pro_product_translations.sql',
                'pro_products.sql',
                'pro_tags.sql',
                'pro_tags_translations.sql',
                'pro_tags_product.sql',
                'pro_product_attribute.sql',
            ],

            'adminLangFolder' => "admin/",
            'adminLangFiles' => ['proProduct.php'],
            'webLangFolder' => "web/",
            'webLangFiles' => ['proProduct.php'],
            'assetsFolder' => null,
            'livewireClass' => null,
            'livewireView' => null,
        ];
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   treeCustomers
    static function treeCustomers() {
        return [
            'view' => true,
            'id' => "Customers",
            'CopyFolder' => "Customers",
            'appFolder' => 'Customers',
            'viewFolder' => 'Customer',
            'routeFolder' => null,
            'routeFile' => 'customer.php',
            'migrations' => [
                '2023_03_01_000001_create_users_customers_table.php',
            ],
            'seeder' => [
                'users_customers.sql',
                'users_customers_addresses.sql',
                'users_customers_wish_list.sql'
            ],
            'webLangFolder' => "web/",
            'webLangFiles' => ['profile.php'],
            'ComponentFolderClass' => ['Site/Customer'],
            'ComponentFolderView' => ['site/customer'],

        ];
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   Orders
    static function treeOrders() {
        return [
            'view' => true,
            'id' => "Orders",
            'CopyFolder' => "Orders",
            'appFolder' => 'Orders',
            'viewFolder' => 'Orders',
            'routeFolder' => null,
            'routeFile' => 'orders.php',
            'migrations' => [
                '2023_04_01_000001_create_shopping_order_table.php',
                '2023_05_01_000001_create_shopping_shipping_table.php',
            ],
            'seeder' => [
                'shopping_order_addresses.sql',
                'shopping_order_logs.sql',
                'shopping_order_products.sql',
                'shopping_orders.sql',
                'shopping_shipping_cat.sql',
                'shopping_shipping_rate.sql',
            ],

            'adminLangFolder' => "admin/",
            'adminLangFiles' => ['orders.php'],
        ];
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   treeCustomersAdmin
    static function treeCustomersAdmin() {
        return [
            'view' => true,
            'id' => "CustomersAdmin",
            'CopyFolder' => "CustomersAdmin",
            'appFolder' => 'CustomersAdmin',
            'viewFolder' => 'CustomerAdmin',
            'routeFolder' => null,
            'routeFile' => 'customer_admin.php',
            'adminLangFolder' => "admin/",
            'adminLangFiles' => ['customer.php'],
        ];
    }


}
