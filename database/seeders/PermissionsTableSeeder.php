<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'product_management_access',
            ],
            [
                'id'    => 18,
                'title' => 'product_category_create',
            ],
            [
                'id'    => 19,
                'title' => 'product_category_edit',
            ],
            [
                'id'    => 20,
                'title' => 'product_category_show',
            ],
            [
                'id'    => 21,
                'title' => 'product_category_delete',
            ],
            [
                'id'    => 22,
                'title' => 'product_category_access',
            ],
            [
                'id'    => 23,
                'title' => 'product_tag_create',
            ],
            [
                'id'    => 24,
                'title' => 'product_tag_edit',
            ],
            [
                'id'    => 25,
                'title' => 'product_tag_show',
            ],
            [
                'id'    => 26,
                'title' => 'product_tag_delete',
            ],
            [
                'id'    => 27,
                'title' => 'product_tag_access',
            ],
            [
                'id'    => 28,
                'title' => 'product_create',
            ],
            [
                'id'    => 29,
                'title' => 'product_edit',
            ],
            [
                'id'    => 30,
                'title' => 'product_show',
            ],
            [
                'id'    => 31,
                'title' => 'product_delete',
            ],
            [
                'id'    => 32,
                'title' => 'product_access',
            ],
            [
                'id'    => 33,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 34,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 35,
                'title' => 'best_seller_create',
            ],
            [
                'id'    => 36,
                'title' => 'best_seller_edit',
            ],
            [
                'id'    => 37,
                'title' => 'best_seller_show',
            ],
            [
                'id'    => 38,
                'title' => 'best_seller_delete',
            ],
            [
                'id'    => 39,
                'title' => 'best_seller_access',
            ],
            [
                'id'    => 40,
                'title' => 'featured_product_create',
            ],
            [
                'id'    => 41,
                'title' => 'featured_product_edit',
            ],
            [
                'id'    => 42,
                'title' => 'featured_product_show',
            ],
            [
                'id'    => 43,
                'title' => 'featured_product_delete',
            ],
            [
                'id'    => 44,
                'title' => 'featured_product_access',
            ],
            [
                'id'    => 45,
                'title' => 'spesial_offer_create',
            ],
            [
                'id'    => 46,
                'title' => 'spesial_offer_edit',
            ],
            [
                'id'    => 47,
                'title' => 'spesial_offer_show',
            ],
            [
                'id'    => 48,
                'title' => 'spesial_offer_delete',
            ],
            [
                'id'    => 49,
                'title' => 'spesial_offer_access',
            ],
            [
                'id'    => 50,
                'title' => 'news_management_access',
            ],
            [
                'id'    => 51,
                'title' => 'news_category_create',
            ],
            [
                'id'    => 52,
                'title' => 'news_category_edit',
            ],
            [
                'id'    => 53,
                'title' => 'news_category_show',
            ],
            [
                'id'    => 54,
                'title' => 'news_category_delete',
            ],
            [
                'id'    => 55,
                'title' => 'news_category_access',
            ],
            [
                'id'    => 56,
                'title' => 'news_tag_create',
            ],
            [
                'id'    => 57,
                'title' => 'news_tag_edit',
            ],
            [
                'id'    => 58,
                'title' => 'news_tag_show',
            ],
            [
                'id'    => 59,
                'title' => 'news_tag_delete',
            ],
            [
                'id'    => 60,
                'title' => 'news_tag_access',
            ],
            [
                'id'    => 61,
                'title' => 'news_create',
            ],
            [
                'id'    => 62,
                'title' => 'news_edit',
            ],
            [
                'id'    => 63,
                'title' => 'news_show',
            ],
            [
                'id'    => 64,
                'title' => 'news_delete',
            ],
            [
                'id'    => 65,
                'title' => 'news_access',
            ],
            [
                'id'    => 66,
                'title' => 'store_setting_access',
            ],
            [
                'id'    => 67,
                'title' => 'banner_setting_access',
            ],
            [
                'id'    => 68,
                'title' => 'fludgy_flavor_create',
            ],
            [
                'id'    => 69,
                'title' => 'fludgy_flavor_edit',
            ],
            [
                'id'    => 70,
                'title' => 'fludgy_flavor_show',
            ],
            [
                'id'    => 71,
                'title' => 'fludgy_flavor_delete',
            ],
            [
                'id'    => 72,
                'title' => 'fludgy_flavor_access',
            ],
            [
                'id'    => 73,
                'title' => 'personalized_one_create',
            ],
            [
                'id'    => 74,
                'title' => 'personalized_one_edit',
            ],
            [
                'id'    => 75,
                'title' => 'personalized_one_show',
            ],
            [
                'id'    => 76,
                'title' => 'personalized_one_delete',
            ],
            [
                'id'    => 77,
                'title' => 'personalized_one_access',
            ],
            [
                'id'    => 78,
                'title' => 'personalized_two_create',
            ],
            [
                'id'    => 79,
                'title' => 'personalized_two_edit',
            ],
            [
                'id'    => 80,
                'title' => 'personalized_two_show',
            ],
            [
                'id'    => 81,
                'title' => 'personalized_two_delete',
            ],
            [
                'id'    => 82,
                'title' => 'personalized_two_access',
            ],
            [
                'id'    => 83,
                'title' => 'personalized_tree_create',
            ],
            [
                'id'    => 84,
                'title' => 'personalized_tree_edit',
            ],
            [
                'id'    => 85,
                'title' => 'personalized_tree_show',
            ],
            [
                'id'    => 86,
                'title' => 'personalized_tree_delete',
            ],
            [
                'id'    => 87,
                'title' => 'personalized_tree_access',
            ],
            [
                'id'    => 88,
                'title' => 'product_banner_one_create',
            ],
            [
                'id'    => 89,
                'title' => 'product_banner_one_edit',
            ],
            [
                'id'    => 90,
                'title' => 'product_banner_one_show',
            ],
            [
                'id'    => 91,
                'title' => 'product_banner_one_delete',
            ],
            [
                'id'    => 92,
                'title' => 'product_banner_one_access',
            ],
            [
                'id'    => 93,
                'title' => 'product_banner_two_create',
            ],
            [
                'id'    => 94,
                'title' => 'product_banner_two_edit',
            ],
            [
                'id'    => 95,
                'title' => 'product_banner_two_show',
            ],
            [
                'id'    => 96,
                'title' => 'product_banner_two_delete',
            ],
            [
                'id'    => 97,
                'title' => 'product_banner_two_access',
            ],
            [
                'id'    => 98,
                'title' => 'client_create',
            ],
            [
                'id'    => 99,
                'title' => 'client_edit',
            ],
            [
                'id'    => 100,
                'title' => 'client_show',
            ],
            [
                'id'    => 101,
                'title' => 'client_delete',
            ],
            [
                'id'    => 102,
                'title' => 'client_access',
            ],
            [
                'id'    => 103,
                'title' => 'about_image_create',
            ],
            [
                'id'    => 104,
                'title' => 'about_image_edit',
            ],
            [
                'id'    => 105,
                'title' => 'about_image_show',
            ],
            [
                'id'    => 106,
                'title' => 'about_image_delete',
            ],
            [
                'id'    => 107,
                'title' => 'about_image_access',
            ],
            [
                'id'    => 108,
                'title' => 'what_we_have_create',
            ],
            [
                'id'    => 109,
                'title' => 'what_we_have_edit',
            ],
            [
                'id'    => 110,
                'title' => 'what_we_have_show',
            ],
            [
                'id'    => 111,
                'title' => 'what_we_have_delete',
            ],
            [
                'id'    => 112,
                'title' => 'what_we_have_access',
            ],
            [
                'id'    => 113,
                'title' => 'social_medium_create',
            ],
            [
                'id'    => 114,
                'title' => 'social_medium_edit',
            ],
            [
                'id'    => 115,
                'title' => 'social_medium_show',
            ],
            [
                'id'    => 116,
                'title' => 'social_medium_delete',
            ],
            [
                'id'    => 117,
                'title' => 'social_medium_access',
            ],
            [
                'id'    => 118,
                'title' => 'setting_content_create',
            ],
            [
                'id'    => 119,
                'title' => 'setting_content_edit',
            ],
            [
                'id'    => 120,
                'title' => 'setting_content_show',
            ],
            [
                'id'    => 121,
                'title' => 'setting_content_delete',
            ],
            [
                'id'    => 122,
                'title' => 'setting_content_access',
            ],
            [
                'id'    => 123,
                'title' => 'order_management_access',
            ],
            [
                'id'    => 124,
                'title' => 'order_create',
            ],
            [
                'id'    => 125,
                'title' => 'order_edit',
            ],
            [
                'id'    => 126,
                'title' => 'order_show',
            ],
            [
                'id'    => 127,
                'title' => 'order_delete',
            ],
            [
                'id'    => 128,
                'title' => 'order_access',
            ],
            [
                'id'    => 129,
                'title' => 'order_detail_create',
            ],
            [
                'id'    => 130,
                'title' => 'order_detail_edit',
            ],
            [
                'id'    => 131,
                'title' => 'order_detail_show',
            ],
            [
                'id'    => 132,
                'title' => 'order_detail_delete',
            ],
            [
                'id'    => 133,
                'title' => 'order_detail_access',
            ],
            [
                'id'    => 134,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
