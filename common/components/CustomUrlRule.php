<?php

namespace common\components;

use yii\web\UrlRuleInterface;
use yii\base\Object;
use backend\models\Routes;
use backend\models\RouteUrls;

class CustomUrlRule extends Object implements UrlRuleInterface
{
    public function createUrl($manager, $route, $params)
    {
        $route = Routes::findOne(['route' => $route]);

        $paramsStr = sizeof($params) > 0 ? '?' . http_build_query($params): '';

        if (!empty($route)) {
            return $route->lastRouteUrl->url . $paramsStr;
        }
        return false;  // this rule does not apply
    }

    public function parseRequest($manager, $request)
    {
        $pathInfo = $request->getPathInfo();
        $params = $request->getQueryParams();

        $routeUrl = RouteUrls::findOne(['url' => $pathInfo]);

        if (!empty($routeUrl)) {
            $route = $routeUrl->route;
            if ($routeUrl->id !== $route->lastRouteUrl->id) {
                \Yii::$app->response->redirect($route->lastRouteUrl->url, 301)->send();
            }
            return [$route->route, $params];
        }
        return false;  // this rule does not apply
    }
}