## Stager:Transit Tracking System for Electric Buses 

The Electric bus tracker enhances commuter experience in the already chaoitic transport system in Kenya. The Application provides up to date information on current routes based on rea time monitoring capabilities. This enhances the commuter experience. 

### Installation Instructions - [Local Deployment]

To install, open command prompt and type:

```bash
$ cd C://xampp/htdocs/
$ git clone https://github.com/mwana/bts.git
$ cd cftracker
$ composer update
$ copy .env.example .env
$ php artisan key:generate
$ php artisan migrate
$ php artisan db:seed
$ php artisan storage:link
$ php artisan serve
```

### License

The cftracker project is open-sourced software licensed under the [Apache license](http://www.apache.org/licenses/).
