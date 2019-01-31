@extends('layouts.head')

@section('content')

@foreach ($users as $user)
    <h2>{{ Auth::user()->name }} 欲しい物リスト</h2>

    @foreach ($accountLists as $accountList)
        <div>
            <div style="background-color: lightgrey;">
                {{ $accountList->created_at }}
            </div>
            <div class="ListName_flex">
                @if($accountList->switch == 0)
                    <div>
                        {!! Form::open(['route' => ['accountLists.edit', $accountList->id], 'method' => 'post']) !!}
                            <div style="display: none;">
                                {!! Form::text('switch', 1) !!}
                            </div>
                            <button type="submit" class="never">未購入</button>
                        {!! Form::close() !!}
                    </div> 
                    <div style="font-weight: bold;">
                        {{ $accountList->name }}
                    </div>   
                @else
                    <div>
                        {!! Form::open(['route' => ['accountLists.edit', $accountList->id], 'method' => 'post']) !!}
                            <div style="display: none;">
                                {!! Form::text('switch', 0) !!}
                            </div>
                            <button type="submit" class="aready">購入済</button>
                        {!! Form::close() !!}
                    </div>
                    <div style="text-decoration: line-through; font-weight: bold;">
                        {{ $accountList->name }}
                    </div>
                @endif
            </div><!--.ListName_flex-->
            @if($accountList->memo == !null)
                <p>メモ：{{ $accountList->memo }}</p>
            @endif
            <div class="deleteButton">
                {!! Form::open(['route' => ['accountLists.destroy', $accountList->id], 'method' => 'delete']) !!}
                    <button type="submit" class="delete"><i class="fas fa-trash" style="font-size: 1.5em; color: white"></i></button>
                {!! Form::close() !!}
            </div>
        </div>
    @endforeach
    
    <h3>欲しい物を登録してください</h3>
    {!! Form::open(['route' => 'accountLists.store']) !!}
        <div style="display: none">
            {!! Form::label('ID') !!}
            {!! Form::text('user_id', Auth::user()->id) !!}
        </div>
        <div>
            {!! Form::label('名前') !!}
            {!! Form::text('name') !!}
        </div>
        <div>
            {!! Form::label('メモ') !!}
            {!! Form::text('memo') !!}
        </div>
        <div style="display: none">
            {!! Form::label('switch') !!}
            {!! Form::text('switch', 0) !!}
        </div>
    {!! Form::submit('登録') !!}
    {!! Form::close() !!}
    
<?php break; ?>
@endforeach

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
        <div class="selected">
            <div class="icon_to_center"><i class="fas fa-shopping-cart"></i></div>
            <div class="font">欲しい物</div>
        </div>
        <div>
            <a href="edit_bud">
                <div class="icon_to_center"><i class="far fa-laugh"></i></div>
                <div class="font">編集</div>
            </a>
        </div>
    </div>
</footer>

@endsection
