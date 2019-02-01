@extends('layouts.head')

@section('content')

    <?php   //年月日から曜日を割り出す
        $today = date('Y/m/d');
        $today_without_year = date('n/j');  //nとjはmとdの一桁表示
        $datetime = new DateTime($today);
        $week = array("日", "月", "火", "水", "木", "金", "土");
        $w = (int)$datetime->format('w');
    ?>
    <!--日にち-->
    {{ $today_without_year }}({{ $week[$w] }})

        @foreach ($users as $user)
            <h3>{{ Auth::user()->name }}</h3>
            <table style="width: 100%;">
                <tr>
                    <th>予算</th><th>支出</th><th>残高</th>
                </tr>
                @foreach($budgets as $budget)
            
                    @if (Auth::id() !== $budget->user_id)
                    <tr>
                        <th><a href="edit_bud">未設定</a></th>
                        <th>：¥{{ number_format($this_month_sum) }}</th>
                        <th>-</th>
                    </tr>
                    @elseif (Auth::id() == $budget->user_id && $budget->budget > 0 )
                    <tr>
                        <th>¥{{ number_format($budget->budget) }}</th>
                        <th>¥{{ number_format($this_month_sum) }}</th>
                        @if($budget->budget - $this_month_sum < 0)
                            <th style="color: red;">¥{{ number_format($budget->budget - $this_month_sum) }}</th>
                        @else
                            <th>¥{{ number_format($budget->budget - $this_month_sum) }}</th>
                        @endif
                    </tr>
                    @endif 
                <?php break; ?>
            
                @endforeach
            </table>
        
        <?php break; ?>
        @endforeach
        
        <!--チャート-->
        <div id="container"></div>
        
        <footer>
            <div class="footer_icons">
                <div class="selected">
                    <div class="icon_to_center"><i class="fas fa-home icon"></i></div>
                    <div class="font">ホーム</div>
                </div>
                <div>
                    <a href="past_exp">
                        <div class="icon_to_center"><i class="fas fa-list-ul"></i></div> 
                        <div class="font">家計簿</div>
                    </a>
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
                    <a href="edit_bud">
                        <div class="icon_to_center"><i class="far fa-laugh"></i></div>
                        <div class="font">編集</div>
                    </a>
                </div>
            </div>
        </footer>
        
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/highcharts.src.js"></script>
        <script>
        //チャート用のPHP変数をJS変数に
        var food = '{{ ($food / $budget->budget)*100 }}';
        var medical = '{{ ($medical / $budget->budget)*100 }}';
        var fixed = '{{ ($fixed / $budget->budget)*100 }}';
        var clothes = '{{ ($clothes / $budget->budget)*100 }}';
        var pocket = '{{ ($pocket / $budget->budget)*100 }}';
        var daily = '{{ ($daily / $budget->budget)*100 }}';
        var outdoor = '{{ ($outdoor / $budget->budget)*100 }}';
        var others = '{{ ($others / $budget->budget)*100 }}';
        
        Highcharts.chart('container', {
          chart: {
            plotBackgroundColor: null,
            plotBorderWidth: 0,
            plotShadow: false
          },
          title: false,
          tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
          },
          plotOptions: {
            pie: {
              dataLabels: {
                enabled: false,
                distance: -50,
                style: {
                  fontWeight: 'bold',
                  fontSize: '10',
                  color: 'white'
                },
                
              },
              showInLegend: true,
            }
          },
          series: [{
            type: 'pie',
            name: '支出',
            innerSize: '50%',
            data: [
              ['食費：¥{{ number_format($food) }}', Number(food)],
              ['保険・医療：¥{{ number_format($medical) }}', Number(medical)],
              ['固定費：¥{{ number_format($fixed) }}', Number(fixed)],
              ['衣類：¥{{ number_format($clothes) }}', Number(clothes)],
              ['小遣い：¥{{ number_format($pocket) }}', Number(pocket)],
              ['日用品：¥{{ number_format($daily) }}', Number(daily)],
              ['レジャー：¥{{ number_format($outdoor) }}', Number(outdoor)],
              ['その他：¥{{ number_format($others) }}', Number(others)],
            ],
          }]
        });
        </script> 

    

    

@endsection
