<?php
/**
 * @var $groups Group[]
 * @var $user User
 */

use App\Models\Group;
use App\Models\User;

?>
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Виберіть потрібний проміжок часу') }}</div>
                    <form method="GET" action="{{ route('presenceTable') }}">
                        @csrf
                        @if(\App\Helpers\RoleHelper::isAdmin())
                            <div class="form-group">
                                <label for="groups">Група:</label>
                                <select id="groups" name="groupId" class="form-control">
                                    <option value="" selected disabled>Виберіть групу:</option>
                                    @foreach ($groups as $group)
                                        <option value="{{$group->id}}">{{ $group->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="date">Дата з:</label>
                            <input type="date"
                                   id="date"
                                   name="dateFrom"
                                {{--min="2018-01-01" max="2018-12-31"--}}
                            >
                        </div>
                        <div class="form-group">
                            <label for="date">Дата по:</label>
                            <input type="date"
                                   id="date"
                                   name="dateTo"
                                {{--min="2018-01-01" max="2018-12-31"--}}
                            >
                        </div>

                        <button type="submit">Отримати</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
