<?php

namespace App\Models\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Validation\Rule;
use Config;
use Lang;
use Storage;

class PublishModel extends Model
{

    private $defaultLang;
    private $post = [];
    private $nameOfProduct;
    private $setId;

    public function __construct()
    {
        $this->defaultLang = Config::get('app.defaultLocale');
    }

    public function setProduct($post)
    {
        $this->post = $post;
        $isValid = $this->validateProduct();
        if ($isValid['result'] === true) {
            $this->filesUpload();
            $maxId = DB::table('products')->max('id');
            $this->setId = $maxId + 1;
            DB::transaction(function () {
                $id = DB::table('products')->insertGetId([
                    'image' => $this->post['image'],
                    'folder' => $this->post['folder'],
                    'category_id' => $this->post['category_id'],
                    'quantity' => (float) $this->post['quantity'],
                    'order_position' => (int) $this->post['order_position'],
                    'link_to' => $this->post['link_to'],
                    'tags' => trim($this->post['tags']),
                    'hidden' => isset($this->post['hidden']) ? 1 : 0,
                    'url' => stringToUrl($this->nameOfProduct) . '-' . $this->setId
                ]);
                $i = 0;
                foreach ($this->post['translation_order'] as $translate) {
                    DB::table('products_translations')->insert([
                        'for_id' => $id,
                        'name' => htmlspecialchars(trim($this->post['name'][$i])),
                        'description' => htmlspecialchars(trim($this->post['description'][$i])),
                        'price' => htmlspecialchars(trim($this->post['price'][$i])),
                        'locale' => $translate
                    ]);
                    $i++;
                }
            });
            $isValid['msg'] = Lang::get('admin_pages.product_is_published');
            return $isValid;
        } else {
            return $isValid;
        }
    }

    private function validateProduct()
    {
        $errors = [];
        $i = 0;
        foreach ($this->post['translation_order'] as $translation) {
            if ($translation == $this->defaultLang) {
                /*
                 * Url is created from default language name of product
                 * Lets check that we have entered name
                 */
                if (trim($this->post['name'][$i]) == '') {
                    $errors[] = Lang::get('admin_pages.no_entered_product_name');
                } else {
                    /*
                     * If have product name
                     * save it to use it for url
                     */
                    $this->nameOfProduct = $this->post['name'][$i];
                }
            }
            $i++;
        }
        if (!isset($this->post['category_id']) || (int) $this->post['category_id'] == 0) {
            $errors[] = Lang::get('admin_pages.no_entered_product_categ');
        }
        $isValid = false;
        if (empty($errors)) {
            $isValid = true;
        }
        return [
            'result' => $isValid,
            'msg' => $errors
        ];
    }

    private function filesUpload()
    {
        if ($this->post['folder'] <= 0) {
            $timeNow = time();
            Storage::makeDirectory('public/moreImagesFolders/' . $timeNow);
            $this->post['folder'] = $timeNow;
        }

        $this->post['image'] = '';
        if (isset($this->post['cover_image'])) {
            $this->post['image'] = Storage::putFile('public/images', $this->post['cover_image']);
            $this->post['image'] = str_replace('public/', '', $this->post['image']);
        }
        if (isset($this->post['old_image']) && !isset($this->post['cover_image'])) {
            $this->post['image'] = $this->post['old_image'];
        }
        /*
         * Upload gallery images
         */
        if (isset($this->post['gallery_image']) && !empty($this->post['gallery_image'])) {
            foreach ($this->post['gallery_image'] as $galleryImage) {
                Storage::putFile('public/moreImagesFolders/' . $this->post['folder'], $galleryImage);
            }
        }
    }

    public function getProductInfo($id)
    {
        $product = DB::table('products')
                ->where('id', $id)
                ->first();

        $product_translations = DB::table('products_translations')
                        ->where('for_id', $id)
                        ->get()->toArray();

        return [
            'product' => $product,
            'translations' => $product_translations
        ];
    }

    public function updateProduct($post, $id)
    {
        $this->post = $post;
        $this->id = $id;
        $isValid = $this->validateProduct();
        if ($isValid['result'] === true) {
            $this->filesUpload();
            DB::transaction(function () {
                DB::table('products')
                        ->where('id', $this->id)
                        ->update([
                            'image' => str_replace('public/', '', $this->post['image']),
                            'category_id' => $this->post['category_id'],
                            'quantity' => (float) $this->post['quantity'],
                            'order_position' => (int) $this->post['order_position'],
                            'link_to' => $this->post['link_to'],
                            'tags' => trim($this->post['tags']),
                            'hidden' => isset($this->post['hidden']) ? 1 : 0,
                            'updated_at' => date('Y-m-d H:i:s', time())
                ]);
                $i = 0;
                foreach ($this->post['translation_order'] as $translate) {
                    DB::table('products_translations')
                            ->where('for_id', $this->id)
                            ->where('locale', $translate)
                            ->update([
                                'name' => htmlspecialchars(trim($this->post['name'][$i])),
                                'description' => htmlspecialchars(trim($this->post['description'][$i])),
                                'price' => htmlspecialchars(trim($this->post['price'][$i])),
                    ]);
                    $i++;
                }
            });
            $isValid['msg'] = Lang::get('admin_pages.product_is_updated');
            return $isValid;
        } else {
            return $isValid;
        }
    }

}
