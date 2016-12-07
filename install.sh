#!/usr/bin/env bash

php ./payever-ch/app/console doctrine:migrations:migrate
/usr/sbin/sshd
apachectl -DFOREGROUND
