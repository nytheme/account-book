@extends('layouts.head')

@section('content')
    @foreach ($users as $user)
        <h2>{{ Auth::user()->name }} 編集画面</h2>
        {!! Form::open(['route' => 'edit_bud.store']) !!}
            <div style="display: none;">
                {!! Form::label('user_id', 'user_id:') !!}
                {!! Form::text('user_id', Auth::user()->id) !!}
            </div>
            <div>
                {!! Form::label('budget', '予算:') !!}
                {!! Form::text('budget') !!}
            </div>
            <div>
                {!! Form::label('day', '給料日:') !!}
                {!! Form::text('day') !!}
            </div>
        {!! Form::submit('登録') !!}
        {!! Form::close() !!}
            
        @foreach($budgets as $budget)
            {!! Form::model($budget, ['route' => ['edit_bud', $budget->id], 'method' => 'post']) !!}
            <div style="display: none;">
                {!! Form::label('user_id', 'user_id:') !!}
                {!! Form::text('user_id', $budget->user_id) !!}
            </div>
            <div>
                {!! Form::label('budget', '予算:') !!}
                {!! Form::text('budget', $budget->budget) !!}
            </div>
            <div>
                {!! Form::label('day', '給料日:') !!}
                {!! Form::text('day', $budget->day) !!}
            </div>
        {!! Form::submit('更新') !!}
        {!! Form::close() !!}
        
        <?php break; ?>
        @endforeach  
        
    <?php break; ?>
    @endforeach
    
    <h3>{!! link_to_route('logout.get', 'Logout') !!}</h3>
    
<footer>
    <div class="footer_icons">
        <div>
            <a href="show_exp">
                <div class="icon_to_center"><i class="fas fa-home icon"></i></div>
                <div class="font">ホーム</div>
            </a>
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
        <div class="selected">
            <div class="icon_to_center"><i class="far fa-laugh"></i></div>
            <div class="font">編集</div>
        </div>
    </div>
</footer>
    
@endsection
