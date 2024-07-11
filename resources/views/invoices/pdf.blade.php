<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails de la facture</title>
    <style>
        /* Styles CSS pour le PDF */
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .invoice-details {
            margin-bottom: 20px;
        }
        .invoice-details h2 {
            margin-bottom: 5px;
        }
        .invoice-details p {
            margin: 5px 0;
        }
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .invoice-table th, .invoice-table td {
            border: 1px solid #000;
            padding: 8px;
        }
        .invoice-table th {
            background-color: #f2f2f2;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="invoice-details">
        <h2>Facture #{{ $invoice->invoice_num }}</h2>
        <p>Date de facture: {{ $invoice->invoice_date }}</p>
        <p>Date d'échéance: {{ $invoice->due_date }}</p>
        <p>Section: {{ $invoice->section->name }}</p>
        <p>Produit: {{ $invoice->product }}</p>
        <p>Montant collecté: {{ $invoice->Amount_collection }}</p>
        <p>Montant de commission: {{ $invoice->Amount_Commission }}</p>
        <p>Remise: {{ $invoice->discount }}</p>
        <p>Pourcentage TVA: {{ $invoice->rate_vat }}</p>
        <p>Montant de la TVA: {{ $invoice->value_vat }}</p>
        <p>Total TTC: {{ $invoice->total }}</p>
        <p>Notes: {{ $invoice->note }}</p>
    </div>

    <table class="invoice-table">
        <thead>
            <tr>
                <th>Numéro de facture</th>
                <th>Date de facture</th>
                <th>Date d'échéance</th>
                <th>Section</th>
                <th>Produit</th>
                <th>Montant collecté</th>
                <th>Montant de commission</th>
                <th>Remise</th>
                <th>Pourcentage TVA</th>
                <th>Montant de la TVA</th>
                <th>Total TTC</th>
                <th>Notes</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $invoice->invoice_num }}</td>
                <td>{{ $invoice->invoice_date }}</td>
                <td>{{ $invoice->due_date }}</td>
                <td>{{ $invoice->section->name }}</td>
                <td>{{ $invoice->product }}</td>
                <td>{{ $invoice->Amount_collection }}</td>
                <td>{{ $invoice->Amount_Commission }}</td>
                <td>{{ $invoice->discount }}</td>
                <td>{{ $invoice->rate_vat }}</td>
                <td>{{ $invoice->value_vat }}</td>
                <td>{{ $invoice->total }}</td>
                <td>{{ $invoice->note }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
