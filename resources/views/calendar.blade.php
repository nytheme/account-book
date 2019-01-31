
<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="stylesheet" href="{{ secure_asset('css/list.css') }}">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        
        <title>家計簿</title>

    </head>
    <body>
        @foreach ($users as $user)
            <h2>{{ Auth::user()->name }} 家計簿</h2>
            <h3>{!! link_to_route('showEdit_bud', '編集画面へ') !!}</h3>
            @foreach($budgets as $budget)
                @if (Auth::id() !== $budget->user_id)
                    <h3>予算：-円（予算が未設定です）</h3>
                    <h3>支出合計：{{ $sum }}円</h3>
                    <h3>残高：-円</h3>
                    <h3>給料日：-日</h3>
                @elseif (Auth::id() == $budget->user_id && $budget->budget > 0 )
                    <h3>予算：{{ $budget->budget }}円</h3>
                    <h3>支出合計：{{ $sum }}円</h3>
                    <h3>残高：{{ $budget->budget - $sum }}円</h3>
                    <h3>給料日：{{ $budget->day }}日</h3>
                @endif 
                <?php break; ?>
            @endforeach
            
            @php
                $y = date('Y');
                $m = date('m');
                $wd1 = date("w", mktime(0, 0, 0, $m, 1, $y)); // 1日の曜日を取得
                $d = 1;
                $today = date('d');
                $ii = 101;
            @endphp
            <h3>{{ $y }}年 {{ $m }}月{{ $today }}日</h3>
            <table border="1">
                <tr>
                    <th>月</th><th>火</th><th>水</th><th>木</th><th>金</th><th>土</th><th>日</th>
                </tr>
                <tr>
                    @foreach ($expenses as $expense)
                    <?php
                        // 1日の曜日の前に空白を表示
                        for ($i = 2; $i <= $wd1; $i++) {
                            echo "<td></td>";
                        }
                        while (checkdate($m, $d, $y)) {
                           
                            echo "<td>$d<br> 
                                    
                                    $ii 円
                                    
                                </td>";
                            
                                if (date("w", mktime(0, 0, 0, $m, $d, $y)) == 0) {
                                    echo "</tr>"; // 週を終了
                                    
                                    // 次の週がある場合は新たな行を準備
                                    if (checkdate($m, $d + 1, $y)) {
                                        echo "<tr>";
                                    }
                                }
                            $d++;
                            $ii++;
                        };
                       
                    ?>
                    @endforeach
                <tr>
            </table>
            <h3>{{ $m }}月の買い物</h3>
            <table>
                <tr>
                    <th>分類</th><th>商品</th><th>価格</th><th>購入日</th>
                </tr>
                @foreach ($expenses as $expense)
                    <tr>
                        <td>{{ $expense->category }}</td><td>{{ $expense->name }}</td><td>{{ $expense->money }}円</td><td>{{ $expense->day }}</td>
                        <div class="deleteButton">
                        {!! Form::open(['route' => ['expenses.destroy', $expense->id], 'method' => 'delete']) !!}
                            <td><button type="submit"><i class="fas fa-eraser" style="font-size: 1.5em; color: white"></i></button></td>
                        {!! Form::close() !!}
                        </div>
                    </tr>
                @endforeach
            </table>
        <?php break; ?>
        @endforeach
        <h3>{!! link_to_route('write_exp', '買った物を登録する') !!}</h3>
        <h3>{!! link_to_route('past_exp', '月別ページへ') !!}</h3>
        <h3>{!! link_to_route('accountLists', '買い物リストへ') !!}</h3>
        <h3>{!! link_to_route('logout.get', 'Logout') !!}</h3>
    </body>
</html>
