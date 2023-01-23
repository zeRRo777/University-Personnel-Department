<?php

namespace api\services;

use api\exceptions\MainException;
use api\models\SubjectModel;

final class SubjectService
{
    public static function NewSubject($name):SubjectModel
    {
        $subject = new SubjectModel();
        $subject->name = $name;
        if ($subject->isUnique())
        {
            $subject->save();
            return $subject;
        }
        throw new MainException("", "Такого предмет уже есть");
    }
}