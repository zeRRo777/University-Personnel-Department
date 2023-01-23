<!DOCTYPE html>
<html lang="ru">
<?php use api\models\DataWorkerModel;
use api\models\DepartmentModel;
use api\models\DirectionModel;
use api\models\DirectionSubjectModel;
use api\models\GroupModel;
use api\models\LogModel;
use api\models\SubjectModel;
use api\models\TeacherSubjectModel;
use api\models\WorkerModel;
use api\services\GroupService;
use api\services\ServiceModel;

include_once "TegHeadTemplate.php";
$worker = $argv['worker'];
?>
<body>
<ul id="slide-out" class="side-nav fixed z-depth-2">
    <?php include_once "LogoTemplate.php"?>
</ul>

<?php include_once "header.php"?>

<main>
    <div class="row">
        <div class="col s6">
            <div style="padding: 35px;" align="center" class="card">
                <div class="row">
                    <div class="left card-title">
                        <b>Management Directions</b>
                    </div>
                </div>

                <div class="row">
                    <div style="padding: 30px;" class="grey lighten-3 col s5 waves-effect">
                        <i class="indigo-text text-lighten-1 large material-icons">store</i>
                        <p>
                            <button
                                    data-target="modalAddDirection" class="white-text text-lighten-1 indigo btn modal-trigger">Create
                            </button>
                        </p>
                        <?php
                        if (isset($argv["AddDirectionSuccess"]))
                        {
                            echo "<span style='color: green'>Направление успешно добавлено!</span>";
                        }
                        if (isset($argv["AddDirectionWrong"]))
                        {
                            echo "<span style='color: red'>Такое направление уже есть!</span>";
                        }
                        ?>
                    </div>
                    <div class="col s1">&nbsp;</div>
                    <div class="col s1">&nbsp;</div>

                    <div style="padding: 30px;" class="grey lighten-3 col s5 waves-effect">
                        <i class="indigo-text text-lighten-1 large material-icons">store</i>
                        <p>
                            <button
                                    data-target="modalDeleteDirection" class="white-text text-lighten-1 indigo btn modal-trigger">Delete
                            </button>
                        </p>
                        <?php
                        if (isset($argv["DeleteDirectionSuccess"]))
                        {
                            echo "<span style='color: green'>Направление успешно удалено!</span>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col s6">
            <div style="padding: 35px;" align="center" class="card">
                <div class="row">
                    <div class="left card-title">
                        <b>Add and Delete Subject from Direction</b>
                    </div>
                </div>

                <div class="row">
                    <div style="padding: 30px;" class="grey lighten-3 col s5 waves-effect">
                        <i class="indigo-text text-lighten-1 large material-icons">subject</i>
                        <p>
                            <button
                                    data-target="modalAddSubjectDirection" class="white-text text-lighten-1 indigo btn modal-trigger">Add
                            </button>
                        </p>
                        <?php
                        if (isset($argv["AddDirsubSuccess"]))
                        {
                            echo "<span style='color: green'>Предмет успешно добавлен!</span>";
                        }
                        if (isset($argv["AddDirsubWrong"]))
                        {
                            echo "<span style='color: red'>Такой предмет уже есть у направления!</span>";
                        }
                        ?>
                    </div>
                    <div class="col s1">&nbsp;</div>
                    <div class="col s1">&nbsp;</div>

                    <div style="padding: 30px;" class="grey lighten-3 col s5 waves-effect">
                        <i class="indigo-text text-lighten-1 large material-icons">subject</i>
                        <p>
                            <button
                                    data-target="modalDeleteSubjectDirection" class="white-text text-lighten-1 indigo btn modal-trigger">Delete
                            </button>
                        </p>
                        <?php
                        if (isset($argv["DeleteDirsubSuccess"]))
                        {
                            echo "<span style='color: green'>Предмет успешно удален!</span>";
                        }
                        if (isset($argv["DeleteDirsubWrong"]))
                        {
                            echo "<span style='color: red'>Такого предмета нет у данного направления!</span>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            <div style="padding: 35px;" align="center" class="card">
                <div class="row">
                    <div class="center card-title">
                        <b>Show info about directions and subjects teachers</b>
                    </div>
                </div>

                <div class="row">
                    <div style="padding: 30px;" class="grey lighten-3 col s4 waves-effect">
                        <i class="indigo-text text-lighten-1 large material-icons">search</i>
                        <p>
                            <button
                                    data-target="modalShowDirection" class="white-text text-lighten-1 indigo btn modal-trigger">Show Directions
                            </button>
                        </p>
                    </div>

                    <div class="col s1">&nbsp;</div>


                    <div style="padding: 30px;" class="grey lighten-3 col s3 waves-effect">
                        <i class="indigo-text text-lighten-1 large material-icons">search</i>
                        <p>
                            <button
                                    data-target="modalShowSubjectDirection" class="white-text text-lighten-1 indigo btn modal-trigger">Show Directions Subjects
                            </button>
                        </p>
                    </div>

                    <div class="col s1">&nbsp;</div>

                    <div style="padding: 30px;" class="grey lighten-3 col s3 waves-effect">
                        <i class="indigo-text text-lighten-1 large material-icons">search</i>
                        <p>
                            <button
                                    data-target="modalShowTeachers" class="white-text text-lighten-1 indigo btn modal-trigger">Show Teachers Subjects
                            </button>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col s6">
            <div style="padding: 35px;" align="center" class="card">
                <div class="row">
                    <div class="left card-title">
                        <b>Add and Delete Subject Teachers</b>
                    </div>
                </div>

                <div class="row">
                    <div style="padding: 30px;" class="grey lighten-3 col s5 waves-effect">
                        <i class="indigo-text text-lighten-1 large material-icons">subject</i>
                        <p>
                            <button
                                    data-target="modalAddSubjectTeacher" class="white-text text-lighten-1 indigo btn modal-trigger">Add
                            </button>
                        </p>
                        <?php
                        if (isset($argv["AddTeacherSubSuccess"]))
                        {
                            echo "<span style='color: green'>Предмет успешно добавлен!</span>";
                        }
                        if (isset($argv["AddTeacherSubWrong"]))
                        {
                            echo "<span style='color: red'>Такой предмет уже есть у данного преподавателя!</span>";
                        }
                        ?>
                    </div>
                    <div class="col s1">&nbsp;</div>
                    <div class="col s1">&nbsp;</div>

                    <div style="padding: 30px;" class="grey lighten-3 col s5 waves-effect">
                        <i class="indigo-text text-lighten-1 large material-icons">subject</i>
                        <p>
                            <button
                                    data-target="modalDeleteSubjectTeacher" class="white-text text-lighten-1 indigo btn modal-trigger">Delete
                            </button>
                        </p>
                        <?php
                        if (isset($argv["DeleteTeacherSubSuccess"]))
                        {
                            echo "<span style='color: green'>Предмет успешно удален!</span>";
                        }
                        if (isset($argv["DeleteTeacherSubWrong"]))
                        {
                            echo "<span style='color: red'>Такого предмета нет у данного преподавателя!</span>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s6">
                <div style="padding: 35px;" align="center" class="card">
                    <div class="row">
                        <div class="left card-title">
                            <b>Add Subject</b>
                        </div>
                    </div>

                    <div class="row">
                        <div style="padding: 30px;" class="grey lighten-3 col s5 waves-effect">
                            <i class="indigo-text text-lighten-1 large material-icons">subject</i>
                            <p>
                                <button
                                        data-target="modalAddSubject" class="white-text text-lighten-1 indigo btn modal-trigger">Add
                                </button>
                            </p>
                            <?php
                            if (isset($argv["AddSubjectSuccess"]))
                            {
                                echo "<span style='color: green'>Предмет успешно добавлен!</span>";
                            }
                            if (isset($argv["AddSubjectWrong"]))
                            {
                                echo "<span style='color: red'>Такой предмет уже есть!</span>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include_once "footer.php"?>

<div id="modalAddDirection" class="modal">
    <div class="modal-content">
        <h4>Добавление направления</h4>
        <div class="row">
            <form class="col s12" action="" method="post">
                <div class="row">
                    <div class="input-field col s12">
                        <input id="name" name="name" type="text" class="validate">
                        <label for="name">Name Direction</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <button class="btn indigo waves-effect waves-light" type="submit">Добаваить направление
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                </div>
                <input type="hidden" name="type" value="add_direction">
            </form>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-indigo btn-flat">Закрыть</a>
        </div>
    </div>
</div>

<div id="modalDeleteDirection" class="modal">
    <div class="modal-content">
        <h4>Удаление Направления</h4>
        <div class="row">
            <form class="col s12" action="" method="post">
                <div class="row">
                    <div class="input-field col s6">
                        <select name="id_direction">
                            <option value="0" disabled selected>Выберите направление</option>
                            <?php
                            $directions = DirectionModel::getAll();
                            foreach ($directions as $direction)
                            {
                                if ($direction->id_department === $worker->id_department)
                                {
                                    echo "<option value=\"$direction->id\">$direction->name</option>";
                                }
                            }
                            ?>
                        </select>
                        <label>Directions</label>
                    </div>
                    <div class="input-field col s6">
                        <button class="btn indigo waves-effect waves-light" type="submit">Удалить направление
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                </div>
                <input type="hidden" name="type" value="delete_direction">
            </form>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-indigo btn-flat">Закрыть</a>
        </div>
    </div>
</div>

<div id="modalAddSubjectDirection" class="modal">
    <div class="modal-content">
        <h4>Добавть предмет к Направлению</h4>
        <div class="row">
            <form class="col s12" action="" method="post">
                <div class="row">
                    <div class="input-field col s6">
                        <select name="id_direction">
                            <option value="0" disabled selected>Выберите направление</option>
                            <?php
                            $directions = DirectionModel::getAll();
                            foreach ($directions as $direction)
                            {
                                if ($direction->id_department === $worker->id_department)
                                {
                                    echo "<option value=\"$direction->id\">$direction->name</option>";
                                }
                            }
                            ?>
                        </select>
                        <label>Directions</label>
                    </div>
                    <div class="input-field col s6">
                        <select name="id_subject">
                            <option value="0" disabled selected>Выберите предмет</option>
                            <?php
                            $subjects = SubjectModel::getAll();
                            foreach ($subjects as $subject)
                            {
                                echo "<option value=\"$subject->id\">$subject->name</option>";
                            }
                            ?>
                        </select>
                        <label>Subjects</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <button class="btn indigo waves-effect waves-light" type="submit">Добавить предмет
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                </div>
                <input type="hidden" name="type" value="add_dirsub">
            </form>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-indigo btn-flat">Закрыть</a>
        </div>
    </div>
</div>

<div id="modalDeleteSubjectDirection" class="modal">
    <div class="modal-content">
        <h4>Удалить предмет у Направления</h4>
        <div class="row">
            <form class="col s12" action="" method="post">
                <div class="row">
                    <div class="input-field col s6">
                        <select name="id_direction">
                            <option value="0" disabled selected>Выберите направление</option>
                            <?php
                            $dirsubs = DirectionSubjectModel::getAll();
                            foreach ($dirsubs as $dirsub)
                            {
                                $direction = DirectionModel::getById($dirsub->id_direction);
                                if ($direction->id_department === $worker->id_department)
                                {
                                    echo "<option value=\"$dirsub->id_direction\">$direction->name</option>";
                                }
                            }
                            ?>
                        </select>
                        <label>Directions</label>
                    </div>
                    <div class="input-field col s6">
                        <select name="id_subject">
                            <option value="0" disabled selected>Выберите предмет</option>
                            <?php
                            foreach ($dirsubs as $dirsub)
                            {
                                $subject = SubjectModel::getById($dirsub->id_subject);
                                echo "<option value=\"$dirsub->id_subject\">$subject->name</option>";
                            }
                            ?>
                        </select>
                        <label>Subjects</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <button class="btn indigo waves-effect waves-light" type="submit">Удалить предмет
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                </div>
                <input type="hidden" name="type" value="delete_dirsub">
            </form>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-indigo btn-flat">Закрыть</a>
        </div>
    </div>
</div>

<div id="modalShowDirection" class="modal">
    <div class="modal-content">
        <h4>Список всех направлений</h4>
        <table>
            <thead>
            <tr>
                <th>name</th>
                <th>department</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $directions = DirectionModel::getAll();
            foreach ($directions as $direction)
            {
                if ($direction->id_department === $worker->id_department)
                {
                    echo "<tr>";
                    echo "<td>$direction->name</td>";
                    $department = DepartmentModel::getById($direction->id_department);
                    echo "<td>$department->name</td>";
                    echo "</tr>";
                }
            }
            ?>
            </tbody>
        </table>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-indigo btn-flat">Закрыть</a>
        </div>
    </div>
</div>

<div id="modalShowSubjectDirection" class="modal">
    <div class="modal-content">
        <h4>Список всех предметов у направлений</h4>
        <table>
            <thead>
            <tr>
                <th>name</th>
                <th>subjects</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $directions = DirectionModel::getAll();
            foreach ($directions as $direction)
            {
                if ($direction->id_department === $worker->id_department)
                {
                    echo "<tr>";
                    echo "<td>$direction->name</td>";
                    $subjects = $direction->AllSubjects();
                    echo "<td>$subjects</td>";
                    echo "</tr>";
                }
            }
            ?>
            </tbody>
        </table>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-indigo btn-flat">Закрыть</a>
        </div>
    </div>
</div>

<div id="modalShowTeachers" class="modal">
    <div class="modal-content">
        <h4>Список преподавателей у направлений</h4>
        <table>
            <thead>
            <tr>
                <th>fio</th>
                <th>subjects</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $teachers = WorkerModel::getAll();
            foreach ($teachers as $teacher)
            {
                echo "<tr>";
                if ($worker->id_department === $teacher->id_department && $teacher->type === ROLE_TEACHER)
                {
                    $subjects = $teacher->AllSubjectTeacher();
                    echo "<td>$teacher->fio</td>";
                    echo "<td>$subjects</td>";
                }
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-indigo btn-flat">Закрыть</a>
        </div>
    </div>
</div>

<div id="modalAddSubjectTeacher" class="modal">
    <div class="modal-content">
        <h4>Добавть предмет Преподавателю</h4>
        <div class="row">
            <form class="col s12" action="" method="post">
                <div class="row">
                    <div class="input-field col s6">
                        <select name="id_teacher">
                            <option value="0" disabled selected>Выберите преподавателя</option>
                            <?php
                            $teachers = WorkerModel::getAll();
                            foreach ($teachers as $teacher)
                            {
                                if ($teacher->id_department === $worker->id_department && $teacher->type === ROLE_TEACHER)
                                {
                                    echo "<option value=\"$teacher->id\">$teacher->fio</option>";
                                }
                            }
                            ?>
                        </select>
                        <label>Teachers</label>
                    </div>
                    <div class="input-field col s6">
                        <select name="id_subject">
                            <option value="0" disabled selected>Выберите предмет</option>
                            <?php
                            $subjects = SubjectModel::getAll();
                            foreach ($subjects as $subject)
                            {
                                echo "<option value=\"$subject->id\">$subject->name</option>";
                            }
                            ?>
                        </select>
                        <label>Subjects</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <button class="btn indigo waves-effect waves-light" type="submit">Добавить предмет
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                </div>
                <input type="hidden" name="type" value="add_teacher_sub">
            </form>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-indigo btn-flat">Закрыть</a>
        </div>
    </div>
</div>

<div id="modalDeleteSubjectTeacher" class="modal">
    <div class="modal-content">
        <h4>Удалить предмет у Преподавателя</h4>
        <div class="row">
            <form class="col s12" action="" method="post">
                <div class="row">
                    <div class="input-field col s6">
                        <select name="id_teacher">
                            <option value="0" disabled selected>Выберите преподавателя</option>
                            <?php
                            $teachers = WorkerModel::getAll();
                            foreach ($teachers as $teacher)
                            {
                                if ($teacher->id_department === $worker->id_department && $teacher->type === ROLE_TEACHER)
                                {
                                    echo "<option value=\"$teacher->id\">$teacher->fio</option>";
                                }
                            }
                            ?>
                        </select>
                        <label>Teachers</label>
                    </div>
                    <div class="input-field col s6">
                        <select name="id_subject">
                            <option value="0" disabled selected>Выберите предмет</option>
                            <?php
                            $sub_teachers = TeacherSubjectModel::getAll();
                            foreach ($sub_teachers as $sub_teacher)
                            {
                                $subject = SubjectModel::getById($sub_teacher->id_subject);
                                echo "<option value=\"$subject->id\">$subject->name</option>";
                            }
                            ?>
                        </select>
                        <label>Subjects</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <button class="btn indigo waves-effect waves-light" type="submit">Удалить предмет
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                </div>
                <input type="hidden" name="type" value="delete_teacher_sub">
            </form>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-indigo btn-flat">Закрыть</a>
        </div>
    </div>
</div>

<div id="modalAddSubject" class="modal">
    <div class="modal-content">
        <h4>Добавить предмет</h4>
        <div class="row">
            <form class="col s12" action="" method="post">
                <div class="row">
                    <div class="input-field col s12">
                        <input id="name" name="name" type="text" class="validate">
                        <label for="name">Name Subject</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <button class="btn indigo waves-effect waves-light" type="submit">Добавить предмет
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                </div>
                <input type="hidden" name="type" value="add_subject">
            </form>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-indigo btn-flat">Закрыть</a>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="../../js/main.js"></script>
</body>
</html>