<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model;


class ArticleController extends Controller
{
    protected $file = 'Admin.';
    protected $PurposeModel;

    public function __construct()
    {
        $this->PurposeModel = new Model\PurposeModel();
    }

    /**
     * 修改数据
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function ArticleAdd(Request $request)
    {
        $id = $request->id;
        if ($request->isMethod('post')) {
            $whether = $this->PurposeModel->up('article', array('id' => $id), array(
                'name' => $request->input('art_name'),
                'content' => $request->input('art_content'),
                'time' => $_SERVER['REQUEST_TIME']
            ));
            if ($whether) {
                echo '<script> alert("修改成功") </script>';
            } else {
                echo '<script> alert("修改失败") </script>';
            }
        }
        $article = $this->PurposeModel->selectFirst('article', array('id' => $id));
        return view($this->file . 'article-add')->with([
            'article' => $article,
            'id' => $id
        ]);

    }

    /**
     * 静态界面管理
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function ArticleList(Request $request)
    {
        $artisan = $this->PurposeModel->selectTableAll('article');
        return view($this->file . 'article-list')->with([
            'artisan' => $artisan
        ]);
    }


}
