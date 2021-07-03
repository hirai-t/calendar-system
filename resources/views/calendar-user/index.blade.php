@extends("layouts.base")

@section('title',"ユーザー情報")
@section('contents')



<form method="post" action="calendar-login">
@csrf
<div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="mr-sm-auto">
                        <h5>{{Auth::user()->name}}さんのユーザー情報</h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th>
                            <h6>ユーザー名</h6>
                        </th>
                        <td>
                            <p>{{Auth::user()->name}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <h6>メールアドレス</h6>
                        </th>
                        <td>
                            <p>{{Auth::user()->email}}</p>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="mr-auto ml-auto align-self-center">
                        <a href="calendar-user-delete" class="btn btn-info confirm" onclick="return confirm('ユーザーを削除しますか？')">ユーザーを削除する</a>
                    <div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-2"></div>
</div>
</form>


@endsection