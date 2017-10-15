<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\WebController;

class ArticleController extends WebController
{

    /**
     *
     */
    public function aboutUs()
    {
        $aboutUs = $this->PurposeModel->selectFirst('article', ['id' => 2]);
        return view($this->file . 'aboutus')->with([
            'about' => $aboutUs
        ]);
    }

    /**
     *成单秘籍
     */
    public function secrets()
    {
        $secrets = $this->PurposeModel->selectFirst('article', ['id' => 5]);
        return view('secrets')->with([
            'about' => $secrets
        ]);
    }

    /**
     *成单秘籍
     * @return $this
     */
    public function serviceProvider()
    {
        $provider = $this->PurposeModel->selectFirst('article', ['id' => 5]);
        return view('provider')->with([
            'about' => $provider
        ]);
    }

}
