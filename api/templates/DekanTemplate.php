<!DOCTYPE html>
<html lang="ru">
<?php use api\models\DataWorkerModel;
use api\models\DepartmentModel;
use api\models\DirectionModel;
use api\models\GroupModel;
use api\models\LogModel;
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
                        <b>Create and Delete Groups</b>
                    </div>
                </div>

                <div class="row">
                    <div style="padding: 30px;" class="grey lighten-3 col s5 waves-effect">
                        <i class="indigo-text text-lighten-1 large material-icons">groups</i>
                        <p>
                            <button
                                data-target="modalAddGroup" class="white-text text-lighten-1 indigo btn modal-trigger">Create
                            </button>
                        </p>
                        <?php
                        if (isset($argv["AddGroupSuccess"]))
                        {
                            echo "<span style='color: green'>Группа успешно добавлена!</span>";
                        }
                        ?>
                    </div>
                    <div class="col s1">&nbsp;</div>
                    <div class="col s1">&nbsp;</div>

                    <div style="padding: 30px;" class="grey lighten-3 col s5 waves-effect">
                        <i class="indigo-text text-lighten-1 large material-icons">groups</i>
                        <p>
                            <button
                                data-target="modalDeleteGroup" class="white-text text-lighten-1 indigo btn modal-trigger">Delete
                            </button>
                        </p>
                        <?php
                        if (isset($argv["DeleteGroupSuccess"]))
                        {
                        echo "<span style='color: green'>Группа успешно удалена!</span>";
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
                        <b>Create and Delete Departments</b>
                    </div>
                </div>

                <div class="row">
                    <div style="padding: 30px;" class="grey lighten-3 col s5 waves-effect">
                        <i class="indigo-text text-lighten-1 large material-icons">store</i>
                        <p>
                            <button
                                data-target="modalAddDepartment" class="white-text text-lighten-1 indigo btn modal-trigger">Create
                            </button>
                        </p>
                        <?php
                        if (isset($argv["AddDepartmentSuccess"]))
                        {
                            echo "<span style='color: green'>Кафедра успешно добавлена!</span>";
                        }
                        ?>
                    </div>
                    <div class="col s1">&nbsp;</div>
                    <div class="col s1">&nbsp;</div>

                    <div style="padding: 30px;" class="grey lighten-3 col s5 waves-effect">
                        <i class="indigo-text text-lighten-1 large material-icons">store</i>
                        <p>
                            <button
                                data-target="modalDeleteDepartment" class="white-text text-lighten-1 indigo btn modal-trigger">Delete
                            </button>
                        </p>
                        <?php
                        if (isset($argv["DeleteDepartmentSuccess"]))
                        {
                            echo "<span style='color: green'>Кафедра успешно удалена!</span>";
                        }
                        ?>
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
                        <b>Update Groups and Departments</b>
                    </div>
                </div>

                <div class="row">
                    <div style="padding: 30px;" class="grey lighten-3 col s5 waves-effect">
                        <i class="indigo-text text-lighten-1 large material-icons">groups</i>
                        <p>
                            <button
                                data-target="modalUpdateGroup" class="white-text text-lighten-1 indigo btn modal-trigger">Group
                            </button>
                        </p>
                        <?php
                        if (isset($argv["UpdateGroupSuccess"]))
                        {
                            echo "<span style='color: green'>Данные успешно изменены!</span>";
                        }
                        ?>
                    </div>
                    <div class="col s1">&nbsp;</div>
                    <div class="col s1">&nbsp;</div>

                    <div style="padding: 30px;" class="grey lighten-3 col s5 waves-effect">
                        <i class="indigo-text text-lighten-1 large material-icons">store</i>
                        <p>
                            <button
                                data-target="modalUpdateDepartment" class="white-text text-lighten-1 indigo btn modal-trigger">Department
                            </button>
                        </p>
                        <?php
                        if (isset($argv["UpdateDepartmentSuccess"]))
                        {
                            echo "<span style='color: green'>Данные успешно изменены!</span>";
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
                        <b>Display Groups and Departments</b>
                    </div>
                </div>

                <div class="row">
                    <div style="padding: 30px;" class="grey lighten-3 col s5 waves-effect">
                        <i class="indigo-text text-lighten-1 large material-icons">groups</i>
                        <p>
                            <button
                                data-target="modalDisplayGroup" class="white-text text-lighten-1 indigo btn modal-trigger">Dispay
                            </button>
                        </p>
                    </div>
                    <div class="col s1">&nbsp;</div>
                    <div class="col s1">&nbsp;</div>

                    <div style="padding: 30px;" class="grey lighten-3 col s5 waves-effect">
                        <i class="indigo-text text-lighten-1 large material-icons">store</i>
                        <p>
                            <button
                                data-target="modalDisplayDepartment" class="white-text text-lighten-1 indigo btn modal-trigger">Display
                            </button>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include_once "footer.php"?>

<div id="modalAddGroup" class="modal">
    <div class="modal-content">
        <h4>Добавление группы</h4>
        <div class="row">
            <form class="col s12" action="" method="post">
                <div class="row">
                    <div class="input-field col s12">
                        <input id="name" name="name" type="text" class="validate">
                        <label for="name">Name Group</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <select name="id_direction">
                            <option value="0" disabled selected>Выберите направление</option>
                            <?php
                            $directions = DirectionModel::getAll();
                            foreach ($directions as $direction)
                            {
                                echo "<option value=\"$direction->id\">$direction->name</option>";
                            }
                            ?>
                        </select>
                        <label>Directions</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="amount-students" name="amount_students" type="text" class="validate">
                        <label for="amount-students">Amount Students</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <button class="btn indigo waves-effect waves-light" type="submit">Добаваить группу
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                </div>
                <input type="hidden" name="type" value="add_group">
            </form>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-indigo btn-flat">Закрыть</a>
        </div>
    </div>
</div>

<div id="modalDeleteGroup" class="modal">
    <div class="modal-content">
        <h4>Удаление группы</h4>
        <div class="row">
            <form class="col s12" action="" method="post">
                <div class="row">
                    <div class="input-field col s6">
                        <select name="id_group">
                            <option value="0" disabled selected>Выберите группу</option>
                            <?php
                            $groups = GroupModel::getAll();
                            foreach ($groups as $group)
                            {
                                echo "<option value=\"$group->id\">$group->name</option>";
                            }
                            ?>
                        </select>
                        <label>Groups</label>
                    </div>
                    <div class="input-field col s6">
                        <button class="btn indigo waves-effect waves-light" type="submit">Удалить группу
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                </div>
                <input type="hidden" name="type" value="delete_group">
            </form>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-indigo btn-flat">Закрыть</a>
        </div>
    </div>
</div>

<div id="modalAddDepartment" class="modal">
    <div class="modal-content">
        <h4>Добавление кафедры</h4>
        <div class="row">
            <form class="col s12" action="" method="post">
                <div class="row">
                    <div class="input-field col s12">
                        <input id="name" name="name" type="text" class="validate">
                        <label for="name">Name Department</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <input id="amount-teachers" name="amount_teachers" type="text" class="validate">
                        <label for="amount-students">Amount Teachers</label>
                    </div>
                    <div class="input-field col s6">
                        <button class="btn indigo waves-effect waves-light" type="submit">Добаваить кафедру
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                </div>
                <input type="hidden" name="type" value="add_department">
            </form>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-indigo btn-flat">Закрыть</a>
        </div>
    </div>
</div>

<div id="modalDeleteDepartment" class="modal">
    <div class="modal-content">
        <h4>Удаление Кафедры</h4>
        <div class="row">
            <form class="col s12" action="" method="post">
                <div class="row">
                    <div class="input-field col s6">
                        <select name="id_department">
                            <option value="0" disabled selected>Выберите кафедру</option>
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
                        <button class="btn indigo waves-effect waves-light" type="submit">Удалить кафедру
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                </div>
                <input type="hidden" name="type" value="delete_department">
            </form>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-indigo btn-flat">Закрыть</a>
        </div>
    </div>
</div>

<div id="modalUpdateGroup" class="modal">
    <div class="modal-content">
        <h4>Изменение колво студентов в группе</h4>
        <div class="row">
            <form class="col s12" action="" method="post">
                <div class="row">
                    <div class="input-field col s6">
                        <select name="id_group">
                            <option value="0" disabled selected>Выберите группу</option>
                            <?php
                            $groups = GroupModel::getAll();
                            foreach ($groups as $group)
                            {
                                echo "<option value=\"$group->id\">$group->name</option>";
                            }
                            ?>
                        </select>
                        <label>Groups</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="new-amount-students" name="new_amount_students" type="text" class="validate">
                        <label for="new-amount-students">New Amount Students</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <button class="btn indigo waves-effect waves-light" type="submit">Изменить колво студентов
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                </div>
                <input type="hidden" name="type" value="update_group">
            </form>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-indigo btn-flat">Закрыть</a>
        </div>
    </div>
</div>

<div id="modalUpdateDepartment" class="modal">
    <div class="modal-content">
        <h4>Изменение колво преподвателей на кафедре</h4>
        <div class="row">
            <form class="col s12" action="" method="post">
                <div class="row">
                    <div class="input-field col s6">
                        <select name="id_department">
                            <option value="0" disabled selected>Выберите кафедру</option>
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
                        <input id="new-amount-teachers" name="new_amount_teachers" type="text" class="validate">
                        <label for="new-amount-students">New Amount Teachers</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <button class="btn indigo waves-effect waves-light" type="submit">Изменить колво преподавателей
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                </div>
                <input type="hidden" name="type" value="update_department">
            </form>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-indigo btn-flat">Закрыть</a>
        </div>
    </div>
</div>

<div id="modalDisplayGroup" class="modal">
    <div class="modal-content">
        <h4>Список всех групп</h4>
        <table>
            <thead>
            <tr>
                <th>name</th>
                <th>amount students</th>
                <th>direction</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $groups = GroupModel::getAll();
            foreach ($groups as $group)
            {
                echo "<tr>";
                echo "<td>$group->name</td>";
                echo "<td>$group->amount_students</td>";
                $direction = DirectionModel::getById($group->id_direction);
                echo "<td>$direction->name</td>";
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

<div id="modalDisplayDepartment" class="modal">
    <div class="modal-content">
        <h4>Список всех кафедр</h4>
        <table>
            <thead>
            <tr>
                <th>name</th>
                <th>amount teachers</th>
                <th>headteacher</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $departments = DepartmentModel::getAll();
            foreach ($departments as $department)
            {
                echo "<tr>";
                echo "<td>$department->name</td>";
                echo "<td>$department->amount_teachers</td>";
                if ($department->id_headteacher !== null)
                {
                    $worker = WorkerModel::getById($department->id_headteacher);
                    echo "<td>$worker->fio</td>";
                }
                else{
                    echo "<td>$department->id_headteacher</td>";
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

<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="../../js/main.js"></script>
</body>
</html>