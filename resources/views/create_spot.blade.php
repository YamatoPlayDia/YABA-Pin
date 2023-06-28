<!DOCTYPE html>
<html>
<head>
    <title>Create Profile</title>
    <!-- CSS only -->
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 mt-5">
        <form id="spotForm">
            <div class="mb-4">
                <label for="type" class="block text-gray-700">Type</label>
                <input type="text" class="form-control" id="type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Name</label>
                <input type="text" class="form-control" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <div class="mb-4">
                <label for="latitude" class="block text-gray-700">Latitude</label>
                <input type="number" step="0.000001" class="form-control" id="latitude" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <div class="mb-4">
                <label for="longitude" class="block text-gray-700">Longitude</label>
                <input type="number" step="0.000001" class="form-control" id="longitude" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <button type="submit" class="btn btn-primary bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create</button>
        </form>
    </div>

    @vite('resources/js/app.js')

    <!-- Custom JS -->
    @vite('resources/js/create_spot.js')
</body>
</html>
