Office 365 functionality for Yii 2 AuthClient
=============================================

Quick guide
-----------

1. Place files in vendor directory using composer or manually. If using composer add entries to site composer.json and run _composer update_ in site root.

        "require-dev": {
        	"cranedev/yii2-authclientO365": "@dev"
        }
        
        "repositories": [
            {
                "type": "path",
                "url": "/PATH/TO/yii2-authclientO365"
            }
        ]

2. Apply migration to create database tables

        use yii\db\Migration;
        
        class ???timestamp???_oauth extends Migration
        {
            public function up()
            {
                $this->createTable('user', [
                    'id' => $this->primaryKey(),
                    'username' => $this->string()->notNull(),
                    'auth_key' => $this->string()->notNull(),
                    'password_hash' => $this->string()->notNull(),
                    'password_reset_token' => $this->string()->notNull(),
                    'email' => $this->string()->notNull(),
                    'status' => $this->smallInteger()->notNull()->defaultValue(10),
                    'created_at' => $this->integer()->notNull(),
                    'updated_at' => $this->integer()->notNull(),
                ]);
        
                $this->createTable('auth', [
                    'id' => $this->primaryKey(),
                    'user_id' => $this->integer()->notNull(),
                    'source' => $this->string()->notNull(),
                    'source_id' => $this->string()->notNull(),
                ]);
        
                $this->addForeignKey('fk-auth-user_id-user-id', 'auth', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
            }
        
            public function down()
            {
                $this->dropTable('auth');
                $this->dropTable('user');
            }
        }

3. Create models for Auth and User using GII.

4. In controller apply

        public function actions()
        {
            return [
                'o365auth' => [
                    'class' => 'cranedev\authclientO365\Office365AuthAction',
                    'successCallback' => [$this, 'onAuthSuccess'],
                ],
            ];
        }
    
        public function onAuthSuccess($client)
        {
            (new AuthHandler($client))->handle();
        }

5. In view apply widget

        <?= AuthChoice::widget([
            'baseAuthUrl' => ['site/o365auth'],
            'popupMode' => false,
        ]) ?>
        
6. In site _web.php_ apply

        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'Office365OAuth' => [
                    'class' => 'cranedev\authclientO365\Office365OAuth',
                    'clientId' => 'CLIENT_ID',
                    'clientSecret' => 'CLIENT_SECRET',
                ],
            ],
        ],
        
7. Modify _web/css/site.css_ to show windows icon in widget

        .office365 {
            background-position: 0 -272px;
        }
        
        ul.auth-clients {
            margin: 0px;
            -webkit-margin-before: 0px;
            -webkit-margin-after: 0px;
            -webkit-margin-start: 0px;
            -webkit-margin-end: 0px;
            -webkit-padding-start: 0px;
        }