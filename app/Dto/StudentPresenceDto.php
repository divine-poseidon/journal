<?php

namespace App\Dto;

class StudentPresenceDto
{
    public $date;
    public $lessonByCount;
    public $studentsPresent;
    public $subjectId;
    public $groupId;

    public function __construct(
        string $date,
        int $lessonByCount,
        array $studentsPresent,
        int $subject,
        int $group
    )
    {
        $this->date = $date;
        $this->lessonByCount = $lessonByCount;
        $this->studentsPresent = $studentsPresent;
        $this->subjectId = $subject;
        $this->groupId = $group;
    }

    public static function createFromRequest(array $request): StudentPresenceDto
    {
        $date = $request['date'];
        $lessonByCount = $request['lessonCount'];
        $studentsPresent = $request['students'] ?? [];
        $subject = $request['subject'];
        $group = $request['groupId'];
        return new self($date, $lessonByCount, $studentsPresent, $subject, $group);
    }
}
