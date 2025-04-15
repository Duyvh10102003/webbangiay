<?php

require_once __DIR__ . '/QRCodeController.php';

// Set headers for JSON response
header('Content-Type: application/json');

// Check if it's a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get JSON data from request body
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    
    // Validate required parameters
    if (!isset($data['amount']) || !is_numeric($data['amount'])) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Invalid amount provided'
        ]);
        exit;
    }
    
    // Get payment method (default to bank if not specified)
    $paymentMethod = isset($data['paymentMethod']) ? $data['paymentMethod'] : 'bank';
    
    // Validate payment method
    if (!in_array($paymentMethod, ['bank', 'momo'])) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Invalid payment method'
        ]);
        exit;
    }
    
    // Generate QR code
    $qrCodeController = new QRCodeController();
    $qrCodeImage = $qrCodeController->generatePaymentQRCode($data['amount'], $paymentMethod);
    
    // Return QR code image
    echo json_encode([
        'status' => 'success',
        'qrCode' => $qrCodeImage
    ]);
} else {
    // Method not allowed
    echo json_encode([
        'status' => 'error',
        'message' => 'Method not allowed'
    ]);
} 