<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

class QRCodeController {
    
    /**
     * Generate a QR code for payment
     * 
     * @param float $amount The payment amount
     * @param string $paymentMethod The payment method (bank or momo)
     * @return string The QR code image as base64
     */
    public function generatePaymentQRCode($amount, $paymentMethod = 'bank') {
        // Format amount with commas for thousands
        $formattedAmount = number_format($amount, 0, ',', '.');
        
        // Create payment data based on method
        $paymentData = '';
        
        if ($paymentMethod === 'bank') {
            // Bank transfer data
            $bankName = 'BIDV';
            $accountNumber = '72910000261525';
            $accountName = 'HO NHAT QUANG';
            $paymentData = "Ngân hàng: $bankName\nSố tài khoản: $accountNumber\nChủ tài khoản: $accountName\nSố tiền: $formattedAmount VND";
        } else if ($paymentMethod === 'momo') {
            // Momo payment data
            $momoNumber = '0372848544';
            $paymentData = "Momo: $momoNumber\nSố tiền: $formattedAmount VND";
        }
        
        // QR Code options
        $options = new QROptions([
            'version'    => 5,
            'outputType' => 'png',
            'eccLevel'   => 'L',
            'scale'      => 5,
            'addQuietzone' => true,
            'quietzoneSize' => 2,
            'imageBase64' => true,
            'imageType' => 'image/png',
        ]);
        
        // Generate QR code
        $qrcode = new QRCode($options);
        $qrImage = $qrcode->render($paymentData);
        
        return $qrImage;
    }
} 