<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cherry framework Logs viewer</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.css"/>
</head>
<body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Cherry framework Logs viewer</a>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky pt-5">
                    <ul class="nav flex-column">

                        <?php foreach ($logFiles as $k => $v): ?>
                            <li class="nav-item">
                                <a class="nav-link active" href="#"><?php echo $v; ?></a>
                            </li>
                        <?php endforeach; ?>

                    </ul>
                </div>
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
                <h2>Logs</h2>

                <?php
                    $trClasses = [
                            'INFO'      => 'table-info',
                            'WARNING'   => 'table-warning',
                            'ERROR'     => 'table-danger',
                            'DEBUG'     => 'table-secondary'
                    ];
                ?>

                <div class="table-responsive">
                    <table class="table table-striped table-sm" id="logsTable">
                        <thead>
                        <tr>
                            <th>Date & Time</th>
                            <th>Log Level</th>
                            <th>Log Message</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($logs as $k => $log): ?>
                        <tr id="log-<?php echo $k; ?>" class="<?php echo $trClasses[$log['level']]; ?>">
                            <td><?php echo $log['dateTime']; ?></td>
                            <td><?php echo $log['level']; ?></td>
                            <td><?php echo $log['message']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#logsTable').DataTable( {
                "order": [[ 0, "desc" ]]
            } );
        } );
    </script>
</body>
</html>