<?php

namespace App\Models;
namespace App\Models\Repository;
namespace App\Models\TransfertManager;

use App\Models\Repository\getAccountByid;
use App\Models\Repository\getAccountByowner;
use App\Models\Repository\getBalanceByowner;
use App\Models\Repository\getBeneficiaryByid;
use App\Models\Repository\getLabel;
use App\Models\Repository\getCountries; 
use App\Models\Repository\getCountrycode;
use App\Models\Repository\getCurrency;
use App\Models\Repository\getCurrencyByowner;
use App\Models\Repository\getTransfertByref;
use App\Models\Repository\getTransferts;
use App\Models\Repository\getTransfertByowner;
use App\Models\Repository\getBeneficiariesByowner;
use App\Models\TransfertManager\addBeneficiary;
use App\Models\TransfertManager\removeBeneficiary;
use App\Models\TransfertManager\creatAccount;
use App\Models\TransfertManager\creatTransfert;
use Selective\BasePath\BasePathMiddleware;
use Slim\Factory\AppFactory;

require_once __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$app->addBodyParsingMiddleware(); 
$app->addRoutingMiddleware();
$app->add(new BasePathMiddleware($app));
$app->addErrorMiddleware(true, true, true); 

$app->get('/accounts/{id :[0-9]+}', getAccountByid::class . ':Action');

$app->get('/accounts/owner/{id :[0-9]+}', getAccountByowner::class . ':Action');

$app->get('/beneficiaries/{id :[0-9]+}', getBeneficiaryByid::class . ':Action');

$app->get('/beneficiaries/owner/{id :[0-9]+}', getBeneficiariesByowner::class . ':Action');

$app->post('/beneficiaries/label', getLabel::class . ':Action');

$app->get('/countries', getCountries::class . ':Action');

$app->get('/countries/countryCode/{countryName}', getCountrycode::class . ':Action');

$app->get('/countries/{countryCode}', getCurrency::class . ':Action');

$app->get('/countries/owner/{id :[0-9]+}', getCurrencyByowner::class . ':Action');

$app->get('/transferts/{reference}', getTransfertByref::class . ':Action');

$app->get('/transferts', getTransferts::class . ':Action');

$app->post('/beneficiaries', addBeneficiary::class . ':Action');

$app->delete('/beneficiaries/{id :[0-9]+}', removeBeneficiary::class . ':Action');

$app->post('/accounts', creatAccount::class . ':Action');

$app->get('/accounts/balance/{ownerId :[0-9]+}', getBalanceByowner::class . ':Action');

$app->post('/transferts', creatTransfert::class . ':Action');

$app->get('/transferts/owner/{id :[0-9]+}', getTransfertByowner::class . ':Action');


$app->run(); 