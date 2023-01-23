<header>
    <nav>
        <div class="indigo nav-wrapper">
            <ul class="right hide-on-med-and-down">
                <li><a href="auth">Logout</a></li>
            </ul>
        </div>
    </nav>

    <nav>
        <div class="nav-wrapper indigo darken-2">
            <span id="type-worker">
                <?php
                use api\models\DepartmentModel;
                echo match ($argv['worker']->type)
                {
                    ROLE_WORKER=>"Worker",
                    ROLE_DEKAN=>"Dekan",
                    ROLE_TEACHER=>"Teacher",
                    ROLE_HEADTEACHER=>"HeadTeacher"
                };
                if ($argv['worker']->id_department !== null)
                {
                    $department = DepartmentModel::getById($argv['worker']->id_department);
                    echo " ".(string)$department->name;
                }
                ?>
            </span>
            <div id="timestamp" class="right"></div>
        </div>
    </nav>
</header>
