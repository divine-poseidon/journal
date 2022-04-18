<?php
/**
 * @var $students Student[]
 * @var $groupSubjects Subject[]
 * @var $group Group
 */

use App\Models\Group;
use App\Models\Student;
use App\Models\Subject;

?>
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="POST" action="/fill-presence">
                    @csrf
                    <input type="text" name="groupId" value="{{ $group->id }}" hidden>
                    <div class="form-group">
                        <label for="date">Дата:</label>
                        <input type="date"
                               id="date"
                               name="date"
                               value="{{\Carbon\Carbon::now()->format('Y-m-d')}}"
                            {{--min="2018-01-01" max="2018-12-31"--}}
                        >
                    </div>
                    <div class="form-group">
                        <label for="subject">Предмет:</label>
                        <select id="subject" name="subject" class="form-control">
                            <option value="" selected disabled>Виберіть предмет:</option>
                            @foreach ($groupSubjects as $subject)
                                <option value="{{$subject->id}}">{{ $subject->name }}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="lessonCount">Пара:</label>
                        <select id="lessonCount" name="lessonCount" class="form-control">
                            <option value="" selected disabled>Виберіть пару:</option>
                            <option value="1">Пара 1</option>
                            <option value="2">Пара 2</option>
                            <option value="3">Пара 3</option>
                            <option value="4">Пара 4</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="studentPresenceCheckboxes">Присутні студенти:</label>
                        <div class="form-check" id="studentPresenceCheckboxes">
                            @foreach ($students as $student)
                                <div class="checkbox">
                                    <label>
                                        <input class="form-check-input"
                                               type="checkbox"
                                               value="{{$student->id}}"
                                               id="studentCheckBox{{$student->id}}"
                                               name="students[]"
                                        >
                                        {{$student->fullName()}}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <button type="submit">Відправити</button>
                </form>
            </div>
        </div>
    </div>
@endsection
