<?php

//Route::any('/', 'ReleaseController@index');
//
//Route::any('people/move', 'ReleaseController@peopleMove');                         // 个人搬运
//Route::any('good/service', 'ReleaseController@GoodService');                       // 货运服务
//Route::any('long/distance', 'ReleaseController@longDistance');                     // 长途搬家搬运
//Route::any('company/move', 'ReleaseController@companyMove');                       // 公司搬家
//Route::any('equipment/move', 'ReleaseController@equipmentMove');                   // 设备搬迁
//Route::any('lifting', 'ReleaseController@lifting');                                // 起重吊装
//Route::any('piano/move', 'ReleaseController@pianoMove');                           // 钢琴搬运
//Route::any('air/conditioning', 'ReleaseController@airConditioning');               // 空调移机
//Route::any('furniture/disassembling', 'ReleaseController@furnitureDisassembling'); // 家装拆卸
//Route::any('baggage', 'ReleaseController@baggage');                                // 行李托运
//Route::any('internationalSeed', 'ReleaseController@internationalSeed');            // 国际速运
//Route::any('her', 'HerDomesticController@her');                                    // 月嫂
//Route::any('patient/escort', 'HerDomesticController@patientEscort');               // 病人陪护
//Route::any('nanny', 'HerDomesticController@nanny');                                // 住家保姆
//Route::any('domestic/service', 'HerDomesticController@domesticService');           // 家政服务
//Route::any('nursery/teacher', 'HerDomesticController@nurseryTeacher');             // 育婴师
//Route::any('escort', 'HerDomesticController@escort');                              // 陪护
//
//
//Route::any('column/choose', 'ColumnController@userChoose');                     // 用户选择栏目
//Route::any('user/choose/{id}', 'ColumnController@chooseDemand');                // 选择服务项目
//Route::any('add/demand', 'ColumnController@addDemand');                         // 添加服务
//Route::any('show/replenish/{id}', 'ColumnController@addDemandReplenish');        // 展示补充说明
//Route::any('add/replenish', 'ColumnController@addReplenish');                   // 添加补充说明
//
//Route::any('use/login', 'UserController@Login');        // 用户登录/注册
//Route::any('use/profile', 'UserController@profile');    // 个人中心
//Route::any('update/info', 'UserController@updateInfo'); // 更新用户信息
//
//
//Route::any('send/sms', 'ApiController@sendSMS');  // 发送短信
//Route::any('login', 'ApiController@login');       // 用户登录/注册


// 后台管理系统
Route::group(["namespace" => "Admin"], function () {
    Route::any('admin-add', 'AdminController@AdminAdd');
    Route::any('admin-list', 'AdminController@AdminList');
    Route::any('admin-permission', 'AdminController@AdminPermission');
    Route::any('admin-role', 'AdminController@AdminRole');
    Route::any('admin-role-add', 'AdminController@AdminRoleAdd');

    Route::any('article-add/{id}', 'ArticleController@ArticleAdd'); // 添加修改文章
    Route::any('article-list', 'ArticleController@ArticleList');  // 文章管理

    Route::any('feedback-list', 'FeedBackController@FeedBackList'); // 意见反馈

    Route::any('admin/login', 'LoginController@Login');
    Route::any('admin/index', 'LoginController@Index');

    Route::any('member-add', 'MemberController@MemberAdd');
    Route::any('member-del', 'MemberController@MemberDel');
    Route::any('member-list', 'MemberController@MemberList');
    Route::any('member-record-browse', 'MemberController@MemberRecordBrowse');
    Route::any('member-record-download', 'MemberController@MemberRecordDownload');
    Route::any('Member-record-share', 'MemberController@MemberRecordShare');

    Route::any('picture-add', 'PictureController@PictureAdd');
    Route::any('ajax/add/column', 'PictureController@ajaxAddColumn');
    Route::any('picture-list', 'PictureController@PictureList');
    Route::any('picture-show', 'PictureController@PictureShow');

    Route::any('product-add', 'ProductController@ProductAdd'); // 添加选项
    Route::any('product-brand', 'ProductController@ProductBrand');
    Route::any('product-category', 'ProductController@ProductCateGory');
    Route::any('product-category-add', 'ProductController@ProductCateGoryAdd');
    Route::any('product-list', 'ProductController@ProductList');
    Route::any('column/input', 'ProductController@getColumnInput');


    Route::any('system-base', 'SystemController@SystemBase');
    Route::any('system-category', 'SystemController@SystemCateGory');
    Route::any('system-category-add', 'SystemController@SystemCateGoryAdd');
    Route::any('system-data', 'SystemController@SystemData');
    Route::any('system-log', 'SystemController@SystemLog');
    Route::any('system-shielding', 'SystemController@SystemShielding');


    Route::any('welcome', 'WelcomeController@Welcome');
    Route::any('identify-list', 'PictureController@identifyList');// 申请认证管理
    Route::any('recharge-list', 'SystemController@recharge');         // 积分充值记录
});

// API 接口管理
Route::any('pur/del', 'ApiController@PurDel');                                // 通用删除

Route::any('send/sms', 'ApiController@sendSMS');                              //  发送短信验证码
Route::any('up/user', 'ApiController@upUser');                                //  更新用户信息
Route::any('add/message', 'ApiController@addMessage');                        //  添加信息
Route::any('up/file/all', 'ApiController@upFileAll');                         //  通用更新单个字段

Route::any('test', 'WebController@test');                                     // 提交测试

Route::any('show/serve', 'ColumnController@showServer');                      // 用户选择服务项目
Route::any('add/server', 'ColumnController@addServer');                       // 添加服务商
Route::any('range/server/{id}', 'ColumnController@serverRange');              // 添加地址信息
Route::any('add/range', 'ColumnController@addRange');                         // 添加服务半径


Route::any('choose/server/{id}', 'ColumnController@chooseServer');             // 填写需求
Route::any('demand/details/{id}', 'ColumnController@demandDetails');           // 需求详细
Route::any('demand/details2/{id}/{price}', 'ColumnController@demandDetails2'); // 添加需求相信
Route::any('connectbussiness', 'ColumnController@connectbussiness');
Route::any('alreadybussiness', 'ColumnController@alreadybussiness');
Route::any('waitbussiness', 'ColumnController@waitbussiness');

Route::any('person', 'UserController@userPerson');                            // 用户个人中心
Route::any('user/need', 'UseController@userNeed');                            // 用户需求
//Route::any('need/{id}', 'UseController@needInfo');                          // 需求列表

Route::any('company', 'ServerController@company');                          // 商户中心
Route::any('replace', 'ServerController@replace');                          // 添加修改商户信息
Route::any('ajax/replace', 'ServerController@ajaxReplace');                 // 修改添加商户信息
Route::any('add/foot', 'ServerController@addFoot');                         // 添加脚印
Route::any('ajax/foot', 'ServerController@ajaxFoot');                       // ajax添加脚印
Route::any('model', 'ServerController@model');                              // 模板
Route::any('add/model/{id?}', 'ServerController@addModel');                 // 添加or修改
Route::any('form/add/model', 'ServerController@formAddModel');              // 添加模板
Route::any('identify', 'ServerController@identify');                        // 先行赔付
Route::any('identifyv', 'ServerController@identifyV');                      // v认证
Route::any('insert/identifyv', 'ServerController@insertIdentifyV');

Route::any('add/identify', 'ServerController@addIdentify');                 // 添加认证服务

Route::any('jifen', 'IntegralController@recharge');                         // 积分充值
Route::any('add/recharge', 'IntegralController@addRecharge');               // 生成积分订单

Route::any('jifen/info', 'IntegralController@listRecharge');                // 积分详情
// ajax上传图片
Route::any('update/image2', 'ApiController@ajaxUpdateFileImage');
Route::any('update/image', 'ApiController@ajaxUpdateFileImage2');

// 意见反馈
Route::any('suggest', 'FeedBackController@suggest');
Route::any('user/suggest', 'FeedBackController@userSuggest');

Route::any('wx/user/info', 'WechateController@userInfo');
Route::any('pay/wx', 'WechateController@pay');

Route::any('map/similarity', 'MapController@getSimilarity');

Route::any('wx/test', 'WechateController@getAccessToken');  // 微信测试
Route::any('create/menu', 'WechateController@createMenu');  // 创建菜单
Route::any('menu/list', 'WechateController@getMenuList');   // 获取菜单
Route::any('del/menu', 'WechateController@delMenu');        // 菜单删除接口
Route::any('set/template', 'WechateController@setTemplate');   // 设置所属行业

Route::any('create/user/tag', 'WechateController@createUserTag'); // 添加用户标签
Route::any('del/user/tag', 'WechateController@delUserTag'); // 删除用户标签

Route::any('service/provider', 'ArticleController@serviceProvider'); // 如何挑选服务商
Route::any('abouts/us', 'ArticleController@aboutUs');   // 关于我们
Route::any('secrets', 'ArticleController@secrets');     // 成单秘籍


Route::any('notify/url', 'WechateController@wxCallBack');         // 回调地址
