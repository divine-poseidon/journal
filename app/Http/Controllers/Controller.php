<?php

namespace App\Http\Controllers;

use App\Dto\StudentPresenceDto;
use App\Helpers\RoleHelper;
use App\Models\Group;
use App\Models\GroupSubject;
use App\Models\Lesson;
use App\Models\LessonStudentPresence;
use App\Models\Student;
use App\Models\Subject;
use App\Models\User;
use App\Services\StudentPresenceService;
use App\Services\StudentPresenceTableService;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Carbon\CarbonPeriod;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function show(Request $request)
    {
        $groupId = RoleHelper::isAdmin() ? $request->query('groupId') : Auth::user()->student->group->id;
        $dateFrom = $request->query('dateFrom') ?? Carbon::now()->subDays(6);
        $dateTo = $request->query('dateTo') ?? Carbon::now();

        $period = CarbonPeriod::create($dateFrom, $dateTo);
        $lessons = Lesson::whereBetween('date', [$dateFrom, $dateTo])
            ->where(['group_id' => $groupId])
            ->get();
        $lessonsIds = $lessons->pluck('id');
        $group = Group::find($groupId);
        $studentPresence = LessonStudentPresence::whereIn('lesson_id', $lessonsIds)->get();
        $tableService = new StudentPresenceTableService($lessons, $studentPresence);

        return view('student.presence-table', [
            'students' => $group->students,
            'lessons' => $lessons,
            'period' => $period,
            'studentPresence' => $studentPresence,
            'tableService' => $tableService
        ]);
    }

    public function form()
    {
        /** @var $user User */
        //$user = Auth::user();
        $user = User::find(1)->first();
        if ($user->student_id !== null) {
            $userGroup = $user->student->group;
            $groupStudents = $userGroup->students;
            $subjects = GroupSubject::where(['group_id' => $userGroup->id])->get();
            $subjectsIds = $subjects->pluck('subject_id');
            $groupSubjects = Subject::whereIn('id', $subjectsIds)->get();

            return view('student.presence-form', [
                'students' => $groupStudents,
                'group' => $userGroup,
                'groupSubjects' => $groupSubjects
            ]);
        }

        /* TODO: CHECK THIS SHIT*/
        throw new NotFoundHttpException('Invalid user');
    }

    public function processForm(Request $request): RedirectResponse
    {
        $studentPresenceDto = StudentPresenceDto::createFromRequest($request->post());
        /*TODO: validation*/
        (new StudentPresenceService())->savePresentStudents($studentPresenceDto);
        return redirect()->route('presenceTable');
    }
}
