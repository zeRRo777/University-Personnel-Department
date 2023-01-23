<?php

namespace api\models;

use api\core\Model;


final class DirectionSubjectModel extends Model
{
    protected static string $tableName = "Direction_Subject";
    public int $id_direction;
    public null|int $id_subject;

    public function isUnique():bool
    {
        $dirsubs = self::getAll();
        foreach ($dirsubs as $dirsub)
        {
            if ($dirsub->id_subject === $this->id_subject && $this->id_direction === $dirsub->id_direction)
            {
                return false;
            }
        }
        return true;
    }

}