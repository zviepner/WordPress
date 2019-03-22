<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit113e0ee5cfc6d3a57108fc05f54d3c2f
{
    public static $files = array (
        'a0063ca44df31a81bb0634cab48f040a' => __DIR__ . '/..' . '/ebanx/benjamin/main.php',
    );

    public static $prefixLengthsPsr4 = array (
        'E' => 
        array (
            'Ebanx\\Benjamin\\' => 15,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Ebanx\\Benjamin\\' => 
        array (
            0 => __DIR__ . '/..' . '/ebanx/benjamin/src',
        ),
    );

    public static $classMap = array (
        'Ebanx\\Benjamin\\Facade' => __DIR__ . '/..' . '/ebanx/benjamin/src/Facade.php',
        'Ebanx\\Benjamin\\Models\\Address' => __DIR__ . '/..' . '/ebanx/benjamin/src/Models/Address.php',
        'Ebanx\\Benjamin\\Models\\Bank' => __DIR__ . '/..' . '/ebanx/benjamin/src/Models/Bank.php',
        'Ebanx\\Benjamin\\Models\\BaseModel' => __DIR__ . '/..' . '/ebanx/benjamin/src/Models/BaseModel.php',
        'Ebanx\\Benjamin\\Models\\Card' => __DIR__ . '/..' . '/ebanx/benjamin/src/Models/Card.php',
        'Ebanx\\Benjamin\\Models\\Configs\\AddableConfig' => __DIR__ . '/..' . '/ebanx/benjamin/src/Models/Configs/AddableConfig.php',
        'Ebanx\\Benjamin\\Models\\Configs\\Config' => __DIR__ . '/..' . '/ebanx/benjamin/src/Models/Configs/Config.php',
        'Ebanx\\Benjamin\\Models\\Configs\\CreditCardConfig' => __DIR__ . '/..' . '/ebanx/benjamin/src/Models/Configs/CreditCardConfig.php',
        'Ebanx\\Benjamin\\Models\\Configs\\CreditCardInterestRateConfig' => __DIR__ . '/..' . '/ebanx/benjamin/src/Models/Configs/CreditCardInterestRateConfig.php',
        'Ebanx\\Benjamin\\Models\\Country' => __DIR__ . '/..' . '/ebanx/benjamin/src/Models/Country.php',
        'Ebanx\\Benjamin\\Models\\Currency' => __DIR__ . '/..' . '/ebanx/benjamin/src/Models/Currency.php',
        'Ebanx\\Benjamin\\Models\\Item' => __DIR__ . '/..' . '/ebanx/benjamin/src/Models/Item.php',
        'Ebanx\\Benjamin\\Models\\Notification' => __DIR__ . '/..' . '/ebanx/benjamin/src/Models/Notification.php',
        'Ebanx\\Benjamin\\Models\\Payment' => __DIR__ . '/..' . '/ebanx/benjamin/src/Models/Payment.php',
        'Ebanx\\Benjamin\\Models\\Person' => __DIR__ . '/..' . '/ebanx/benjamin/src/Models/Person.php',
        'Ebanx\\Benjamin\\Models\\Request' => __DIR__ . '/..' . '/ebanx/benjamin/src/Models/Request.php',
        'Ebanx\\Benjamin\\Models\\Responses\\ErrorResponse' => __DIR__ . '/..' . '/ebanx/benjamin/src/Models/Responses/ErrorResponse.php',
        'Ebanx\\Benjamin\\Models\\Responses\\PaymentResponse' => __DIR__ . '/..' . '/ebanx/benjamin/src/Models/Responses/PaymentResponse.php',
        'Ebanx\\Benjamin\\Models\\Responses\\PaymentTerm' => __DIR__ . '/..' . '/ebanx/benjamin/src/Models/Responses/PaymentTerm.php',
        'Ebanx\\Benjamin\\Models\\Responses\\Response' => __DIR__ . '/..' . '/ebanx/benjamin/src/Models/Responses/Response.php',
        'Ebanx\\Benjamin\\Models\\SubAccount' => __DIR__ . '/..' . '/ebanx/benjamin/src/Models/SubAccount.php',
        'Ebanx\\Benjamin\\Services\\Adapters\\BankTransferPaymentAdapter' => __DIR__ . '/..' . '/ebanx/benjamin/src/Services/Adapters/BankTransferPaymentAdapter.php',
        'Ebanx\\Benjamin\\Services\\Adapters\\BaseAdapter' => __DIR__ . '/..' . '/ebanx/benjamin/src/Services/Adapters/BaseAdapter.php',
        'Ebanx\\Benjamin\\Services\\Adapters\\BoletoPaymentAdapter' => __DIR__ . '/..' . '/ebanx/benjamin/src/Services/Adapters/BoletoPaymentAdapter.php',
        'Ebanx\\Benjamin\\Services\\Adapters\\BrazilPaymentAdapter' => __DIR__ . '/..' . '/ebanx/benjamin/src/Services/Adapters/BrazilPaymentAdapter.php',
        'Ebanx\\Benjamin\\Services\\Adapters\\CancelAdapter' => __DIR__ . '/..' . '/ebanx/benjamin/src/Services/Adapters/CancelAdapter.php',
        'Ebanx\\Benjamin\\Services\\Adapters\\CaptureAdapter' => __DIR__ . '/..' . '/ebanx/benjamin/src/Services/Adapters/CaptureAdapter.php',
        'Ebanx\\Benjamin\\Services\\Adapters\\CardPaymentAdapter' => __DIR__ . '/..' . '/ebanx/benjamin/src/Services/Adapters/CardPaymentAdapter.php',
        'Ebanx\\Benjamin\\Services\\Adapters\\CashPaymentAdapter' => __DIR__ . '/..' . '/ebanx/benjamin/src/Services/Adapters/CashPaymentAdapter.php',
        'Ebanx\\Benjamin\\Services\\Adapters\\EftPaymentAdapter' => __DIR__ . '/..' . '/ebanx/benjamin/src/Services/Adapters/EftPaymentAdapter.php',
        'Ebanx\\Benjamin\\Services\\Adapters\\ExchangeAdapter' => __DIR__ . '/..' . '/ebanx/benjamin/src/Services/Adapters/ExchangeAdapter.php',
        'Ebanx\\Benjamin\\Services\\Adapters\\PaymentAdapter' => __DIR__ . '/..' . '/ebanx/benjamin/src/Services/Adapters/PaymentAdapter.php',
        'Ebanx\\Benjamin\\Services\\Adapters\\PaymentInfoAdapter' => __DIR__ . '/..' . '/ebanx/benjamin/src/Services/Adapters/PaymentInfoAdapter.php',
        'Ebanx\\Benjamin\\Services\\Adapters\\RefundAdapter' => __DIR__ . '/..' . '/ebanx/benjamin/src/Services/Adapters/RefundAdapter.php',
        'Ebanx\\Benjamin\\Services\\Adapters\\RequestAdapter' => __DIR__ . '/..' . '/ebanx/benjamin/src/Services/Adapters/RequestAdapter.php',
        'Ebanx\\Benjamin\\Services\\Adapters\\SafetyPayPaymentAdapter' => __DIR__ . '/..' . '/ebanx/benjamin/src/Services/Adapters/SafetyPayPaymentAdapter.php',
        'Ebanx\\Benjamin\\Services\\Adapters\\TefPaymentAdapter' => __DIR__ . '/..' . '/ebanx/benjamin/src/Services/Adapters/TefPaymentAdapter.php',
        'Ebanx\\Benjamin\\Services\\CancelPayment' => __DIR__ . '/..' . '/ebanx/benjamin/src/Services/CancelPayment.php',
        'Ebanx\\Benjamin\\Services\\Exchange' => __DIR__ . '/..' . '/ebanx/benjamin/src/Services/Exchange.php',
        'Ebanx\\Benjamin\\Services\\Gateways\\Baloto' => __DIR__ . '/..' . '/ebanx/benjamin/src/Services/Gateways/Baloto.php',
        'Ebanx\\Benjamin\\Services\\Gateways\\BankTransfer' => __DIR__ . '/..' . '/ebanx/benjamin/src/Services/Gateways/BankTransfer.php',
        'Ebanx\\Benjamin\\Services\\Gateways\\BaseGateway' => __DIR__ . '/..' . '/ebanx/benjamin/src/Services/Gateways/BaseGateway.php',
        'Ebanx\\Benjamin\\Services\\Gateways\\Boleto' => __DIR__ . '/..' . '/ebanx/benjamin/src/Services/Gateways/Boleto.php',
        'Ebanx\\Benjamin\\Services\\Gateways\\CreditCard' => __DIR__ . '/..' . '/ebanx/benjamin/src/Services/Gateways/CreditCard.php',
        'Ebanx\\Benjamin\\Services\\Gateways\\DebitCard' => __DIR__ . '/..' . '/ebanx/benjamin/src/Services/Gateways/DebitCard.php',
        'Ebanx\\Benjamin\\Services\\Gateways\\DirectGateway' => __DIR__ . '/..' . '/ebanx/benjamin/src/Services/Gateways/DirectGateway.php',
        'Ebanx\\Benjamin\\Services\\Gateways\\EbanxAccount' => __DIR__ . '/..' . '/ebanx/benjamin/src/Services/Gateways/EbanxAccount.php',
        'Ebanx\\Benjamin\\Services\\Gateways\\Eft' => __DIR__ . '/..' . '/ebanx/benjamin/src/Services/Gateways/Eft.php',
        'Ebanx\\Benjamin\\Services\\Gateways\\Hosted' => __DIR__ . '/..' . '/ebanx/benjamin/src/Services/Gateways/Hosted.php',
        'Ebanx\\Benjamin\\Services\\Gateways\\Multicaja' => __DIR__ . '/..' . '/ebanx/benjamin/src/Services/Gateways/Multicaja.php',
        'Ebanx\\Benjamin\\Services\\Gateways\\OtrosCupones' => __DIR__ . '/..' . '/ebanx/benjamin/src/Services/Gateways/OtrosCupones.php',
        'Ebanx\\Benjamin\\Services\\Gateways\\Oxxo' => __DIR__ . '/..' . '/ebanx/benjamin/src/Services/Gateways/Oxxo.php',
        'Ebanx\\Benjamin\\Services\\Gateways\\PagoEfectivo' => __DIR__ . '/..' . '/ebanx/benjamin/src/Services/Gateways/PagoEfectivo.php',
        'Ebanx\\Benjamin\\Services\\Gateways\\Pagofacil' => __DIR__ . '/..' . '/ebanx/benjamin/src/Services/Gateways/Pagofacil.php',
        'Ebanx\\Benjamin\\Services\\Gateways\\Rapipago' => __DIR__ . '/..' . '/ebanx/benjamin/src/Services/Gateways/Rapipago.php',
        'Ebanx\\Benjamin\\Services\\Gateways\\SafetyPay' => __DIR__ . '/..' . '/ebanx/benjamin/src/Services/Gateways/SafetyPay.php',
        'Ebanx\\Benjamin\\Services\\Gateways\\SafetyPayCash' => __DIR__ . '/..' . '/ebanx/benjamin/src/Services/Gateways/SafetyPayCash.php',
        'Ebanx\\Benjamin\\Services\\Gateways\\SafetyPayOnline' => __DIR__ . '/..' . '/ebanx/benjamin/src/Services/Gateways/SafetyPayOnline.php',
        'Ebanx\\Benjamin\\Services\\Gateways\\Sencillito' => __DIR__ . '/..' . '/ebanx/benjamin/src/Services/Gateways/Sencillito.php',
        'Ebanx\\Benjamin\\Services\\Gateways\\Servipag' => __DIR__ . '/..' . '/ebanx/benjamin/src/Services/Gateways/Servipag.php',
        'Ebanx\\Benjamin\\Services\\Gateways\\Spei' => __DIR__ . '/..' . '/ebanx/benjamin/src/Services/Gateways/Spei.php',
        'Ebanx\\Benjamin\\Services\\Gateways\\Tef' => __DIR__ . '/..' . '/ebanx/benjamin/src/Services/Gateways/Tef.php',
        'Ebanx\\Benjamin\\Services\\Gateways\\Webpay' => __DIR__ . '/..' . '/ebanx/benjamin/src/Services/Gateways/Webpay.php',
        'Ebanx\\Benjamin\\Services\\Http\\Client' => __DIR__ . '/..' . '/ebanx/benjamin/src/Services/Http/Client.php',
        'Ebanx\\Benjamin\\Services\\Http\\Engine' => __DIR__ . '/..' . '/ebanx/benjamin/src/Services/Http/Engine.php',
        'Ebanx\\Benjamin\\Services\\Http\\HttpService' => __DIR__ . '/..' . '/ebanx/benjamin/src/Services/Http/HttpService.php',
        'Ebanx\\Benjamin\\Services\\PaymentInfo' => __DIR__ . '/..' . '/ebanx/benjamin/src/Services/PaymentInfo.php',
        'Ebanx\\Benjamin\\Services\\Refund' => __DIR__ . '/..' . '/ebanx/benjamin/src/Services/Refund.php',
        'Ebanx\\Benjamin\\Services\\Traits\\Printable' => __DIR__ . '/..' . '/ebanx/benjamin/src/Services/Traits/Printable.php',
        'Ebanx\\Benjamin\\Services\\Validators\\BaseValidator' => __DIR__ . '/..' . '/ebanx/benjamin/src/Services/Validators/BaseValidator.php',
        'Ebanx\\Benjamin\\Services\\Validators\\ValidationHelper' => __DIR__ . '/..' . '/ebanx/benjamin/src/Services/Validators/ValidationHelper.php',
        'Ebanx\\Benjamin\\Util\\Http' => __DIR__ . '/..' . '/ebanx/benjamin/src/Util/Http.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit113e0ee5cfc6d3a57108fc05f54d3c2f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit113e0ee5cfc6d3a57108fc05f54d3c2f::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit113e0ee5cfc6d3a57108fc05f54d3c2f::$classMap;

        }, null, ClassLoader::class);
    }
}