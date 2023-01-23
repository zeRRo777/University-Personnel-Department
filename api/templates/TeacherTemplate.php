<!DOCTYPE html>
<html lang="ru">
<?php
use api\models\DepartmentModel;
use api\models\DirectionModel;
use api\models\SubjectModel;
use api\services\ServiceTeacherInfo;

include_once "TegHeadTemplate.php";
$worker = $argv['worker'];
?>
<style>
    footer {
        position: absolute;
        left: 0;
        bottom: 0;
        width: 100%;
        height: 80px;
    }
</style>
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
                    <div class="center card-title">
                        <b>Show my Subjects</b>
                    </div>
                </div>

                <div class="col s3">&nbsp;</div>
                <div class="col s1">&nbsp;</div>

                <div class="row">
                    <div style="padding: 30px;" class="grey lighten-3 col s5 waves-effect">
                        <i class="indigo-text text-lighten-1 large material-icons">search</i>
                        <p>
                            <button
                                    data-target="modalShow" class="white-text text-lighten-1 indigo btn modal-trigger">Show
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="modalShow" class="modal">
        <div class="modal-content">
            <h4>Список всех предметов</h4>
            <table>
                <thead>
                <tr>
                    <th>My subjects</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $subjects = $worker->AllSubjectTeacher();
                echo "<tr>";
                echo "<td>$subjects</td>";
                echo "</tr>";
                ?>
                </tbody>
            </table>
            <div class="modal-footer">
                <a href="#!" class="modal-close waves-effect waves-indigo btn-flat">Закрыть</a>
            </div>
        </div>
    </div>

</main>

<?php include_once "footer.php"?>


<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="../../js/main.js"></script>
</body>
</html>