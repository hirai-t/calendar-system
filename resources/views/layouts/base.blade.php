<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>@yield('title')</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<!-- <link rel="stylesheet" href="./css/style.css" /> -->
<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> 
<!-- <script src="./js/script.js"></script> -->
<style>
.contents{
    margin-top: 30px;
}
#footer{
    padding-top: 10px;
    margin-top: 30px;
    }
.header{
    height:80px;
}

.calendar {
   table-layout: fixed;
   width: 100%;
}

/*popup表示させたいコンテンツのレイアウトと位置*/
#popup{
  width:50%;
  line-height:100%;
  box-sizing:border-box;
  display:none;
  position:fixed;
  top:50%;
  left:50%;
  -webkit-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
  z-index:10;
}
label{
  display:block;
}
/*ボタンの装飾*/
label span{
  display:block;
  background-color:#01b6ed;
  width:150px;
  line-height:40px;
  border-radius:4px;
  text-align:center;
  margin-left:16px;
}
label span:hover{
  cursor:pointer;
}
#popupon[type="checkbox"]{
  display:none;
}
/*checkboxがcheckの状態になったらpopupを表示させる*/
input[type="checkbox"]:checked + #popup{
  display:block;
}

</style>
</head>

<body>

    <div class="container">
        <div class="row bg-light header">
            <div class="mr-sm-auto align-self-center"><h1><a href="calendar-year">WEBカレンダー</a></h1></div>
            @guest
            <div class="ml-sm-auto align-self-center">
                <a href="{{ route('login') }}" class="nav-item nav-link">ログイン</a>
            </div>
            <div class="align-self-center">
                <a class="nav-link" href="{{ route('register') }}">ユーザー登録</a>
            </div>
            @else
            <div class="ml-sm-auto align-self-center">
                <a href="calendar-user" style="padding:16px" class="lead">{{Auth::user()->name}}さん</a></h5>
            </div>
            <div class="align-self-center">
                <a href="{{ route('logout') }}" style="padding:16px"
                    onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                    ログアウト
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
            @endguest
        </div>


        @yield('contents')



        <div id="footer" class="row bg-info header">
        <div class="col-sm-6"><h3 class="text-light h6">WEBカレンダー</h3></div>
        <div class="col-sm-6"></div>
        </div>
    </div>
</body>
</html>