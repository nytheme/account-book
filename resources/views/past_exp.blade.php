@extends('layouts.head')

@section('content')

    <div class="container">
        
        @foreach ($users as $user)
            <h3>家計簿</h3>
            
            <!-- Modal Trigger -->
            <a class="waves-effect waves-light btn-floating modal-trigger" href="#modal1"><i class="fas fa-pen"></i></a>
            
            <!-- Modal Structure -->
            <div id="modal1" class="modal">
                <div class="modal-content">
                <h4>買い物登録</h4>
                @foreach ($users as $user)
                    {!! Form::open(['route' => 'expenses.store']) !!}
                        <div style="display: none">
                            {!! Form::label('ID') !!}
                            {!! Form::text('user_id', Auth::user()->id) !!}
                        </div>
                        <div>
                            {!! Form::label('カテゴリー') !!}
                            {!! Form::select('category',
                                ['食費'=>'食費',
                                 '日用品'=>'日用品',
                                 '保険・医療'=>'保険・医療',
                                 '固定費'=>'固定費',
                                 '衣類'=>'衣類',
                                 '小遣い'=>'小遣い',
                                 'レジャー'=>'レジャー',
                                 'その他'=>'その他',
                                ]) 
                            !!}
                        </div>
                        <div>
                            {!! Form::label('商品') !!}
                            {!! Form::text('name') !!}
                        </div>
                        <div>
                            {!! Form::label('金額') !!}
                            {!! Form::tel('money') !!}
                        </div>
                        <div>
                            @php
                                $today = date("Ymd");
                            @endphp
                            {!! Form::label('日付') !!}
                            {!! Form::tel('day', $today) !!}
                        </div>
                    {!! Form::submit('登録') !!}
                    {!! Form::close() !!}
                    
                <?php break; ?>
                @endforeach
                </div>
                <div class="modal-footer">
                <a href="#!" class="modal-close waves-effect waves-green btn-flat">閉じる</a>
            </div>
            </div>
            
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
            <table class="listTable">
                @foreach ($expenses as $expense)
                    <?php   //年月日から曜日を割り出す
                        $datetime = new DateTime($expense->day);
                        $week = array("日", "月", "火", "水", "木", "金", "土");
                        $w = (int)$datetime->format('w');
                    ?>
                    <tr style="background-color: lightgrey;">
                        <th  class="date" colspan="4">{{ $expense->day }}({{ $week[$w] }})</th>
                    </tr>
                    <tr>
                        <td>{{ $expense->category }}</td><td>{{ $expense->name }}</td><td>¥{{ number_format($expense->money) }}</td>
                        <div class="deleteButton">
                            {!! Form::open(['route' => ['expenses.destroy', $expense->id], 'method' => 'delete']) !!}
                                <td><button type="submit" class="btn-floating red"><i class="fas fa-trash" style="font-size: 1.3em; color: white"></i></button></td>
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
                <a href="calendar">
                    <div class="icon_to_center"><i class="far fa-calendar-check"></i></div>
                    <div class="font">カレンダー</div>
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
    
    <script src="js/main.js"></script>

@endsection
