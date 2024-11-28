[contributors-shield]: https://img.shields.io/github/contributors/jobmetric/voucher-usd.svg?style=for-the-badge
[contributors-url]: https://github.com/jobmetric/voucher-usd/graphs/contributors
[forks-shield]: https://img.shields.io/github/forks/jobmetric/voucher-usd.svg?style=for-the-badge&label=Fork
[forks-url]: https://github.com/jobmetric/voucher-usd/network/members
[stars-shield]: https://img.shields.io/github/stars/jobmetric/voucher-usd.svg?style=for-the-badge
[stars-url]: https://github.com/jobmetric/voucher-usd/stargazers
[license-shield]: https://img.shields.io/github/license/jobmetric/voucher-usd.svg?style=for-the-badge
[license-url]: https://github.com/jobmetric/voucher-usd/blob/master/LICENCE.md
[linkedin-shield]: https://img.shields.io/badge/-LinkedIn-blue.svg?style=for-the-badge&logo=linkedin&colorB=555
[linkedin-url]: https://linkedin.com/in/majidmohammadian

[![Contributors][contributors-shield]][contributors-url]
[![Forks][forks-shield]][forks-url]
[![Stargazers][stars-shield]][stars-url]
[![MIT License][license-shield]][license-url]
[![LinkedIn][linkedin-shield]][linkedin-url]

# Voucher USD

A Laravel package for managing `voucher USD`, including authentication, balance checking, voucher creation, and retrieval.

## Install via composer

Run the following command to pull in the latest version:

```bash
composer require jobmetric/voucher-usd
```

## Documentation

Add the required environment variables in your .env file:

```bash
VOUCHER_USD_CLIENT_ID=your_client_id
VOUCHER_USD_CLIENT_SECRET=your_client_secret
VOUCHER_USD_AUTH_URL=https://example.com
VOUCHER_USD_BASE_URL=https://example.com
```

### Usage

#### Authentication

To authenticate and retrieve an access token:

```php
use JobMetric\VoucherUsd\Facades\VoucherUsd;

$response = VoucherUsd::auth();

if ($response['ok']) {
    echo "Access Token: " . $response['data']['token'];
} else {
    echo "Error: " . $response['message'];
}
```

#### Check Balance

To check the account balance:

```php
$response = VoucherUsd::balance();

if ($response['ok']) {
    echo "Available Balance: " . $response['data']['available'];
    echo "Actual Balance: " . $response['data']['actual'];
} else {
    echo "Error: " . $response['message'];
}
```

#### Create a Voucher

To create a new voucher:
    
```php
$data = [
    'amount' => 100, // Amount in USD
    'note' => 'Test voucher creation',
];

$response = VoucherUsd::createVoucher($data);

if ($response['ok']) {
    echo "Voucher Code: " . $response['data']['voucher_code'];
} else {
    echo "Error: " . $response['message'];
}
```

#### Retrieve All Vouchers

To retrieve a list of all vouchers:

```php
$response = VoucherUsd::getVouchers();

if ($response['ok']) {
    echo "Vouchers: " . print_r($response['data']['vouchers'], true);
    echo "Report: " . print_r($response['data']['report'], true);
} else {
    echo "Error: " . $response['message'];
}
```

#### Retrieve a Single Voucher

To retrieve details of a specific voucher by its code:

```php
$voucherCode = 'ABC123';

$response = VoucherUsd::showVoucher($voucherCode);

if ($response['ok']) {
    echo "Voucher Details: " . print_r($response['data'], true);
} else {
    echo "Error: " . $response['message'];
}
```

#### Events

This package contains several events for which you can write a listener as follows

| Event                      | Description                                                        |
|----------------------------|--------------------------------------------------------------------|
| `CreateVoucherUsdEvent`    | Triggered after a voucher is successfully created.                 |
| `InsufficientBalanceEvent` | Triggered when voucher creation fails due to insufficient balance. |

## Contributing

Thank you for considering contributing to the Laravel Ban Ip! The contribution guide can be found in the [CONTRIBUTING.md](https://github.com/jobmetric/voucher-usd/blob/master/CONTRIBUTING.md).

## License

The MIT License (MIT). Please see [License File](https://github.com/jobmetric/voucher-usd/blob/master/LICENCE.md) for more information.

