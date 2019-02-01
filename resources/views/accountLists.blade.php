@extends('layouts.head')

@section('content')

    <div class="container">
        @foreach ($users as $user)
            <h2>欲しい物リスト</h2>
            
            <a class="list_btn waves-effect waves-light btn-small modal-trigger" href="#modal1">登録</a>
            
            @foreach ($accountLists as $accountList)
                <table class="listTable">
                    <tr class="date">
                        <th class="date">
                            {{ $accountList->created_at }}
                        </th>
                    </tr>
                    @if($accountList->switch == 0)
                    <tr>    
                        <td>
                            <div class="ListName_flex">
                                <div>
                                    {!! Form::open(['route' => ['accountLists.edit', $accountList->id], 'method' => 'post']) !!}
                                        <div style="display: none;">
                                            {!! Form::text('switch', 1) !!}
                                        </div>
                                        <button type="submit" class="btn-small red"></button>
                                    {!! Form::close() !!}
                                </div>
                                <div class="name">
                                   {{ $accountList->name }}
                                </div>
                            </div>    
                        </td> 
                    </tr>   
                    @else
                    <tr>    
                        <td>
                            <div class="ListName_flex">
                                <div>
                                    {!! Form::open(['route' => ['accountLists.edit', $accountList->id], 'method' => 'post']) !!}
                                        <div style="display: none;">
                                            {!! Form::text('switch', 0) !!}
                                        </div>
                                        <button type="submit" class="btn-small white" style="border: solid 1px lightgrey;"></button>
                                    {!! Form::close() !!}
                                </div>    
                                <div class="lined_name">
                                    {{ $accountList->name }}
                                </div>
                            </div> 
                        </td>
                    </tr>        
                    @endif
                    <tr>
                        @if($accountList->memo == !null)
                            <td>メモ：{{ $accountList->memo }}</td>
                        @endif
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="deleteButton">
                                {!! Form::open(['route' => ['accountLists.destroy', $accountList->id], 'method' => 'delete']) !!}
                                    <button type="submit" class="btn-floating red"><i class="fas fa-trash" style="font-size: 1.2em; color: white"></i></button>
                                {!! Form::close() !!}
                            </div>
                        </td>
                    </tr>
                </table>
            @endforeach

            <!-- Modal Structure -->
            <div id="modal1" class="modal">
                <div class="modal-content">
                    <h4>欲しい物を登録してください</h4>
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
                        <button type="submit" class="btn">登録</button>
                    {!! Form::close() !!}
                </div><!--.modal-content-->
                <div class="modal-footer">
                    <a href="#!" class="modal-close waves-effect waves-green btn-flat">閉じる</a>
                </div>
            </div>

        <?php break; ?>
        @endforeach
        <hr class="make_bottom">
    </div><!--.container-->
    
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
                <a href="edit">
                    <div class="icon_to_center"><i class="far fa-laugh"></i></div>
                    <div class="font">編集</div>
                </a>
            </div>
        </div>
    </footer>
    
    <script src="js/main.js"></script>
    
@endsection
