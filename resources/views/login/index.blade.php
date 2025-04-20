<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | CV. Java Metalindo</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700;900&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Nunito', sans-serif;
            /* background: linear-gradient(135deg, #001f3f, #003f7f); */
            background-color: #00234b;

            color: white;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 2rem;
        }

        .content {
            display: flex;
            background-color: #00234b;
            border-radius: 8px;
            overflow: hidden;
            max-width: 1200px;
            width: 80%;
            height: auto;
            font-size: 1.5rem;
            padding: 6rem 2rem;
            margin: 0 auto;
        }

        .left {
            flex: 1;
            padding: 2rem;
        }

        .left h1 {
            font-size: 2.5rem;
            font-weight: 900;
            margin-bottom: 1rem;
        }

        .left h1 span {
            color: #e74c3c;
        }

        .left p {
            font-size: 1rem;
            font-weight: 600;
            margin-top: 1rem;
            line-height: 1.7;
        }

        .right {
            background-color: #fff;
            flex: 1;
            padding: 2rem;
            color: black;
            display: flex;
            flex-direction: column;
            justify-content: center;
            border-radius: 0 8px 8px 0;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .right img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 1rem;
        }

        .right h3 {
            text-align: center;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #005be4;
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 1rem;
        }

        button:hover {
            background-color: #003fa5;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        @media (max-width: 768px) {
            .content {
                flex-direction: column;
            }

            .right {
                border-radius: 0 0 8px 8px;
            }

            .left {
                text-align: center;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="content">
            <div class="left">
                <h1>CV. Java Metalindo</h1>
                <h1>Perusahaan Yang Bergerak<br>Di Bidang Penjualan<br><span>Besi Tua</span></h1>
                <p>Memudahkan staff administrasi dalam mengelola data perusahaan seperti barang masuk, barang keluar,
                    pengelolaan data penjualan serta membantu kepala perusahaan dalam memantau perkembangan usaha yang
                    dimiliki</p>
            </div>
            <div class="right">
                <img src="img/login1.jpg" alt="Gambar Login">
                <h3>MASUK SISTEM INFORMASI</h3>
                <form action="/login" method="POST">
                    <div class="form-group">
                        <input type="text" name="username" placeholder="username" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" placeholder="password" required>
                    </div>
                    <button type="submit">Login</button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>
