# cherry-Log-Viewer
The Cherry-project Logs Viewer

[![GitHub license](https://img.shields.io/github/license/cherry-framework/logs-viewer.svg)](https://github.com/cherry-framework/logs-viewer/blob/master/LICENSE)

[![GitHub release](https://img.shields.io/github/release/cherry-framework/logs-viewer.svg)](https://github.com/cherry-framework/logs-viewer/releases)

[![Packagist Version](https://img.shields.io/packagist/v/cherry-project/logs-viewer.svg "Packagist Version")](https://packagist.org/packages/cherry-project/logs-viewer "Packagist Version")

------------

## Including
**Install from composer** `composer require cherry-project/logs-viewer`

**Include Autoloader in your main file** (Ex.: index.php)
```php
require_once __DIR__ . '/vendor/autoload.php';
```

## Usage

**Logs Viewer** works only with [Cherry Logger](https://github.com/cherry-framework/logger) logs!

Import class

```php
use Cherry\Log\LogViewer;
```

Define path to your logs
```php
define('LOGS_PATH', __DIR__ . '/var/logs');
```

**Note**: If you use [Cherry Core](https://github.com/cherry-framework/core)
 or [Cherry Framework](https://github.com/cherry-framework/framework), path must defined in config file:
```json
{
  "LOGS_PATH": "var/logs"
}
```

Crete class new object

```php
$viewer = new LogViewer();
```

Finally you need to render the Log Viewer view:
```php
$viewer->render();
```

**2019 &copy; Cherry-project**
