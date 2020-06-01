<?php
//    $chat = 1;
?>
@extends('layouts.app')

@section('css-styles')
    <link rel="stylesheet" href="{{ asset('css/styleMainForm.css') }}">
@endsection

@section('content')
    <div id="wrap" style="background-image: url({{ asset('images/messageBG.jpg') }})">
        <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm" >
                <div class="modal-content" style="color:white;background: rgb(61, 61, 61);">
                    <div class="modal-body">
                        <div class="row justify-content-center ">
                            <div class="col-10 ">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="modal-title">Выберите собеседников</h5>
                                    </div>
                                </div>
                                <form>
                                    <div class="row">
                                        <div class="col py-2">
                                            <label for="selectUsers">Выберите пользователя/ей</label>
                                            <select multiple class="form-control" id="selectUsers" style="color:white;background: rgb(61, 61, 61);">
                                                <option>1</option>
                                                <option>2</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row float-right">
                                        <div class="col">
                                            <button type="submit" class="btn btn-success ">Подтвердить</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade profile-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog  modal-sm float-left w-50" >
                <div class="modal-content" style="color:white;background: rgb(61, 61, 61); height: 90vh;">
                    <div class="modal-body">
                        <div class="row justify-content-center ">
                            <div class="col-10 ">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="modal-title">Профиль</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col my-1">
                                        <i class="fas fa-at">Имя</i>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col my-1">
                                        <i class="far fa-envelope"> E-mail</i>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col my-1">
                                        <i class="far fa-clock">Дата регистрации </i>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col my-1">
                                        <h5>Статистика сообщений:</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col my-1">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Выберите беседу
                                            </button>
                                            <div class="dropdown-menu" style="background: rgb(61, 61, 61);">
                                                <a class="dropdown-item dropItem" href="#">Стас</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col my-1">
                                        <div class="font-weight-bold">
                                            <i class="far fa-clock"></i>Дата первого сообщения: 1123123123
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col my-1">
                                        <div class="font-weight-bold">
                                            <i class="far fa-clock"></i>Дата последнего сообщения: 1
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col my-1">
                                        <div class="font-weight-bold">
                                            Количество сообщений:
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row vh-100 ">

                <div class="col-2 ">
                    <div class="row">
                        <div class="col mt-2">
                            <i class="fas fa-grip-lines fa-2x drop" role="button" data-toggle="modal" data-target=".profile-modal"></i>
                        </div>
                    </div>
                </div>

                <div class="col-2 border-right border-left border-top  border-success border-2 messBG">
                    <!-- Поиск пользователей -->
                    <div class="row" style = "height: 10%;">
                        <div class="col border-bottom border-success border-2 pt-2 dropdown" id="dropDownMenu">
                            <input type="text" class="form-control userSearch-dropdown" placeholder="Найти пользователя"
                                   aria-label="Найти пользователя" aria-describedby="basic-addon1"
                                   id="userSearch">
{{--                            <button class="d-none" data-toggle="dropdown" id="btnSearch"></button>--}}
                            <div id="userSearchDropdown" class="dropdown-menu" aria-labelledby="userSearch">
                            </div>
                        </div>
                    </div>
                    <!-- Поиск пользователей -->

                    <!-- Область названий бесед -->
                    <div class="row " style = "height: 90%;">
                        <div class="col border-bottom border-success border-2 overflow" id="chatsBlock">

                        <!-- Блок беседы, используй btn-success, чорт -->
                        @foreach($userChats as $userChat)
                            <div class="row row-14">
                                <div class="col">
                                    <button type="button" class="btn btn-outline-success w-100 mt-2 chatBtn" onclick="openChat({{$userChat['id']}})"
                                            data-chat="{{$userChat['name']}}" id="chatBtn_{{$userChat['id']}}">
                                        <div class="text-left">
                                            <div class="d-block font-weight-bold text-truncate">
                                                {{ $userChat['name'] }}
                                            </div>
                                            @if($userChat['lastMessage'])
                                                <div class="d-block text-truncate">
                                                    @if($userChat['lastMessage']->user->id == Auth::user()->id)
                                                        <span class="badge badge-success">Вы</span>
                                                    @else
                                                        <span class="badge badge-success">{{ $userChat['lastMessage']->user->name }}</span>
                                                    @endif
                                                    <span id="lastMessageContent">{{$userChat['lastMessage']->content}}</span>
                                                </div>
                                            @endif
                                        </div>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                            <!-- Блок беседы, используй btn-success, чорт -->

                        </div>
                    </div>
                    <!-- Область названий бесед -->

                    <!-- Профиль -->
                    <!-- <div class="row" style = "height: 10%;">
                        <div class="col border-bottom border-success border-2" >
                            <a class="btn btn-success btn-sm mt-1" href="#">Профиль/статистика сообщений</a>
                        </div>
                    </div> -->
                    <!-- Профиль -->

                </div>
                <div class="col-6 border-right border-top border-bottom border-success border-2 messBG" id="chatArea">
                <!-- Название беседы -->
                    <span id="chatContent" class="d-none">
                        <div class="row" style="height: 10%;">
                            <div class="col-8 border-bottom border-success border-2" >
                                <h5 id="chatName" class="white-text mt-3 text-truncate">

                                </h5>
                            </div>
                            <div class="col-4 border-bottom border-success border-2">
                                <div class="dropleft">
                                    <i class="fas fa-ellipsis-h fa-2x float-right mt-3 drop" role="button" id="dropdownMenuButton"
                                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <button class="dropdown-item" role="button"
                                           data-target=".bd-example-modal-sm" onclick="addUserModal(this)">Добавить собеседника</button>
{{--                                        <a class="dropdown-item" href="#">Что то еще</a>--}}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row" style = "height: 80%;">
                            <div class="col border-bottom border-success border-2 d-flex flex-column-reverse overflow"
                                 id="messageBox">
                            </div>
                        </div>

                        <div class="row" style = "height: 10%;">
                            <div class="col border-success border-2 py-2">
                                <form id="messageSendForm" action="{{route('message_store')}}" method="post">
                                    <input type="text" class="d-none" name="user_id" value="">
                                    <input type="text" class="d-none" name="chat_id" value="">
                                    <input type="text" class="form-control " placeholder="Напишите сообщение"
                                           aria-label="Напишите сообщение" aria-describedby="basic-addon1" name="content">
                                    <button type="submit" class="d-none"></button>
                                </form>
                            </div>
                        </div>
                    </span>
                </div>

                <div class="col-2 "></div>
            </div>
        </div>
    </div>
@endsection

@section('js-script')
    <script !src="">
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#messageSendForm').on('submit', function (e) {
                e.preventDefault();
                let message = $('input[name="content"]').val().trimLeft();
                if (message) {
                    $.ajax({
                        type: 'POST',
                        url: `/message/send`,
                        data: $(this).serialize(),

                        success: function (data) {
                            $('#messageBox').prepend(`
                                <div class="row mb-2 word-wrap">
                                    <div class="col">
                                        <span class="float-right">${data['content']}</span>
                                    </div>
                                </div>
                            `);
                            $('input[name="content"]').val('');
                            $('#lastMessageContent').html(data['content']);
                        },
                        error: function (data) {
                            console.log(data);
                        }
                    });
                }
            });
        });

        $('#userSearch').on('keyup', function () {
            $.ajax({
                type: 'GET',
                url: '/user/search',
                data: {'search' : $('#userSearch').val()},

                success: function (data) {
                    $('#userSearchDropdown').html(null);
                    data.map(function (_this) {
                        $('#userSearchDropdown').append(`
                            <button class="dropdown-item" onclick="startChat(${_this['id']})">${_this['name']}</button>
                        `);
                    });
                    $('.userSearch-dropdown').dropdown('toggle');
                },
                error: function (data) {
                    console.log(data);
                }
            });
        });

        $(':not(#dropDownMenu)').on('click', function () {
            $('.userSearch-dropdown').dropdown('hide');
        });

        function startChat(user) {
            $.ajax({
                type: 'POST',
                url: `/chat/create/${user}`,

                success: function (data) {

                    if (data['new']) {
                        addChat(data['chat']);
                    }

                    $(`#chatBtn_${data['chat']['id']}`).click();

                },
                error: function (data) {
                    console.log(data);
                }
            });
        }

        function addChat(chat) {
            $('#chatsBlock').append(`
                <div class="row row-14">
                    <div class="col">
                        <button type="button" class="btn btn-success btn-outline-success w-100 mt-2 chatBtn"
                                onclick="openChat(${chat['id']})" data-chat="${chat['name']}" id="chatBtn_${chat['id']}">
                            <div class="text-left">
                                <div class="d-block font-weight-bold text-truncate">
                                    ${chat['name']}
                                </div>
                                <div class="d-block text-truncate">
                                </div>
                            </div>
                        </button>
                    </div>
                </div>
            `);
        }

        function openChat(chat_id) {
            let chat = $(`#chatBtn_${chat_id}`);
            $('.chatBtn.btn-success').removeClass('btn-success');
            chat.addClass('btn-success');

            let user_id = '{{Auth::user()->id}}';

            $('#chatContent').removeClass('d-none');

            $('#chatName').html(chat.data('chat'));
            $('input[name="chat_id"]').val(chat_id);
            $('input[name="user_id"]').val(user_id);

            $.ajax({
                type: 'GET',
                url: `chat/${chat_id}/get-messages`,

                success: function (data) {
                    let user_id = '{{Auth::user()->id}}';
                    $('#messageBox').html(null);
                    data.map(function (_this) {
                        if (user_id == _this['user']['id']) {
                            $('#messageBox').prepend(`
                                <div class="row mb-2 word-wrap justify-content-end">
                                    <div class="col-auto mr-2">
                                        <span>${_this['content']}</span>
                                    </div>
                                </div>
                            `);
                        } else {
                            $('#messageBox').prepend(`
                                <div class="row mb-2 word-wrap">
                                    <div class="col-auto">
                                        <span class="badge badge-success font-weight-bold">${_this['user']['name']}</span>
                                        <span>${_this['content']}</span>
                                    </div>
                                </div>
                            `);
                        }
                    });
                },
                error: function (data) {
                    console.log(data);
                }
            });
        }

        function addUserModal(_this) {
            $.ajax({
                type: 'GET',
                url: '{{route('user_get_users', ['user' => Auth::user()->id])}}',

                success: function (data) {
                    console.log(data);
                    let result = [];

                    for(let i in data)
                        result.push(data [i]);

                    console.log(result);

                    let list = $('#selectUsers');
                    list.html(null);

                    result.map(function (_this) {
                        list.append(`
                            <option value="${_this['id']}">${_this['name']}</option>
                        `);
                    });

                    $('.bd-example-modal-sm').modal('toggle');

                },

                error: function (data) {
                    console.log(data);
                }
            })
        }
    </script>
@endsection
