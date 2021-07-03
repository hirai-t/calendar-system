@extends("layouts.base")

@section('title',"月間")
@section('contents')




<div class="row contents">
    	<div class="col-sm-1"></div>
    	<div class="col-sm-10">
            <form method="post" action="calendar-schedule-add">
    		@csrf
            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
            <div class="card">
        			<div class="card-header">
        				<div class="row">
                            <div class="col-auto align-self-center">
                                <h3>{{$Data[6]->year}}年</h3>
                            </div>
        					<div class="mr-sm-auto">
                                <h2>{{$Data[6]->month}}月</h2>
                            </div>
                            @php
                                $month = $Data[6]->month;
                                if($month !== 1){
                                    $month -= 1;
                                    if($month <= 9){
                                        $first = $month;
                                        $month = '0'.$first;
                                    }
                                    $last = $Data[6]->year."-".$month."-".'01';
                                }else{
                                    $year = $Data[6]->year;
                                    $year -= 1;
                                    $month = 12;
                                    $last = $year."-".$month."-".'01';
                                }
                                $month = $Data[6]->month;
                                if($month !== 12){
                                    $month += 1;
                                    if($month <= 9){
                                        $first = $month;
                                        $month = '0'.$first;
                                    }
                                    $next = $Data[6]->year."-".$month."-".'01';
                                }else{
                                    $year = $Data[6]->year;
                                    $year += 1;
                                    $next = $year."-".'01'."-".'01';
                                }
                            @endphp
                            @if($Data[6]->year == 2021 && $Data[6]->month == 1)
                            <div class="ml-sm-auto align-self-center">
                                <h3><a href="calendar-month?id={{$next}}">翌月></a></h3>
                            </div>
                            @elseif($Data[6]->year == 2050 && $Data[6]->month == 12)
                            <div class="ml-sm-auto align-self-center">
                                <h3><a href="calendar-month?id={{$last}}"><前月</a></h3>
                            </div>
                            @else
                            <div class="ml-sm-auto align-self-center">
                                <h3><a href="calendar-month?id={{$last}}"><前月</a></h3>
                            </div>
                            <div class="col-auto align-self-center">
                                <h3><a href="calendar-month?id={{$next}}">翌月></a></h3>
                            </div>
                            @endif
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
                                <div class="mr-sm-auto">
                                    <label>
                                        <span class="bg-light">予定を追加＋</span>
                                        <input type="checkbox" id="popupon" name="checkbox">
                                        <div id="popup">
                                            <div class="card">
                                                <div class="card-header">
                                                    <div class="row">
                                                        <div class="mr-sm-auto">
                                                            <h5>予定を追加</h5>
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
                                                                <input type="text" class="form-control form-control-lg" name="title" value="{{old('title')}}">
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
                                                                        <input type="date" class="form-control" name="date" value="{{old('date')}}">
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
                                                                    <div class="input-group align-items-center" style="margin-bottom:15px">
                                                                        <input type="checkbox" id="day_check" name="day_check">
                                                                        <div>終日</div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row">
                                                                    <div class="input-group align-items-center">
                                                                        <input type="time" class="form-control" id="start_time" name="start_time" value="{{old('start_time')}}">
                                                                        <div>～</div>
                                                                        <input type="time" class="form-control" id="end_time" name="end_time" value="{{old('end_time')}}">
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
                                                                    <textarea class="form-control" rows="5" name="memo">{{old('memo')}}</textarea>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="card-footer">
                                                    <div class="row">
                                                        <div class="ml-auto mr-auto"><input type="submit" class="btn" value="追加する"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </table>
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered calendar">
                                    <tr>
                                        <th>月</th>
                                        <th>火</th>
                                        <th>水</th>
                                        <th>木</th>
                                        <th>金</th>
                                        <th>土</th>
                                        <th>日</th>
                                    </tr>
                                    @foreach($Data as $day)
                                    @if ($loop->first or $loop->iteration % 7 == 1)
                                    <tr>
                                    @endif
                                        <td height="120"
                                        @if($day->month != $Data[6]->month)
                                        class="bg-secondary"
                                        @endif
                                        >
                                            @if($day->month == $Data[6]->month)
                                            <a href="calendar-day?id={{$day->date}}">
                                            @endif
                                                <div class="row">
                                                    <div class="col-sm-12"><h6>{{$day->day}}</h6></div>
                                                </div>
                                            @if($day->month == $Data[6]->month)
                                            </a>
                                            @endif
                                            @if(isset($Schedule[0]))
                                                @foreach($Schedule as $item)
                                                    @if($day->date == $item[0]->date)
                                                        @foreach($item as $sche)
                                                            <h6 class="text-success small">{{$sche->start_time}}{{mb_substr($sche->title,0,5)}}</h6>
                                                        @endforeach
                                                    @endif
                                                    
                                                @endforeach
                                            @endif
                                        </td>
                                    @if ($loop->iteration % 7 == 0)
                                    </tr>
                                    @endif
                                    @endforeach
                                </table>
                            </div>
                        </div>
        			</div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="ml-sm-auto">
                                <h3><a href="calendar-year?year={{$Data[6]->year}}">{{$Data[6]->year}}年の年間へ</a></h3>
                            </div>
                        </div>
                    </div>
        		</div>
        	</form>
    	</div>
        <div class="col-sm-1"></div>
</div>

<script>
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