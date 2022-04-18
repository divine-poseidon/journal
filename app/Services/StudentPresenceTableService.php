<?php

namespace App\Services;

use App\Models\Lesson;
use App\Models\LessonStudentPresence;
use Illuminate\Support\Collection;

class StudentPresenceTableService
{
    /**
     * @var Lesson[]
     */
    public $lessons;

    /**
     * @var LessonStudentPresence[]
     */
    public $lessonStudentsPresence;

    private $studentPresence;
    private $groupedLessons;

    public function __construct(Collection $lessons, Collection $lessonStudentsPresence)
    {
        $this->lessons = $lessons;
        $this->lessonStudentsPresence = $lessonStudentsPresence;
        $this->studentPresence = $this->prepareStudentPresence($lessons, $lessonStudentsPresence);
        $this->groupedLessons = $this->prepareLessons($lessons);
    }

    public function checkIfStudentWasPresent(string $date, int $lessonByCount, int $studentId): bool
    {
        if(isset($this->studentPresence[$date][$lessonByCount])) {
            $presentStudents = $this->studentPresence[$date][$lessonByCount][0];
            if(!in_array($studentId, $presentStudents, true)){
                return false;
            }
        }

        return true;
    }

    public function getLessonSubjectName(string $date, int $lessonByCount): string
    {
        /** @var $lesson Lesson*/
        if(isset($this->groupedLessons[$date][$lessonByCount])){
            $lesson = $this->groupedLessons[$date][$lessonByCount];
            $lessonName = $lesson->subject->name;
        }

        return $lessonName ?? '';
    }

    private function prepareStudentPresence(Collection $lessons, Collection $lessonStudentsPresence): array
    {
        $result = [];
        $groupedLessonPresence = $lessonStudentsPresence
            ->groupBy('lesson_id')
            ->toArray();

        foreach ($lessons as $lesson) {
            $presentStudents = $groupedLessonPresence[$lesson->id] ?? [];
            $result[$lesson->date][$lesson->lesson_by_count][] = array_column($presentStudents, 'student_id');
        }

        return $result;
    }

    /**
     * @param Lesson[] $lessons
     * @return array
     */
    private function prepareLessons(Collection $lessons): array
    {
        $result = [];

        foreach ($lessons as $lesson) {
            $result[$lesson->date][$lesson->lesson_by_count] = $lesson;
        }

        return $result;
    }
}
