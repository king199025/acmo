Выполняем команду init

Выполняем командуcomposer update

Создаем БД и подключаем в конфиге

Миграции для user:

1. yii migrate/up --migrationPath=@vendor/dektrium/yii2-user/migrations
2. yii migrate/up --migrationPath=@yii/rbac/migrations
3. yii migrate/up

Для закрытия доступа к админпанели не админам в контролере использовать


              'AccessSecure' =>
                [
                    'class' => AccessSecure::className(),
                    'rules' => [
                        [
                            'actions' => ['login', 'error'],
                            'allow' => true,
                        ],
                        [
                            'allow' => true,
                            'roles' => ['admin'],
                        ],
                    ],
                ],


Для формирования транслитерации в названиях в composer.json добавить

        "2amigos/yii2-transliterator-helper": "*"

        В моделях

        public function behaviors()
            {
                return [
                    'slug' => [
                        'class' => 'common\behaviors\Slug',
                        'in_attribute' => 'title',
                        'out_attribute' => 'slug',
                        'translit' => true
                    ],
                ];
            }
