@extends("layouts.base")

@section('title',"日間")
@section('contents')

<div class="row contents">
    <div class="col-sm-1"></div>
    	<div class="col-sm-10">
            <div class="card">
        			<div class="card-header">
        				<div class="row">
                            <div class="col-auto align-self-center">
                                <h3>{{$Day->year}}年</h3>
                            </div>
        					<div class="col-auto">
                                <h2>{{$Day->month}}月</h2>
                            </div>
                            <div class="mr-sm-auto">
                                <h2>{{$Day->day}}日</h2>
                            </div>
        				</div>
        			</div>
        			<div class="card-body">
                        <div class="row">
                            <div class="mr-sm-auto">
                                @if(count($errors) > 0)
                                    <p style="color:red">入力に問題があります。再入力してください。</p>
                                    <ul style="color:red">
                                        @foreach ($errors->all() as $error)
                                            <li>{{$error}}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered">
                                    <tr>
                                        <th width="30%">時間</th>
                                        <th width="70%">タイトル</th>
                                    </tr>
                                    @if(isset($Schedule))
                                    @php
                                        array_multisort( array_map( "strtotime", array_column( $Schedule, "start_time" ) ), SORT_ASC, $Schedule) ;
                                    @endphp
                                    @foreach($Schedule as $day)
                                    <form method="post" action="calendar-schedule-edit">
    		                        @csrf
                                    <input type="hidden" name="before_schedule" value="{{$day->id}}">
                                    <tr>
                                        <td>
                                        @if($day->start_time == null and $day->end_time == null)
                                        終日
                                        @else
                                        {{$day->start_time}}～{{$day->end_time}}
                                        @endif
                                        </td>
                                        <td>{{$day->title}}</td>
                                        <td>
                                        <label>
                                        <span class="bg-light">詳細</span>
                                        <input type="checkbox" id="popupon" name="checkbox">
                                        <div id="popup">
                                            <div class="card">
                                                    <div class="card-header">
                                                        <div class="row">
                                                            <div class="mr-sm-auto">
                                                                <h5>詳細</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <table class="table">
                                                            <tr>
                                                                <th>
                                                                    <h6>タイトル</h6>
                                                                </th>
                                                                <td>
                                                                    <input type="text" class="form-control form-control-lg" name="title" value="{{$day->title}}">
                                                                    <p style="margin:auto;">※必須</p>
                                                                </td>
                                                            </tr>
                                                            @error('title')
                                                                <tr style="color:red"><th>ERROR</th>
                                                                <td>{{$message}}</td></tr>
                                                            @enderror
                                                            <tr>
                                                                <th>
                                                                    <h6>日付</h6>
                                                                </th>
                                                                <td>
                                                                    <div class="form-row">
                                                                        <div class="mr-sm-auto">
                                                                            <input type="date" class="form-control" name="date" value="{{$day->date}}">
                                                                        </div>
                                                                    </div>
                                                                    <p style="margin:auto;">※必須</p>
                                                                </td>
                                                            </tr>
                                                            @error('date')
                                                                <tr style="color:red"><th>ERROR</th>
                                                                <td>{{$message}}</td></tr>
                                                            @enderror
                                                            <tr>
                                                                <th>
                                                                    <h6>時間</h6>
                                                                </th>
                                                                <td>
                                                                    <div class="form-row">
                                                                        <div class="input-group align-items-center">
                                                                            <input type="checkbox" id="day_check" 
                                                                            @if ($day->start_time == null and $day->end_time == null)
                                                                                checked="checked"
                                                                            @endif
                                                                            >
                                                                            <div>終日</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="input-group align-items-center">
                                                                            <input type="time" class="form-control" id="start_time" name="start_time" value="{{$day->start_time}}">
                                                                            <div>～</div>
                                                                            <input type="time" class="form-control" id="end_time" name="end_time" value="{{$day->end_time}}">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>
                                                                    <h6>メモ</h6>
                                                                </th>
                                                                <td>
                                                                    <div class="form-row">
                                                                        <textarea class="form-control" rows="5" name="memo">{{$day->memo}}</textarea>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="card-footer">
                                                        <div class="row">
                                                            <div class="ml-auto mr-auto"><input type="submit" class="btn" value="編集を保存"></div>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                    </label>
                                        </td>
                                        <td><a class="btn btn-light confirm" id="delete" href="calendar-schedule-delete?id={{$day->id}}" onclick="return confirm('予定を削除しますか？')">削除</a></td>
                                    </tr>
                                    </form>
                                    @endforeach
                                    @endif
                                </table>
                            </div>
                        </div>
        			</div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="ml-sm-auto">
                                <h3><a href="calendar-month?id={{$Day->date}}">月間へ戻る</a></h3>
                            </div>
                        </div>
                    </div>
        		</div>

    	</div>
    <div class="col-sm-1"></div>
</div>


<script>
    $(document).ready( function(){
        if (day_check.checked){
            start_time.readOnly = true;
            end_time.readOnly = true;
        } else {
            start_time.readOnly = false;
            end_time.readOnly = false;
        }
    });

    $('#day_check').on('click', function() {
        if (day_check.checked){
            start_time.readOnly = true;
            end_time.readOnly = true;
            if(start_time !== null){
                document.getElementById( "start_time" ).value = null ;
            }
            if(end_time !== null){
                document.getElementById( "end_time" ).value = null ;
            }
        } else {
            start_time.readOnly = false;
            end_time.readOnly = false;
        }
    });


</script>

@endsection