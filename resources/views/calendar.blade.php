@extends('layouts.head')

@section('content')

    <div class="container">
        <?php
            // 前月・次月リンクが押された場合は、GETパラメーターから年月を取得
            if (isset($_GET['ym'])) {
                $ym = $_GET['ym'];
            } else {
                // 今月の年月を表示
                $ym = date('Y-m');
            }
            // タイムスタンプを作成し、フォーマットをチェックする
            $timestamp = strtotime($ym . '-01');
            if ($timestamp === false) {
                $ym = date('Y-m');
                $timestamp = strtotime($ym . '-01');
            }
            // カレンダーのタイトルを作成　例）2017年7月
            $html_title = date('Y年n月', $timestamp);
            // 前月・次月の年月を取得
            // 方法１：mktimeを使う mktime(hour,minute,second,month,day,year)
            $prev = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)-1, 1, date('Y', $timestamp)));
            $next = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)+1, 1, date('Y', $timestamp)));
        ?>
        <h3><a href="?ym=<?php echo $prev; ?>">&lt;</a> <?php echo $html_title; ?> <a href="?ym=<?php echo $next; ?>">&gt;</a></h3>
        <table>
            <tr>
                <th>月</th><th>火</th><th>水</th><th>木</th><th>金</th><th class='calender'>土</th><th class='calender'>日</th>
            </tr>
            <tr>
                @foreach ($expenses as $expense)
                    <?php
                        $y = substr($ym, 0, 4);//date('Y');
                        $m = substr($ym, 5, 2);//date('m');
                        $d = 1;
                        $today = date('Y-m-j');
                        
                        // 1日の曜日の前に空白を表示
                        $wd1 = date("w", mktime(0, 0, 0, $m, 1, $y));
                        for ($i = 2; $i <= $wd1; $i++) {
                            echo "<td></td>";
                        }
                        //カレンダー作成
                        while (checkdate($m, $d, $y)) {
                            $date = $ym . '-' . $d;
                            $day = sprintf('%02d', $d);//1桁の数字を二桁表示
                            $day_for_expression = $y.'-'.$m.'-'.$day;//検索用の当日日付表示
                            //DBから該当データを呼び出すSQL文
                            $calender_expenses = \App\Expense::where('user_id', \Auth::id())->where('day', $day_for_expression)->get()->toArray();
                            $calender_expense = array_column( $calender_expenses, 'money' );
                            
                            if($calender_expense != null){
                                if($today == $date){
                                    echo "<td class='calender'>
                                            <p class='today'>$d</p>";
                                    $spending = number_format($calender_expense[0]);
                                    echo    "<a href='#' class='spending'>¥$spending</a>
                                          </td>";
                                } else {
                                    echo "<td class='calender'>
                                            <p>$d</p>";
                                    $spending = number_format($calender_expense[0]);
                                    echo    "<a href='#' class='spending'>¥$spending</a>
                                          </td>";
                                }
                            } else {
                                if($today == $date){
                                    echo "<td class='calender'>
                                            <p class='today'>$d</p>
                                            -
                                          </td>";
                                } else {
                                    echo "<td class='calender'>
                                            <p>$d</p>
                                            -
                                          </td>";
                                }
                            }
                                if (date("w", mktime(0, 0, 0, $m, $d, $y)) == 0) { //0は日曜。W=日曜なら週を終了
                                    echo "</tr>"; // 列を閉じる
                                    
                                    // 次の週がある場合は新たな行を準備
                                    if (checkdate($m, $d + 1, $y)) { //週終了日に一日プラスした日から新しい列をスタート→whileへ
                                        echo "<tr>";
                                    }
                                }
                            $d++;
                        };  //while (checkdate($m, $d, $y)) 
                    ?>
                    
                    <?php break; ?>
                    
                @endforeach<!--($expenses as $expense)-->
            </tr>
        </table><!--カレンダーここまで-->

    </div><!--.cintainer-->
        
    <footer>
        <div class="footer_icons">
            <a href="show_exp">
                <div class="icon_to_center"><i class="fas fa-home icon"></i></div>
                <div class="font">ホーム</div>
            </a>
            <div>
                <a href="past_exp">
                    <div class="icon_to_center"><i class="fas fa-list-ul"></i></div> 
                    <div class="font">家計簿</div>
                </a>
            </div>
            <div>
                <div class="selected">
                    <div class="icon_to_center"><i class="far fa-calendar-check"></i></div>
                    <div class="font">カレンダー</div>
                </div>
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
