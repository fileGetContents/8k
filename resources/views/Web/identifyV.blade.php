<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no,width=device-width">
    <meta charset="UTF-8">
    <title>v认证</title>
    <link rel="stylesheet" href="{{asset('css/identifyV.css')}}"/>
</head>
<body>
<div class="header">
    <img src="{{asset('img/vbg.jpg')}}">
    <a href="#section">
        <button class="identibtn">我是商家，立即认证</button>
    </a>
</div>

<div class="header" style="margin-top: -10px;">
    <img src="{{asset('img/vbg2.png')}}">
    <a href="#section">
        <button class="identibtn">我是商家，立即认证</button>
    </a>
</div>

<form action="{{URL('identifyv')}}" method="post" enctype="multipart/form-data">
    <div class="section" id="section" style="height:300px;">
        <div class="messbox" style="height:240px;">
            <div><label>商户名称：</label>
                <input type="text" name="name"/>
            </div>

            <div>
                <label>联系方式：</label>
                <input type="text" name="phone" value="{{ $user->telephone }}" readonly="readonly"/>
            </div>

            <div class="iden">
                <div>上传证件:</div>
                <div>
                    <table>
                        <tr>
                            <td>营业执照：</td>
                            <td><input type="file" name="business1"/></td>
                        </tr>
                        <tr>
                            <td>法人手持身份证件照：</td>
                            <td><input type="file" name="business2"></td>
                        </tr>
                        <tr>
                            <td>技能证书：</td>
                            <td><input type="file" name="business3"></td>
                        </tr>
                        <tr>
                            <td>及手持身份证件照：</td>
                            <td><input type="file" name="business4"></td>
                        </tr>
                    </table>
                </div>
            </div>
            <a href="#norm">
                <button class="identibtn save">提交</button>
            </a>
        </div>
    </div>
</form>

<div class="norm" id="norm">
    <p class="import">v认证商家特权说明</p>
    <ol>
        <li>营业执照认证+个人认证</li>
        <li>营业执照认证+个人认证</li>
        <li>营业执照认证+个人认证</li>
        <li>营业执照认证+个人认证</li>
    </ol>
    <ol>
        <li>营业执照认证+个人认证</li>
        <li>营业执照认证+个人认证</li>
        <li>营业执照认证+个人认证</li>
        <li>营业执照认证+个人认证</li>
    </ol>
    <p class="import">官方咨询电话：5001234</p>
</div>
</body>
</html>
