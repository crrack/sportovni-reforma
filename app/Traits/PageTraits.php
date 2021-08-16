<?php 

namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait PageTraits
{
    public function fetch($options)
    {
        try {
            $response = Http::post(
                env('ADMIN_URL') . 'api/content',
                $options
            );
            //dd(json_decode($response->body(), true));
            return json_decode($response->body(), true);
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            if($e->status() == '404') {
                abort(404);
            }else {
                return [];
            }
        }   
    }

    public function response($layout, $data = [])
    {
        $view = $data;

        if($layout) {
            $view['layout'] = 'app';
        }else{
            $view['layout'] = 'blank';
        }

        return $view;
    }
    
}