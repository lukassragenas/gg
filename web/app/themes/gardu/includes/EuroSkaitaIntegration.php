<?php

function generateOrderXml($order_id)
{
    $order = wc_get_order($order_id);
    $orderItems = $order->get_items();

    $xml = new DOMDocument('1.0', 'UTF-8');
    $xml->formatOutput = true;

    $root = $xml->createElement('Document');
    $xml->appendChild($root);

    $documentHeader = $xml->createElement('Document-Header');
    $dataHeader = $xml->createElement('Data-Header');
    $dataParties = $xml->createElement('Data-Parties');
    $dataLines = $xml->createElement('Data-Lines');
    $dataSummary = $xml->createElement('Data-Summary');
    $root->appendChild($documentHeader);
    $root->appendChild($dataHeader);
    $root->appendChild($dataParties);
    $root->appendChild($dataLines);
    $root->appendChild($dataSummary);

    $documentHeader->appendChild($xml->createElement('DocumentType', 'Kliento užs.'));
    $documentHeader->appendChild($xml->createElement('DateCreated', date('Y.m.d')));

    $dataHeader->appendChild($xml->createElement('UniqId', date('Ymd') . '-' . uniqid()));
    $dataHeader->appendChild($xml->createElement('DocDate', $order->get_date_created()->date('Y.m.d')));
    $dataHeader->appendChild($xml->createElement('InvoiceCurrency', 'EUR'));
    $dataHeader->appendChild($xml->createElement('TaxationMethod', '12'));
    $dataHeader->appendChild($xml->createElement('VATCode', 'PVM1'));
    $dataHeader->appendChild($xml->createElement('WarehouseCode', '3'));
    $dataHeader->appendChild($xml->createElement('DocLabel', $order_id));
    $dataHeader->appendChild($xml->createElement('DocNumber', $order_id . '-' . date('Ymd')));

    if (!empty(get_post_meta($order_id, '_billing_wooccm11', true))) {
        $companyCode = get_post_meta($order_id, '_billing_wooccm13', true);
        $billingCompany = get_post_meta($order_id, '_billing_wooccm12', true);
        $companyTax = get_post_meta($order_id, '_billing_wooccm14', true);
    } else {
        $billingCompany = null;
        $companyCode = null;
        $companyTax = null;
    }

    $buyer = $xml->createElement('Buyer');
    $dataParties->appendChild($buyer);
    $billingCompany ? $buyer->appendChild($xml->createElement('Code', '')) : $buyer->appendChild($xml->createElement('Code', 'eshop'));
    $companyTax ? $buyer->appendChild($xml->createElement('TaxID', $companyTax)) : null;
    $companyCode ? $buyer->appendChild($xml->createElement('RegCode', $companyCode)) : null;
    $billingCompany ? $buyer->appendChild($xml->createElement('Name', $billingCompany)) : null;

    // $buyer->appendChild($xml->createElement('StreetAndNumber', $order->get_billing_address_1()));
    // $buyer->appendChild($xml->createElement('City', $order->get_billing_city()));
    // $buyer->appendChild($xml->createElement('ZIP', $order->get_billing_postcode()));
    // $buyer->appendChild($xml->createElement('Phone1', $order->get_billing_phone()));

    $buyer->appendChild($xml->createElement('Note1', $order->get_billing_first_name() . ' ' . $order->get_billing_last_name() . ' ' . $order->get_billing_address_1() . ', ' . $order->get_billing_city() . ', ' . $order->get_billing_postcode() . ', tel: ' . $order->get_billing_phone()));

    $line = $xml->createElement('Line');
    $dataLines->appendChild($line);

    foreach ($orderItems as $item) {
        $product = wc_get_product($item->get_product_id());

        $lineItem = $xml->createElement('Line-Item');
        $line->appendChild($lineItem);
        $lineItem->appendChild($xml->createElement('LineId', uniqid()));
        $lineItem->appendChild($xml->createElement('ItemCode', $product->get_sku()));
        $lineItem->appendChild($xml->createElement('Quantity', $item->get_quantity()));
        $lineItem->appendChild($xml->createElement('UnitPriceVAT', $product->get_price()));
        $lineItem->appendChild($xml->createElement('UnitOfMeasure', 'vnt'));
        $lineItem->appendChild($xml->createElement('VATCode', 'PVM1'));
    }

    $dataSummary->appendChild($xml->createElement('TotalNetAmount', number_format($order->get_subtotal(), 2)));
    $dataSummary->appendChild($xml->createElement('TotalGrossAmount', $order->get_total()));

    $filename = 'Order_' . $order_id . '_' . date('Ymd') . '.xml';

    $xml->save(WP_CONTENT_DIR . '/uploads/EuroSkaita/' . $filename);

    exportToFtp($filename);
}

if (!wp_next_scheduled('delete_xml_files')) {
    wp_schedule_event(time(), 'daily', 'delete_xml_files');
}

function deleteFiles()
{
    $files = glob(WP_CONTENT_DIR . '/uploads/EuroSkaita/*.xml');
    $now = time();

    foreach ($files as $file) {
        if (is_file($file)) {
            if ($now - filemtime($file) >= 60 * 60 * 24 * 2) { // 2 days
                unlink($file);
            }
        }
    }
}

function exportToFtp($filename)
{
    $host = FTP_HOST;
    $user = FTP_USERNAME;
    $password = FTP_PASSWORD;

    $conn = ftp_connect($host) or die("Cannot initiate connection to host");
    ftp_login($conn, $user, $password) or die("Cannot login");
    ftp_pasv($conn, true);

    ftp_put($conn, "/import/" . $filename, WP_CONTENT_DIR . '/uploads/EuroSkaita/' . $filename, FTP_BINARY);

    ftp_close($conn);
}