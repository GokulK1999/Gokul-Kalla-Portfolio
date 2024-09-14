@extends('lay.app')

@section('body')
    <style>
        /* Additional CSS for receipt styling */
        #receiptDetails {
            background-color: #f9f9f9;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 0 auto;
            font-family: Arial, sans-serif;
            text-align: center; /* Center align all content */
        }

        .receipt-label {
            font-weight: bold;
            color: #333;
            font-size: 1.1em;
            margin-bottom: 5px;
            display: block;
            text-align: left; /* Align label text to the left */
            padding: 5px;
        }

        .receipt-input {
            border: none;
            background-color: transparent;
            margin-bottom: 20px;
            width: 100%;
            padding: 10px;
            font-size: 1em;
            border-bottom: 1px solid #ddd;
            color: #555;
            border-radius: 5px;
            text-align: left; /* Align input text to the left */
        }

        .receipt-textarea {
            border: 1px solid #ddd;
            background-color: #fff;
            margin-bottom: 20px;
            width: 100%;
            padding: 10px;
            font-size: 1em;
            color: #555;
            border-radius: 5px;
            resize: none;
            text-align: left; /* Align textarea text to the left */
        }

        #printButton {
            display: block;
            margin: 20px auto 0;
            padding: 10px 20px;
            font-size: 1em;
            background-color: #3498db;
            border: none;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        #printButton:hover {
            background-color: #2980b9;
        }

        .company-info {
            margin-bottom: 30px;
            text-align: center;
        }

        .company-info h2 {
            margin-bottom: 10px;
            font-size: 1.8em;
            color: #333;
        }

        .company-info p {
            margin: 0;
            color: #555;
            font-size: 1em;
            line-height: 1.5;
        }

        hr {
            border: none;
            height: 1px;
            background-color: #ddd;
            margin: 20px 0;
        }

        /* Additional CSS for print styles */
        @media print {
            body {
                font-family: Arial, sans-serif;
                font-size: 12px;
            }

            .hide-on-print {
                display: none;
            }

            .receipt-label {
                font-weight: bold;
            }

            .company-logo {
                max-width: 100px;
                margin-bottom: 20px;
            }

            .header {
                text-align: center;
                margin-bottom: 20px;
            }

            .header h1 {
                margin: 0;
            }

            .footer {
                position: fixed;
                bottom: 20px;
                left: 0;
                right: 0;
                text-align: center;
            }
        }
    </style>

    <!-- Company Information inside the receipt -->
    <div class="company-info">
       
        <h1>Food catering Management Service</h1>
        <h5>Swinburne University of Technology Sarawak Campus Jalan Simpang Tiga 93350 Kuching, Sarawak, Malaysia </h5>
        <h5>Phone: +123 456 7890</h5>
        <h5>Email: info@example.com</h5>
    </div>

    <div class="header hide-on-print" style="text-align: center;">
    <div style="background-color: #007bff; padding: 10px; border-radius: 5px;">
        <h1 class="mb-0" style="color: white;">Receipt Details</h1>
    </div>
    <hr />
</div>
    <!-- Receipt Details -->
    <div id="receiptDetails">
        <div class="mb-3">
            <label class="receipt-label">Name</label>
            <input type="text" name="name" class="form-control receipt-input" value="{{ $receipt->name }}" readonly>
        </div>
        <div class="mb-3">
            <label class="receipt-label">Item</label>
            <input type="text" name="item" class="form-control receipt-input" value="{{ $receipt->item }}" readonly>
        </div>
        <div class="mb-3">
            <label class="receipt-label">Total Paid</label>
            <input type="text" name="totalPaid" class="form-control receipt-input" value="{{ $receipt->totalPaid }}" readonly>
        </div>
        <div class="mb-3">
            <label class="receipt-label">Description</label>
            <textarea class="form-control receipt-textarea" name="description" readonly>{{ $receipt->description }}</textarea>
        </div>
        <div class="mb-3">
            <label class="receipt-label">Paid</label>
            <input type="text" name="paid" class="form-control receipt-input" value="{{ $receipt->paid ? 'Yes' : 'No' }}" readonly>
        </div>
        <div class="row">
            <div class="col">
                <label class="receipt-label">Created At</label>
                <input type="text" name="created_at" class="form-control receipt-input" value="{{ $receipt->created_at }}" readonly>
            </div>
            <div class="col">
                <label class="receipt-label">Updated At</label>
                <input type="text" name="updated_at" class="form-control receipt-input" value="{{ $receipt->updated_at }}" readonly>
            </div>
        </div>
    </div>

    <div class="footer hide-on-print">
        Printed on: {{ date('Y-m-d H:i:s') }}
    </div>

    <!-- Print button -->
    <button id="printButton" class="hide-on-print">Print Receipt</button>

    <!-- Include html2pdf library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>

    <script>
        document.getElementById('printButton').addEventListener('click', function() {
            // Get the receipt details section
            const receiptDetails = document.getElementById('receiptDetails');

            // Use html2pdf to convert HTML to PDF
            html2pdf().from(receiptDetails).save();
        });
    </script>
@endsection