@extends("layouts.base")

@section('title',"年間")
@section('contents')

<div class="row contents">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
        <form method="post" action="#">
        @csrf

            <div class="row">
                @php
                $month = $Calendar[2];
                $year = $month[1]->year;
                $last = $year - 1;
                $next = $year + 1;
                @endphp
                @if($year !== 2021 && $year !==2050)
                <div class="ml-auto align-self-center">
                    <h3><a href="calendar-year?year={{$last}}"><</a></h3>
                </div>
                <div class="col-auto"><h2>{{$year}}</h2></div>
                <div class="mr-auto align-self-center">
                    <h3><a href="calendar-year?year={{$next}}">></a></h3>
                </div>
                @elseif($year == 2021)
                <div class="ml-auto"><h2>{{$year}}</h2></div>
                <div class="mr-auto align-self-center">
                    <h3><a href="calendar-year?year={{$next}}">></a></h3>
                </div>
                @elseif($year == 2050)
                <div class="ml-auto align-self-center">
                    <h3><a href="calendar-year?year={{$last}}"><</a></h3>
                </div>
                <div class="mr-auto"><h2>{{$year}}</h2></div>
                @endif
            </div>          
            <div class="row">
                @foreach($Calendar as $Data)
                <div class="col-sm-4 border">
                <a href="calendar-month?id={{$Data[6]->date}}">
                    <h5>{{$Data[12]->month."月"}}</h5>
                    <table width="100%">
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
                            <td>
                            {{$day->day}}
                            </td>
                        @if ($loop->iteration % 7 == 0)
                        </tr>
                        @endif
                        @endforeach
                    </table>
                </a>
                </div>
                @endforeach
            </div>
        </form>
    </div>
    <div class="col-sm-2"></div>
</div>


@endsection