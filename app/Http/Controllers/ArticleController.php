<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\WebController;

class ArticleController extends WebController
{

    /**
     * 关于我们
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
        return view($this->file . 'secrets')->with([
            'about' => $secrets
        ]);
    }


    /**
     *如何挑选服务商
     * @return $this
     */
    public function serviceProvider()
    {
        $provider = $this->PurposeModel->selectFirst('article', ['id' => 1]);
        return view($this->file . 'provider')->with([
            'about' => $provider
        ]);
    }

}
