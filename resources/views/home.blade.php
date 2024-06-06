<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        .search-container {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            max-width: 400px;
            margin: auto;
        }

        .search-input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-right: 10px;
        }

        .search-button {
            padding: 10px 20px;
            background-color: black;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .search-button:hover {
            background-color: #333;
        }

        .data-container {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            max-width: 400px;
            margin: auto;
        }

        .message-container {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f0f0f0;
            text-align: center;
        }

        .message-container p {
            margin: 0;
        }

        .message-button {
            margin-top: 10px;
            padding: 10px 20px;
            background-color: black;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .message-button:hover {
            background-color: #333;
        }
    </style>
</head>
<body>
    <div class="search-container">
        <input type="text" class="search-input" placeholder="Cari domain contoh: example.com">
        <button id="search-button">CARI</button>
    </div>
    <div id="data-container"></div>
</body>

<script>
    document.getElementById('search-button').addEventListener('click', function() {
        const searchInput = document.querySelector('.search-input').value;
            fetch(`/fetch-data?domain=${encodeURIComponent(searchInput)}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    const dataContainer = document.getElementById('data-container');
                    if(data.status === 'available') {
                        dataContainer.innerHTML = `
                        <div class="message-container">
                            <p>Selamat domain ${searchInput} tersedia</p>
                            <button class="message-button" id="pesan-button">Pesan</button>
                        </div>
                        `;
                    } else {
                        dataContainer.innerHTML = `
                        <div class="message-container">
                            <p>Maaf domain ${searchInput} tidak tersedia</p>
                        </div>
                        `;
                    }
                })
                .catch(error => {
                    console.error('There has been a problem with your fetch operation:', error);
                });
        });

    document.getElementById('data-container').addEventListener('click', function() {
        if(event.target.id === 'pesan-button') {
            window.location.href = '/config?domain=' + encodeURIComponent(document.querySelector('.search-input').value);
        }
    });
</script>
</html>