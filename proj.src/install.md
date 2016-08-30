install
=================

Installation
1. Install symfony vendor bundles with composer (`php composer.phar install` or whatever way you use composer)
2. After composer downloads all the libs needed, launch
`php app/console doctrine:migrations:migrate`
3. Then from root folder under superuser: 
`setfacl -R -m u:apache:rwx -m u:your_username:rwx var/cache var/logs
setfacl -dR -m u:apache:rwx -m u:your_username:rwx var/cache var/logs`
4. Install node libs (`npm update` node should be installed globally)
5. To install project's assets launch `npm run cp`
6. Put virtual host's doc root to web/