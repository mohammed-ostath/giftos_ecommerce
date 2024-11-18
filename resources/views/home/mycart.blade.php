<!DOCTYPE html>
<html lang="en">

<head>
    @include('home.css')
    <style>
        /* General Styling */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        .hero_area {
            background-color: #fff;
            padding: 20px;
            text-align: center;
        }

        /* Layout Container for Form and Table */
        .container {
            display: flex;
            justify-content: space-between;
            margin: 40px auto;
            width: 90%;
            max-width: 1200px;
            gap: 20px;
        }

        /* Table Container (Make it bigger than the form) */
        .table-container {
            flex: 2; /* This will make the table container take up more space */
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-right: 20px;
            overflow-x: auto;
        }

        /* Receiver Form (Take less space than the table) */
        .form-container {
            flex: 1; /* This will make the form container take up less space */
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-left: 20px;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 16px;
            color: #333;
            text-align: left;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* Table Header */
        th {
            padding: 14px;
            background-color: #f7f7f7;
            color: #333;
            text-transform: uppercase;
            font-weight: bold;
            letter-spacing: 1px;
            border-bottom: 2px solid #ddd;
        }

        /* Table Data */
        td {
            padding: 12px;
            border-bottom: 1px solid #f2f2f2;
        }

        /* Hover Effect on Table Rows */
        tr:hover {
            background-color: #f1f1f1;
            cursor: pointer;
        }

        /* Alternate Row Colors */
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* Image Styling */
        img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        /* Image Hover Effect */
        img:hover {
            transform: scale(1.05);
        }

        /* Remove Button */
        .remove-btn {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 6px 12px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 14px;
            transition: background-color 0.3s;
        }

        .remove-btn:hover {
            background-color: #c0392b;
        }

        /* Form Styling */
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        form div {
            margin-bottom: 15px;
        }

        form label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        form input,
        form textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            color: #555;
        }

        form input[type="text"] {
            margin-bottom: 15px;
        }

        form input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 12px 20px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
            width: 100%;
            transition: background-color 0.3s;
        }

        form input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .total-price {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            padding: 20px 0;
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="hero_area">
        <!-- header section starts -->
        @include('home.header')
        <!-- end header section -->
    </div>
    <!-- end hero area -->

    <!-- Container for Table and Form -->
    <div class="container">
        <!-- Receiver Form -->
        <div class="form-container">
            <form action="{{url('confirm_order')}}" method="POST">
                @csrf
                <div>
                    <label for="name">Receiver Name</label>
                    <input type="text" name="name" id="name" value="{{Auth::user()->name}}" required>
                </div>

                <div>
                    <label for="address">Receiver Address</label>
                    <textarea name="address" id="address" cols="30" rows="5"  required>{{Auth::user()->address}}</textarea>
                </div>

                <div>
                    <label for="phone">Receiver Phone</label>
                    <input type="text" name="phone" value="{{Auth::user()->phone}}" required>
                </div>

                <input class="btn btn-primary" type="submit" value="Send">
            </form>
        </div>

        <!-- Table Container -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Product Title</th>
                        <th>Product Price</th>
                        <th>Image</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $value = 0;
                    ?>
                    @foreach ($cart as $cart)
                        <tr>
                            <td>{{ $cart->product->title ?? 'Product not found' }}</td>
                            <td>${{ number_format($cart->product->price ?? 0, 2) }}</td>
                            <td>
                                <img src="{{ asset('images/' . $cart->product->image) }}" alt="{{ $cart->product->title }}">
                            </td>
                            <td>
                                <!-- Remove Button -->
                                <form action="{{ url('removecart', $cart->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="remove-btn">Remove</button>
                                </form>
                            </td>
                        </tr>

                        <?php
                        $value = $value + $cart->product->price;
                        ?>
                    @endforeach
                </tbody>
            </table>
            <div class="total-price">
                <h3>Total value of cart is : ${{ number_format($value, 2) }}</h3>
            </div>
        </div>
    </div>

    <!-- Footer -->
    @include('home.footer')
</body>

</html>
