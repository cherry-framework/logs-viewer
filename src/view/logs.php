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
            <nav class="col-md-2 d-md-block sidebar">
                <div class="sidebar-sticky pt-3">
                    <h2>Log Files</h2>
                    <hr>
                    <ul class="nav flex-column">
                        <?php foreach ($logFiles as $k => $v): ?>
                            <li class="nav-item">
                                <a class="nav-link collapseLogsTable" href="#" data-togle="logsTableArea-<?php echo $k; ?>">
                                    <?php echo $v; ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
                <h2>Logs</h2>

                <?php
                $trClasses = [
                    'INFO' => 'table-info',
                    'WARNING' => 'table-warning',
                    'ERROR' => 'table-danger',
                    'DEBUG' => 'table-secondary'
                ];
                ?>

                <?php foreach ($allLogs as $k1 => $logs): ?>
                    <div class="table-responsive logsTableArea" id="logsTableArea-<?php echo $k1; ?>" <?php echo $k1 == 0 ?: 'hidden'; ?>>
                        <p>Found <b><?php echo $logsCount = count($logs); ?></b> <?php echo $logsCount == 1 || $logsCount == 0 ? 'log' : 'logs'; ?>.</p>

                        <table class="table table-striped table-sm logsTable">
                            <thead>
                            <tr>
                                <th>Date & Time</th>
                                <th>Log Level</th>
                                <th>Log Message</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($logs as $k2 => $log): ?>
                                <tr id="log-<?php echo $k1 . '-' . $k2; ?>" class="<?php echo $trClasses[$log['level']]; ?>">
                                    <td width="10%"><?php echo $log['dateTime']; ?></td>
                                    <td width="10%"><?php echo $log['level']; ?></td>
                                    <td width="80%"><?php echo $log['message']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endforeach; ?>
            </main>
        </div>
    </div>

    <footer class="page-footer font-small bg-dark pt-4">
        <div class="footer-copyright text-center py-3 text-light">© 2019-<?php echo date('Y'); ?> Copyright:
            <a href="https://github.com/cherry-framework"> Cherry Framework</a>.
        </div>
    </footer>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.logsTable').DataTable( {
                "order": [[ 0, "desc" ]]
            } );
        } );

        $('.collapseLogsTable').on('click', function () {
            let togle = $(this).data('togle');

            $('.logsTableArea').attr('hidden', true);
            $('#' + togle).attr('hidden', false);
        });
    </script>
</body>
</html>