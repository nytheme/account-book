@extends('layouts.head')

@section('content')

    <div class="container">
        
        @foreach ($users as $user)
            <h3>{{ Auth::user()->name }} 家計簿</h3>
            <?php
                $y = date('Y');
                $m = date('m');
                $wd1 = date("w", mktime(0, 0, 0, $m, 1, $y)); // 1日の曜日を取得
                $d = 1;
                $today = date('d');
                $ii = 101;
            ?>
            <h3>{{ $y }}年{{ $m }}月</h3>
            <h3>合計 ¥{{ number_format($this_month_sum) }}</h3>
            <table style="width: 100%; padding-bottom: 60px;">
                @foreach ($expenses as $expense)
                    <?php   //年月日から曜日を割り出す
                        $datetime = new DateTime($expense->day);
                        $week = array("日", "月", "火", "水", "木", "金", "土");
                        $w = (int)$datetime->format('w');
                    ?>
                    <tr style="background-color: lightgrey; width: 100%;">
                        <td colspan="4" >{{ $expense->day }}({{ $week[$w] }})</td>
                    </tr>
                    <tr>
                        <td>{{ $expense->category }}</td><td>{{ $expense->name }}</td><td>¥{{ number_format($expense->money) }}</td>
                        <div class="deleteButton">
                        {!! Form::open(['route' => ['expenses.destroy', $expense->id], 'method' => 'delete']) !!}
                            <td><button type="submit" class="delete"><i class="fas fa-trash" style="font-size: 1.3em; color: white"></i></button></td>
                        {!! Form::close() !!}
                        </div>
                    </tr>
                @endforeach
            </table>
            
        <?php break; ?>
        @endforeach
    </div><!--.container-->
    
    <footer>
        <div class="footer_icons">
            <div>
                <a href="show_exp">
                    <div class="icon_to_center"><i class="fas fa-home icon"></i></div>
                    <div class="font">ホーム</div>
                </a>
            </div>
            <div class="selected">
                <div class="icon_to_center"><i class="fas fa-list-ul"></i></div> 
                <div class="font">家計簿</div>
            </div>
            <div>
                <a href="write_exp">
                    <div class="icon_to_center"><i class="fas fa-pen"></i></div>
                    <div class="font">記入</div>
                </a>
            </div>
            <div>
                <a href="accountLists">
                    <div class="icon_to_center"><i class="fas fa-shopping-cart"></i></div>
                    <div class="font">欲しい物</div>
                </a>
            </div>
            <div>
                <a href="edit">
                    <div class="icon_to_center"><i class="far fa-laugh"></i></div>
                    <div class="font">編集</div>
                </a>
            </div>
        </div>
    </footer>

@endsection
