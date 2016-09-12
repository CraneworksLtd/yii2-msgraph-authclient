<?php
/**
 * Created by PhpStorm.
 * User: anttikoivisto
 * Date: 31/08/16
 * Time: 15:38
 */

namespace cranedev\authclientO365;

use Yii;
use yii\authclient\AuthAction;
use yii\web\NotFoundHttpException;

class Office365AuthAction extends AuthAction
{
    /**
     * Runs the action.
     */
    public function run()
    {
        $clientId = 'Office365OAuth';
        /* @var $collection \yii\authclient\Collection */
        $collection = Yii::$app->get($this->clientCollection);

        if (!$collection->hasClient($clientId)) {
            throw new NotFoundHttpException("Unknown auth client '{$clientId}'");
        }
        $client = $collection->getClient($clientId);

        return $this->auth($client);
    }
}