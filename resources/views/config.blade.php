
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfigurasi</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
        }

        .checkout-container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        .checkout-container h2 {
            margin: 0 0 20px;
            text-align: center;
        }

        .checkout-container label {
            display: block;
            margin-bottom: 5px;
        }

        .checkout-container select,
        .checkout-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .total-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
        }

        .total-container .total-price {
            font-weight: bold;
        }

        .checkout-container button {
            width: 100%;
            padding: 10px;
            background-color: black;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .checkout-container button:hover {
            background-color: #333;
        }

        .info {
            margin-bottom: 20px;
        }

        .login-link {
            display: flex;
            justify-content: flex-end;
        }

        .login-link a {
            color: blue;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div id="logged-in" class="checkout-container" style="display: none;">
        <h2 id="domain-name">tokotesting.id</h2>
        <form action="/invoice" method="POST">
            @csrf
            <label for="duration">Durasi</label>
            <select id="duration" name="duration" required>
                <option value="1">1 Tahun</option>
                <option value="2">2 Tahun</option>
                <option value="3">3 Tahun</option>
            </select>
            <input type="hidden" name="description" id="description" value="tokotesting.id">
            <div class="total-container" >
                <input type="hidden" name="price" id="price" value="100000">
                <span class="total-label">Total</span>
                <span class="total-price" >Rp 100.000</span>
            </div>
            <div class="info">
                <p>Nama : Agus Joko</p>
                <p>Email : agusjoko@gmail.com</p>
            </div>
            <button>CHECKOUT</button>
        </form>
    </div>

    <div id="not-logged-in" class="checkout-container" style="display: none;">
        <h2 id="domain-name">tokotesting.id</h2>
        <input type="hidden" name="domain" value="tokotesting.id">
        <form action="/register" method="POST">
            @csrf
            <label for="duration">Durasi</label>
            <select id="duration" name="duration" required>
                <option value="1">1 Tahun</option>
                <option value="2">2 Tahun</option>
                <option value="3">3 Tahun</option>
            </select>
            <input type="hidden" name="description" id="description" value="tokotesting.id">
            <div class="total-container">
                <input type="hidden" name="price" id="price" value="100000">
                <span class="total-label">Total</span>
                <span class="total-price" name="price" id="price">Rp 100.000</span>
            </div>
            <label for="name">Nama :</label>
            <input type="text" id="name" name="name" placeholder="Enter your name" required>
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
            <label for="password">Password :</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
            <div class="login-link">
                <span>atau login <a href="/login">disini</a></span>
            </div>
            <button type="submit">CHECKOUT</button>
        </form>
    </div>

    <script>
        const isLoggedIn = @json(session('isLoggedIn'));
        const name = @json(session('name'));
        const email = @json(session('email'));

        if (isLoggedIn) {
            document.getElementById('logged-in').style.display = 'block';
            document.querySelector('.info').innerHTML = `
                <p>Nama : ${name}</p>
                <p>Email : ${email}</p>
                <input type="hidden" name="name" id="name" value="${name}">
                <input type="hidden" name="email" id="email" value="${email}">
            `;
        } else {
            document.getElementById('not-logged-in').style.display = 'block';
        }

        document.getElementById('domain-name').innerText = decodeURIComponent(window.location.search.split('=')[1]);
        document.getElementById('description').value = decodeURIComponent(window.location.search.split('=')[1]);
        //change total price
        document.getElementById('duration').addEventListener('change', function() {
            const duration = document.getElementById('duration').value;
            let price = 100000;
            if (duration === '2') {
                price = 200000;
            } else if (duration === '3') {
                price = 300000;
            }
            document.querySelector('.total-price').innerText = `Rp ${price}`;
            document.getElementById('price').value = price;
        });
</script>
</body>
</html>