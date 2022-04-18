<?php

namespace App\Services;

use App\Dto\StudentPresenceDto;
use App\Models\Lesson;
use App\Models\LessonStudentPresence;
use Illuminate\Support\Facades\DB;

class StudentPresenceService
{
    public function savePresentStudents(StudentPresenceDto $studentPresenceDto): void
    {
        DB::beginTransaction();

        try {
            $lesson = $this->saveLesson($studentPresenceDto);
            $this->clearExistingLessonPresence($lesson);
            $data = $this->prepareStudentPresenceData($studentPresenceDto, $lesson);
            LessonStudentPresence::insert($data);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollback();
            throw $exception;
        }
    }

    private function prepareStudentPresenceData(StudentPresenceDto $studentPresenceDto, Lesson $lesson): array
    {
        $result = [];

        $lessonId = $lesson->id;

        foreach ($studentPresenceDto->studentsPresent as $studentId) {
            $result[] = [
                'lesson_id' => $lessonId,
                'student_id' => $studentId,
            ];
        }

        return $result;
    }

    private function saveLesson(StudentPresenceDto $studentPresenceDto): Lesson
    {
        $lesson = Lesson::where(['date' => $studentPresenceDto->date])
            ->where(['group_id' => $studentPresenceDto->groupId])
            ->where(['subject_id' => $studentPresenceDto->subjectId])
            ->where(['lesson_by_count' => $studentPresenceDto->lessonByCount]);

        if($lesson->exists()){
            return $lesson->first();
        }

        return Lesson::create([
            'date' => $studentPresenceDto->date,
            'group_id' => $studentPresenceDto->groupId,
            'subject_id' => $studentPresenceDto->subjectId,
            'lesson_by_count' => $studentPresenceDto->lessonByCount
        ]);
    }

    private function clearExistingLessonPresence(Lesson $lesson): void
    {
        LessonStudentPresence::where(['lesson_id' => $lesson->id])->delete();
    }
}
