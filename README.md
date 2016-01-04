# PCCronManagerBundle
[![Build Status](https://secure.travis-ci.org/parsing-corner/PCCronManagerBundle.png)](http://travis-ci.org/parsing-corner/PCCronManagerBundle) [![Latest Stable Version](https://poser.pugx.org/parsingcorner/cron-manager-bundle/v/stable)](https://packagist.org/packages/parsingcorner/cron-manager-bundle) [![Total Downloads](https://poser.pugx.org/parsingcorner/cron-manager-bundle/downloads)](https://packagist.org/packages/parsingcorner/cron-manager-bundle) [![Latest Unstable Version](https://poser.pugx.org/parsingcorner/cron-manager-bundle/v/unstable)](https://packagist.org/packages/parsingcorner/cron-manager-bundle) [![License](https://poser.pugx.org/parsingcorner/cron-manager-bundle/license)](https://packagist.org/packages/parsingcorner/cron-manager-bundle)

Manage cron tasks commands without relying on system operators


## Installation

### Step 1: Require bundle using composer

```Shell
$ composer require parsingcorner/cron-manager-bundle "~0.1"
```


### Step 2: Enable the bundle

```php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Parsingcorner\CronManagerBundle\ParsingcornerCronManagerBundle(),
        // ...
    );
}
```


### Step 3: Update your database schema

```Shell
$ php bin/console doctrine:schema:update --force
```


## Usage

### Create a new cron task

```php
<?php

//...
$this->get('parsingcorner.cron_manager.create_cron_task')->create(
    $name = 'CronTask Example',
    $description = 'Example cron task',
    $command = 'cache:clear',
    $interval = 'PT1H' // DateInterval format: http://php.net/manual/en/dateinterval.construct.php
);
//...

```

### Run

There are two ways to execute the cron manager: via a cronjob or via system daemon.
**Important:** the cron must be executed every minute to work properly.

#### Via Cronjob:

Add this line into your crontab file:

```
*/1  *   *   *   * php /path/to/your/project/app/console cron:execute --no-debug >/dev/null 2>&1
```

#### Via Daemon:

You could use [Upstart](http://upstart.ubuntu.com/). If you do so, create a file named cron-manager.conf and place it in /etc/init.d:

```bash
description "Cron tasks manager runner"
author "Parsingcorner"

# Tell Upstart to respawn our command on a crash
# stop restarting if it crashes more then 5 times within 10 seconds
respawn
respawn limit 5 10

# Tell Upstart to start us after MySQL started and shut us down on system shutdown
start on started mysql
stop on runlevel S

# Run as the www-data user and group
setuid www-data
setgid www-data

exec php /path/to/your/project/app/console cron:execute --daemon --no-debug >/dev/null 2>&1
```

To start the daemon, execute `start cron-manager`.



### Modify an existing cron task

```php
<?php

//...
$cronTask = $this->getDoctrine()->getRepository('ParsingcornerCronManagerBundle:TblCronTask')->find($id);
$this->get('parsingcorner.cron_manager.update_cron_task')->update(
    $cronTask,
    $name = 'CronTask Example updated',
    $description = 'Example cron task updated',
    $command = 'cache:clear --no-warmup',
    $interval = 'PT30M' // DateInterval format: http://php.net/manual/en/dateinterval.construct.php
);

$this->get('parsingcorner.cron_manager.update_cron_task')->deactivate($cronTask);
$this->get('parsingcorner.cron_manager.update_cron_task')->activate($cronTask);
//...

```

### Delete a cron task

```php
<?php

//...
$cronTask = $this->getDoctrine()->getRepository('ParsingcornerCronManagerBundle:TblCronTask')->find($id);
$this->get('parsingcorner.cron_manager.delete_cron_task')->delete($cronTask);

// It can also be deleted by id
// $this->get('parsingcorner.cron_manager.delete_cron_task')->deleteById($id);

//...

```


### List cron tasks

```php
<?php

//...
$allCronTasks = $this->get('parsingcorner.cron_manager.read_cron_task')->getAllCronTasks();
$activeCronTasks = $this->get('parsingcorner.cron_manager.read_cron_task')->getActiveCronTasks();
//...

```
