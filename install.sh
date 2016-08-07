#!/usr/bin/env bash

php ./payever-ch/app/console doctrine:migrations:migrate
apachectl -DFOREGROUND