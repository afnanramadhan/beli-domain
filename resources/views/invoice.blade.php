<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }
        .invoice-container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        .invoice-header {
            text-align: right;
        }
        .invoice-header h2 {
            margin: 0;
            color: red;
        }
        .invoice-details {
            margin-top: 20px;
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
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .invoice-table th {
            background-color: #f4f4f4;
        }
        .invoice-footer {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="invoice-header">
            <p>No Invoice : #12</p>
            <h2>UNPAID</h2>
        </div>
        <div class="invoice-details">
            <p>Agus Joko</p>
            <p>agusjoko@gmail.com</p>
        </div>
        <table class="invoice-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Deskripsi</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Pembelian domain tokotesting.id</td>
                    <td>Rp 100.000</td>
                </tr>
            </tbody>
        </table>
        <div class="invoice-footer">
            <p>Total : Rp 100.000</p>
            <p>Silahkan bayar di no rekening berikut ini :</p>
            <p>663721667321</p>
        </div>
    </div>
</body>

<script>
    const isLoggedIn = @json(session('isLoggedIn'));
    const name = @json(session('name'));
    const email = @json(session('email'));

    document.querySelector('.invoice-details').innerHTML = `
        <p>${name}</p>
        <p>${email}</p>
    `;

    //fetch data from backend
    fetch('/invoiceData')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log(data);
            const invoiceTable = document.querySelector('.invoice-table tbody');
            invoiceTable.innerHTML = `
                <tr>
                    <td>1</td>
                    <td>Pembelian domain ${data.description}</td>
                    <td>Rp ${data.price}</td>
                </tr>
            `;
            document.querySelector('.invoice-footer').innerHTML = `
                <p>Total : Rp ${data.price}</p>
                <p>Silahkan bayar di no rekening berikut ini :</p>
                <p>663721667321</p>
            `;
        })
        .catch(error => {
            console.error('There has been a problem with your fetch operation:', error);
        });


</script>

</html>