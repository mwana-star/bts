## Carbon Emission Footprint Tracker

The Environmental Sustainability Tracker is an innovative platform that enables individuals 
and communities to track their environmental impact and foster sustainable practices. It 
integrates carbon footprint calculators, personalized recommendations, and a credit system to 
raise awareness, provide actionable insights, and incentivize positive environmental change.

### Installation Instructions - [Local Deployment]

To install, open command prompt and type:

```bash
$ cd C://xampp/htdocs/
$ git clone https://github.com/Peishyy/cftracker.git
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
