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
            DB::transaction(function () {
                $id = DB::table('products')->insertGetId([
                    'image' => $this->post['image'],
                    'folder' => $this->post['folder'],
                    'category_id' => $this->post['category_id'],
                    'quantity' => (float) $this->post['quantity'],
                    'order_position' => (int) $this->post['order_position'],
                    'vip' => isset($this->post['vip']) ? 1 : 0,
                    'hidden' => isset($this->post['hidden']) ? 1 : 0,
                    'url' => stringToUrl($this->nameOfProduct)
                ]);
                $i = 0;
                foreach ($this->post['translation_order'] as $translate) {
                    DB::table('products_translations')->insert([
                        'for_id' => $id,
                        'name' => htmlspecialchars(trim($this->post['name'][$i])),
                        'description' => htmlspecialchars(trim($this->post['description'][$i])),
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
        $timeNow = time();
        Storage::makeDirectory('moreImagesFolders/' . $timeNow);
        $this->post['folder'] = $timeNow;
        $this->post['image'] = Storage::putFile('images', $this->post['cover_image']);
        /*
         * Upload gallery images
         */
        if (isset($this->post['gallery_image']) && !empty($this->post['gallery_image'])) {
            foreach ($this->post['gallery_image'] as $galleryImage) {
                Storage::putFile('moreImagesFolders/' . $timeNow, $galleryImage);
            }
        }
    }

}
