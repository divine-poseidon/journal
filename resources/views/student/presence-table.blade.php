<?php

use App\Models\Lesson;
use App\Models\LessonStudentPresence;
use App\Models\Student;
use App\Services\StudentPresenceTableService;
use Carbon\CarbonPeriod;

/**
 * @var $students Student[]
 * @var $tableService StudentPresenceTableService
 * @var $lessons Lesson[]
 * @var $studentPresence LessonStudentPresence[]
 * @var $period CarbonPeriod
 */
?>
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-16">
                <table class="center">
{{--                    <tr>--}}
{{--                        <td style="text-align:center;border: 1px solid #000"></td>--}}
{{--                        <td style="text-align:center;border: 1px solid #000"></td>--}}
{{--                        @foreach($period as $date)--}}
{{--                            @for ($counter = 1; $counter < 5; $counter++)--}}
{{--                                @if($tableService->getLessonSubjectName($date->format('Y-m-d'), $counter) !== '')--}}
{{--                                    <td style="text-align:center;border: 1px solid #000;transform-origin: 0 0;transform: rotate(90deg);">--}}
{{--                                        {{ $tableService->getLessonSubjectName($date->format('Y-m-d'), $counter) }}--}}
{{--                                    </td>--}}
{{--                                @else--}}
{{--                                    <td style="text-align:center;border: 1px solid #000">--}}
{{--                                        &nbsp;&nbsp;--}}
{{--                                    </td>--}}
{{--                                @endif--}}
{{--                            @endfor--}}
{{--                        @endforeach--}}
{{--                    </tr>--}}
                    <tr>
                        <th style="text-align:center;border: 1px solid #000">№<br>з/п</th>
                        <th style="text-align:center;border: 1px solid #000">Прізвище та ініціали студента</th>
                        @foreach($period as $date)
                            <th style="text-align:center;border: 1px solid #000" colspan="4">
                                {{ \App\Helpers\DateHelper::getDayName($date->format('l')) . ' ' . $date->format(' d.m.Y')}}
                            </th>
                        @endforeach
                    </tr>
                    @foreach ($students as $number => $student)
                        <tr>
                            <td style="text-align:center;border: 1px solid #000">{{ ++$number }}</td>
                            <td style="text-align:center;border: 1px solid #000">{{ $student->fullName() }}</td>
                            @foreach($period as $date)
                                @for ($counter = 1; $counter < 5; $counter++)
                                    @if($tableService->checkIfStudentWasPresent($date->format('Y-m-d'), $counter, $student->id) === false)
                                        <td style="text-align:center;border: 1px solid #000">Н</td>
                                    @else
                                        <td style="text-align:center;border: 1px solid #000">&nbsp;&nbsp;</td>
                                    @endif
                                @endfor
                            @endforeach
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection

