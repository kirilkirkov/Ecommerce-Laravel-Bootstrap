<?php

namespace App\Models\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Validation\Rule;
use Storage;
use Config;
use Lang;

class CarouselModel extends Model
{

    private $post;
    private $defaultLang;
    private $id;

    public function __construct()
    {
        $this->defaultLang = Config::get('app.defaultLocale');
    }

    public function getSliders()
    {
        $sliders = DB::table('carousel')
                ->select(DB::raw('carousel.*, carousel_translations.image, carousel_translations.locale'))
                ->where('locale', $this->defaultLang)
                ->orderBy('position', 'asc')
                ->join('carousel_translations', 'carousel.id', '=', 'carousel_translations.for_id')
                ->paginate(3);
        return $sliders;
    }

    public function setNewSlider($post)
    {
        $this->post = $post;
        $this->filesUpload();
        if (isset($this->post['img']) && !empty($this->post['img'])) {
            DB::transaction(function () {
                $id = DB::table('carousel')->insertGetId([
                    'position' => $this->post['position'] == null ? 1 : $this->post['position'],
                    'link' => $this->post['link'] == null ? '' : trim($this->post['link'])
                ]);
                $i = 0;
                foreach ($this->post['translation_order'] as $translate) {
                    DB::table('carousel_translations')->insert([
                        'for_id' => $id,
                        'image' => isset($this->post['img'][$i]) ? $this->post['img'][$i] : '',
                        'locale' => $translate
                    ]);
                    $i++;
                }
            });
            return [
                'msg' => Lang::get('admin_pages.carousel_is_added'),
                'result' => true
            ];
        } else {
            return [
                'msg' => Lang::get('admin_pages.no_selected_image'),
                'result' => false
            ];
        }
    }

    private function filesUpload()
    {
        foreach ($this->post['translation_order'] as $translate) {
            if (isset($this->post['image_' . $translate])) {
                $this->post['img'][] = str_replace('public/', '', Storage::putFile('public/carousel', $this->post['image_' . $translate][0]));
            } else {
                $this->post['img'][] = '';
            }
        }
    }

    public function deleteSlider($id)
    {
        $this->id = $id;
        DB::transaction(function () {
            DB::table('carousel')->where('id', $this->id)->delete();
            DB::table('carousel_translations')->where('for_id', $this->id)->delete();
        });
    }

}
