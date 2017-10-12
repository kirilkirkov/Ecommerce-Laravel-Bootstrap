<?php

namespace App\Models\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Validation\Rule;
use Config;
use Lang;

class CategoriesModel extends Model
{

    private $id;
    private $post;
    private $defaultLang;
    private $urlOfProduct;

    public function __construct()
    {
        $this->defaultLang = Config::get('app.defaultLocale');
    }

    public function setCategory($post)
    {
        $this->post = $post;
        $isValid = $this->validateCategory();
        if ($isValid['result'] === true) {
            DB::transaction(function () {
                $id = DB::table('categories')->insertGetId([
                    'parent' => $this->post['parent'],
                    'position' => $this->post['position'],
                    'url' => $this->urlOfProduct
                ]);
                $i = 0;
                foreach ($this->post['translation_order'] as $translate) {
                    DB::table('categories_translations')->insert([
                        'for_id' => $id,
                        'name' => htmlspecialchars(trim($this->post['name'][$i])),
                        'locale' => $translate
                    ]);
                    $i++;
                }
            });
            $isValid['msg'] = Lang::get('admin_pages.category_is_published');
            return $isValid;
        } else {
            return $isValid;
        }
    }

    private function validateCategory()
    {
        $errors = [];
        $i = 0;
        foreach ($this->post['translation_order'] as $translation) {
            if ($translation == $this->defaultLang) {
                if (trim($this->post['name'][$i]) == '') {
                    $errors[] = Lang::get('admin_pages.no_entered_categ_name');
                } else {
                    $this->urlOfProduct = stringToUrl($this->post['name'][$i]);
                }
            }
            $i++;
        }
        $count = DB::table('categories')->where('url', $this->urlOfProduct)->count();
        if ($count > 0) {
            $errors[] = Lang::get('admin_pages.category_name_taken');
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

    public function updateCategory($post, $id)
    {
        $this->post = $post;
        $this->id = $id;
        $isValid = $this->validateCategory();
        if ($isValid['result'] === true) {
            DB::transaction(function () {
                DB::table('categories')
                        ->where('id', $this->id)
                        ->update([
                            'parent' => $this->post['parent'],
                            'position' => $this->post['position']
                ]);
                $i = 0;
                foreach ($this->post['translation_order'] as $translate) {
                    DB::table('categories_translations')
                            ->where('for_id', $this->id)
                            ->where('locale', $translate)
                            ->update([
                                'name' => htmlspecialchars(trim($this->post['name'][$i])),
                    ]);
                    $i++;
                }
            });
            $isValid['msg'] = Lang::get('admin_pages.category_is_updated');
            return $isValid;
        } else {
            return $isValid;
        }
    }

    public function deleteCategories($ids)
    {
        $this->id = explode(',', $ids);
        DB::transaction(function () {
            DB::table('categories')->whereIn('id', $this->id)->delete();
            DB::table('categories_translations')->whereIn('for_id', $this->id)->delete();
        });
    }

    public function getOneCategory($id)
    {
        $category = DB::table('categories')
                ->where('id', $id)
                ->first();

        $category_translations = DB::table('categories_translations')
                        ->where('for_id', $id)
                        ->get()->toArray();

        return [
            'category' => $category,
            'translations' => $category_translations
        ];
    }

    public function getAllCategories()
    {
        $categories = DB::table('categories')
                ->select(DB::raw('categories.id, categories_translations.name'))
                ->where('categories_translations.locale', $this->defaultLang)
                ->join('categories_translations', 'categories.id', '=', 'categories_translations.for_id')
                ->get();
        return $categories;
    }

    public function getCategoriesWithPagination($request)
    {
        $order_by = $request->input('order_by');
        $type = $request->input('type');

        if ($order_by != 'name' && $order_by != 'parent' && $order_by != 'position') {
            $order_by = 'id';
        }

        if ($type != 'asc' && $type != 'desc') {
            $type = 'desc';
        }

        $categories = DB::table('categories')
                ->select(DB::raw('categories.*, categories_translations.name, '
                                . '(SELECT categories_translations2.name FROM categories as categories2'
                                . ' INNER JOIN categories_translations as categories_translations2 '
                                . 'ON categories_translations2.for_id =  categories2.id WHERE categories2.id = categories.parent '
                                . 'AND categories_translations2.locale="en") as parent'))
                ->where('categories_translations.locale', $this->defaultLang)
                ->when($order_by, function ($query) use ($order_by, $type) {
                    return $query->orderBy($order_by, $type);
                })
                ->join('categories_translations', 'categories.id', '=', 'categories_translations.for_id')
                ->paginate(10);
        return $categories;
    }

}
