<!DOCTYPE html>
<html lang="ru">
<?php use api\models\DataWorkerModel;
use api\models\DepartmentModel;
use api\models\LogModel;
use api\models\WorkerModel;
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
        <div style="padding: 35px;" align="center" class="card">
            <div class="row">
                <div class="center card-title">
                    <b>Worker Management</b>
                </div>
            </div>

            <div class="row">
                <div class="col s1">&nbsp;</div>
                <div style="padding: 30px;" class="grey lighten-3 col s2 waves-effect">
                    <i class="indigo-text text-lighten-1 large material-icons">person</i>
                    <p>
                    <button
                            data-target="modalAdd" class="white-text text-lighten-1 indigo btn modal-trigger">Add
                    </button>
                    </p>
                    <?php
                    if (isset($argv['Dekan']))
                    {
                        echo "<span style='color: red'>Декан может быть только один</span>";
                    }

                    if (isset($argv['HeadTeacher']))
                    {
                        echo "<span style='color: red'>У данной кафедры уже есть зав.кафедры</span>";
                    }

                    if (isset($argv['addWorkerSuccess']))
                    {
                        echo "<span style='color: green'>Сотрудник успешно добавлен!</span>";
                    }
                    ?>
                </div>

                <div class="col s1">&nbsp;</div>
                <div class="col s1">&nbsp;</div>

                <div style="padding: 30px;" class="grey lighten-3 col s2 waves-effect">
                    <i class="indigo-text text-lighten-1 large material-icons">person</i>
                    <p>
                        <button
                                data-target="modalUpdate" class="white-text text-lighten-1 indigo btn modal-trigger">Update
                        </button>
                    </p>
                    <?php
                    if (isset($argv["UpdateSuccess"]))
                    {
                        echo "<span style='color: green'>Данные успешно заменены!</span>";
                    }
                    ?>
                </div>

                <div class="col s1">&nbsp;</div>
                <div class="col s1">&nbsp;</div>

                <div style="padding: 30px;" class="grey lighten-3 col s2 waves-effect">
                    <i class="indigo-text text-lighten-1 large material-icons">person</i>
                    <p>
                        <button
                                data-target="modalDelete" class="white-text text-lighten-1 indigo btn modal-trigger">Delete
                        </button>
                    </p>
                    <?php
                    if (isset($argv["DeleteSuccess"]))
                    {
                        echo "<span style='color: green'>Сотрудник успешно удален!</span>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div style="padding: 35px;" align="center" class="card">
            <div class="row">
                <div class="center card-title">
                    <b>Display Workers</b>
                </div>
            </div>

            <div class="row">
                <div class="col s1">&nbsp;</div>
                <div style="padding: 30px;" class="grey lighten-3 col s4 waves-effect">
                    <i class="indigo-text text-lighten-1 large material-icons">people</i>
                    <p>
                        <button
                                data-target="modalShowRealWorkers" class="white-text text-lighten-1 indigo btn modal-trigger">Show real workers
                        </button>
                    </p>
                </div>

                <div class="col s1">&nbsp;</div>
                <div class="col s1">&nbsp;</div>

                <div style="padding: 30px;" class="grey lighten-3 col s4 waves-effect">
                    <i class="indigo-text text-lighten-1 large material-icons">people</i>
                    <p>
                        <button
                                data-target="modalShowOldWorkers" class="white-text text-lighten-1 indigo btn modal-trigger">Show old workers
                        </button>
                    </p>
                </div>

            </div>
        </div>
    </div>
</main>

<?php include_once "footer.php"?>

<div id="modalAdd" class="modal">
    <div class="modal-content">
        <h4>Добавление сотрудника</h4>
        <div class="row">
            <form class="col s12" action="" method="post">
                <div class="row">
                    <div class="input-field col s12">
                        <input id="fio" name="fio" type="text" class="validate">
                        <label for="fio">Fio</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <input id="experience" name="exp" type="text" class="validate">
                        <label for="experience">Experience</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="salary" type="text" name="salary" class="validate">
                        <label for="salary">Salary</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <input id="age" type="date" name="age" class="validate">
                    </div>
                    <div class="input-field col s6">
                        <select name="type_worker">
                            <option value="" disabled selected>Выберите тип работника</option>
                            <option value="0">Worker</option>
                            <option value="1">Dekan</option>
                            <option value="2">Teacher</option>
                            <option value="3">HeadTeacher</option>
                        </select>
                        <label>Worker Type</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <select name="id_department">
                            <option value="0" disabled selected>Выберите департамент</option>
                            <option value="0">null</option>
                            <?php
                                $departments = DepartmentModel::getAll();
                                foreach ($departments as $department)
                                {
                                    echo "<option value=\"$department->id\">$department->name</option>";
                                }
                            ?>
                        </select>
                        <label>Departments</label>
                    </div>
                    <div class="input-field col s6">
                        <button class="btn indigo waves-effect waves-light" type="submit">Добаваить работника
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                </div>
                <input type="hidden" name="type" value="add">
            </form>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-indigo btn-flat">Закрыть</a>
        </div>
    </div>
</div>

<div id="modalUpdate" class="modal">
    <div class="modal-content">
        <h4>Изменение данных сотрудника</h4>
        <div class="row">
            <form class="col s12" action="" method="post">
                <div class="row">
                    <div class="input-field col s12">
                        <select name="id_worker">
                            <option value="" disabled selected>Выберите работника</option>
                            <?php
                                $workers = WorkerModel::getAll();
                                foreach ($workers as $worker)
                                {
                                    echo "<option value=\"$worker->id\">$worker->fio</option>";
                                }
                            ?>
                        </select>
                        <label>Worker</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <select  name="param">
                            <option value="" disabled selected>Выберите параметр</option>
                            <option value="fio">fio</option>
                            <option value="salary">salary</option>
                            <option value="experience">experience</option>
                        </select>
                        <label>param update</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="new_value" name="new_value" type="text" class="validate">
                        <label for="new_value">new_value</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <button class="btn indigo waves-effect waves-light" type="submit">Изменить выбранный  параметр
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                </div>
                <input type="hidden" name="type" value="update">
            </form>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-indigo btn-flat">Закрыть</a>
        </div>
    </div>
</div>

<div id="modalDelete" class="modal">
    <div class="modal-content">
        <h4>Удаление сотрудника</h4>
        <div class="row">
            <form class="col s12" action="" method="post">
                <div class="row">
                    <div class="input-field col s12">
                        <select name="id_worker">
                            <option value="" disabled selected>Выберите работника</option>
                            <?php
                            $workers = WorkerModel::getAll();
                            foreach ($workers as $worker)
                            {
                                if ($worker->id !== $_SESSION['idUser'])
                                {
                                    echo "<option value=\"$worker->id\">$worker->fio</option>";
                                }
                            }
                            ?>
                        </select>
                        <label>Worker</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <button class="btn indigo waves-effect waves-light" type="submit">Удалить работника
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                </div>
                <input type="hidden" name="type" value="delete">
            </form>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-indigo btn-flat">Закрыть</a>
        </div>
    </div>
</div>

<div id="modalShowRealWorkers" class="modal">
    <div class="modal-content">
        <h4>Список всех работников</h4>
        <table>
            <thead>
            <tr>
                <th>Fio</th>
                <th>Department</th>
                <th>age</th>
                <th>experience</th>
                <th>salary</th>
                <th>type</th>
                <th>login</th>
                <th>password</th>
            </tr>
            </thead>
            <tbody>
            <?php
                $workers = WorkerModel::getAll();
                foreach ($workers as $worker)
                {
                    echo "<tr>";
                    echo "<td>$worker->fio</td>";
                    if ($worker->id_department !== null)
                    {
                        $department = DepartmentModel::getById($worker->id_department);
                        echo "<td>$department->name</td>";
                    }
                    else
                    {
                        echo "<td>$worker->id_department</td>";
                    }
                    echo "<td>$worker->age</td>";
                    echo "<td>$worker->experience</td>";
                    echo "<td>$worker->salary</td>";
                    echo "<td>$worker->type</td>";
                    $data_worker = DataWorkerModel::getByIdName($worker->id, "id_worker");
                    echo "<td>$data_worker->login</td>";
                    echo "<td>$data_worker->password</td>";
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

<div id="modalShowOldWorkers" class="modal">
    <div class="modal-content">
        <h4>Список старых работников</h4>
        <table>
            <thead>
            <tr>
                <th>Fio</th>
                <th>id_department</th>
                <th>age</th>
                <th>experience</th>
                <th>salary</th>
                <th>type</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $old_workers = LogModel::getAll();
            foreach ($old_workers as $old_worker)
            {
                echo "<tr>";
                echo "<td>$old_worker->fio</td>";
                echo "<td>$old_worker->id_department</td>";
                echo "<td>$old_worker->age</td>";
                echo "<td>$old_worker->experience</td>";
                echo "<td>$old_worker->salary</td>";
                $type = match ($old_worker->type)
                {
                    ROLE_WORKER=> "Сотр.отд.кадров",
                    ROLE_DEKAN=> "Декан",
                    ROLE_TEACHER=> "Преподаватель",
                    ROLE_HEADTEACHER => "Зав.кафедры"
                };
                echo "<td>$type</td>";
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
<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="/js/main.js"></script>
</body>
</html>
