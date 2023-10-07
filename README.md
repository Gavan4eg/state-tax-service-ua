# Державна податкова служба API 

`Отримання чеків/касс/З-звіт/Розгорнутий чек`
#### Laravel 6 або вище, php7.0 або вище

## Встановлення

```
composer require gavan4eg/statetaxserviceukraine
```
#### Опублікувати config (statetax.php)

```
php artisan vendor:publish
```

## Приклади використання


`# Запит змін за період (період повинен будит в межах місяця)`
```php

$numberPRRO = '123456789';
$dateFrom = Carbon::now()->subDays(5);
$dateTo = Carbon::now();

$taxservice = new PPOService();
$result = $taxservice->PPOSingShifts($numberPRRO, $dateFrom, $dateTo);

dd($result);
```
`# Успішна відповідь`
```
   "ShiftId" => 123456
   "OpenShiftFiscalNum" => "123456789"
   "CloseShiftFiscalNum" => "123456789"
   "Testing" => false
   "Opened" => "2023-10-05T08:07:56.231159"
   "OpenName" => "Печатка №1 для РРО Петров Петрович"
   "OpenSubjectKeyId" => ""
   "Closed" => "2023-10-05T15:32:17"
   "CloseName" => "Печатка №1 для РРО Петров Петрович"
   "CloseSubjectKeyId" => ""
```

`# Запит змін за період (період повинен будит в межах місяця)`
```php

$numberPRRO = '123456789';
$ShiftId = '123456' // Можно отримати с запатиу PPOSingShifts
$OpenShiftFiscalNum = '123456' // Можно отримати с запатиу PPOSingShifts

$taxservice = new PPOService();
$result = $taxservice->PPOGetCheckList($numberPRRO,$ShiftId,$OpenShiftFiscalNum);
dd($result);
```
`# Приклад успішного запиту`
```
   "NumFiscal" => "123456"
   "NumLocal" => 12345
   "DocDateTime" => "2023-10-05T15:53:49"
   "DocClass" => "Check" // ZRep
   "CheckDocType" => "SaleGoods"
   "CheckDocSubType" => "ServiceIssue"
   "Revoked" => false
   "Storned" => false
```

`# Запит З-Віту розгорнутий`
```php

$numberPRRO = '123456789';
$nubmerFiscal = '123'

$taxservice = new PPOService();
$result = $taxservice->PPOGetCheckList($numberPRRO,$nubmerFiscal);
dd($result);
```
`# Запит ЧЕК розгорнутий`
```php

$numberPRRO = '123456789';
$nubmerFiscal = '123'

$taxservice = new PPOService();
$result = $taxservice->PPOSignCheckSum($numberPRRO,$nubmerFiscal);
dd($result);
```


