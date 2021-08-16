<?php

namespace App\Http\Controllers;

use App\Traits\PageTraits;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    use PageTraits;

    public function show(Request $request)
    {
        $options = [
            'page' => 'index',
        ];
        if($request->type != 'fetch') $options['layout'] = true;

        $data = $this->fetch($options);

        $data['meta']['url'] = '/';

        return view(
            'index', 
            $this->response($options['layout'] ?? false, $data)
        );
    }
}
