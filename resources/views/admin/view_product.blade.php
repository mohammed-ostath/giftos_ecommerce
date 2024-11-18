<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
    <style>
        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
            font-size: 14px;
        }

        table th {
            background-color: #f4f4f4;
            font-weight: bold;
        }

        /* Hover effect for table rows */
        table tr:hover {
            background-color: #f1f1f1;
        }

        /* Action Buttons Styling */
        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
            /* Space between buttons */
        }

        .btn {
            padding: 8px 16px;
            font-size: 14px;
            border-radius: 5px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-block;
            text-decoration: none;
            border: none;
        }

        /* Edit Button (Primary) */
        .btn-primary {
            background-color: #007bff;
            color: white;
            border: 1px solid #007bff;
        }

        /* Delete Button (Danger) */
        .btn-danger {
            background-color: #dc3545;
            color: white;
            border: 1px solid #dc3545;
        }

        /* Hover effect for all buttons */
        .btn:hover {
            transform: scale(1.05);
            /* Slight zoom effect */
            opacity: 0.9;
            /* Slight transparency on hover */
        }

        /* Hover effect for Edit Button */
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        /* Hover effect for Delete Button */
        .btn-danger:hover {
            background-color: #c82333;
            border-color: #c82333;
        }

        /* Focus effect for buttons */
        .btn:focus {
            outline: none;
            box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.5);
            /* Blue outline on focus */
        }

        /* Delete Button Form Styling */
        .delete-form {
            display: inline-block;
            margin: 0;
            padding: 0;
            margin-left: 10px;
        }

        /* Delete Button Styling */
        .delete-btn {
            cursor: pointer;
            font-size: 14px;
            padding: 8px 16px;
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        /* Hover effect for Delete Button */
        .delete-btn:hover {
            background-color: #c82333;
            transform: scale(1.05);
            /* Slight zoom effect */
        }

        /* Image Styling */
        img {
            width: 100px;
            height: auto;
            border-radius: 4px;
        }

        /* Responsiveness */
        @media (max-width: 768px) {

            /* Smaller font size and padding for table cells */
            table th,
            table td {
                font-size: 12px;
                padding: 8px;
            }

            /* Stack action buttons vertically for mobile view */
            .action-buttons {
                flex-direction: column;
                gap: 8px;
            }

            /* Full-width buttons on smaller screens */
            .btn {
                width: 100%;
                text-align: center;
            }

            /* Adjust image size for mobile */
            img {
                width: 80px;
            }
        }
    </style>
</head>

<body>
    @include('admin.header')
    @include('admin.sidebar')

    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">

                <form action="{{url('product_search')}}" method="GET">
                    <input type="search" name="search" placeholder="Search">
                    <input type="submit" value="search" class="btn btn-secondary">
                </form>

                <!-- Product Table -->
                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Category</th>
                            <th>Quantity</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->title }}</td>
                                <td>{{ $product->description }}</td>
                                <td>${{ $product->price }}</td>
                                <td>{{ $product->category_id }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>
                                    <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->title }}">
                                </td>
                                <td class="action-buttons">
                                    <!-- Edit Button -->
                                    <a href="{{ url('edit_product/' . $product->id) }}"
                                        class="btn btn-success edit-btn">Edit</a>
                                    <!-- Delete Button -->
                                    <form action="{{ url('delete_product/' . $product->id) }}" method="POST"
                                        class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger delete-btn">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- JavaScript files -->
    <script src="{{ asset('admincss/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/popper.js/umd/popper.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/jquery.cookie/jquery.cookie.js') }}"></script>
    <script src="{{ asset('admincss/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('admincss/js/charts-home.js') }}"></script>
    <script src="{{ asset('admincss/js/front.js') }}"></script>
</body>

</html>
