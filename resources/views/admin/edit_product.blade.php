<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
    <style>
        /* Form styling */
        .form-group {
            margin-bottom: 1rem;
            width: 100%;
        }

        .form-group label {
            font-weight: bold;
            margin-bottom: 0.5rem;
            display: block;
        }

        .form-control,
        select {
            min-width: 250px;
        }

        .page-header {
            padding: 2rem 0;
        }

        /* Button alignment */
        .btn-primary {
            margin-top: 1.5rem;
        }

        /* Zoom effect on focus for text areas and input */
        input[type="text"]:focus,
        textarea:focus {
            transform: scale(1.05);
            transition: transform 0.2s ease-in-out;
            z-index: 1;
            position: relative;
        }

        /* Responsive adjustments */
        @media (max-width: 576px) {
            .form-group {
                width: 100%;
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
                <!-- Edit Product Form -->
                <form action="{{ url('update_product/' . $product->id) }}" method="POST" class="mb-4" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- We are using PUT method for update -->

                    <!-- Title -->
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" id="title" name="title" value="{{ old('title', $product->title) }}" placeholder="Enter Title" class="form-control" required>
                    </div>

                    <!-- Description -->
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" placeholder="Enter Description" class="form-control" rows="3" required>{{ old('description', $product->description) }}</textarea>
                    </div>

                    <!-- Price -->
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" name="price" id="price" placeholder="Enter Price" class="form-control" value="{{ old('price', $product->price) }}" required>
                    </div>

                    <!-- Product Category -->
                    <div class="form-group">
                        <label for="product_category">Product Category</label>
                        <select name="category_id" id="product_category" class="form-control" required>
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Quantity -->
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" name="quantity" id="quantity" placeholder="Enter Quantity" class="form-control" value="{{ old('quantity', $product->quantity) }}" required>
                    </div>

                    <!-- Current Image -->
                    <div class="form-group">
                        <label for="current_image">Current Image</label>
                        <div>
                            <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->title }}" style="width: 100px; height: auto;">
                        </div>
                    </div>

                    <!-- Image Upload (Optional) -->
                    <div class="form-group">
                        <label for="image">Change Product Image (Optional)</label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-success">Update Product</button>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript files-->
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
