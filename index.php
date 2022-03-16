<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="index.js"></script>

    <title>Cars CRUD</title>

    <style>
        body {
            background: linear-gradient(to top, rgba(54, 74, 255, 0.8), rgba(54, 232, 193, 0.8));
            
            min-height: 100vh;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col text-center">
                <h3> Read All </h3>
                <button class="btn btn-outline-primary" id="read_all_button">Go</button>
            </div>
            <div class="col text-center">
                <h3> Search </h3>
                <button class="btn btn-outline-primary" id="search_button">Go</button>
            </div>
            <div class="col text-center">
                <h3> Create </h3>
                <button class="btn btn-outline-primary" id="create_button">Go</button>
            </div>
            <div class="col text-center">
                <h3> Update </h3>
                <button class="btn btn-outline-primary" id="update_button">Go</button>
            </div>
            <div class="col text-center">
                <h3> Delete </h3>
                <button class="btn btn-outline-primary" id="delete_button">Go</button>
            </div>
        </div>
    </div>

    <!-- ajax is used because everything happens on the same page -->

    <!-- SEARCH -->
    <form class="text-center" id="search_form" style="display: none;">
        <h5><u>Search by anything:</u></h5>
        <input type="text" id="search_word" placeholder="id, make, year ...."><br>
        <input type="submit" name="submit" value="Search">
    </form>

    <!-- CREATE -->
    <form class="text-center" id="create_form" style="display: none;">
        <h5><u>Create</u></h5>
        <label for="make">Make</label><br>
        <input type="text" name="make"><br>
        <label for="model">Model</label><br>
        <input type="text" name="model"><br>
        <label for="type">Type</label><br>
        <input type="text" name="type"><br>
        <label for="year">Year</label><br>
        <input type="text" name="year"><br>
        <input type="submit" name="submit" value="Submit">
    </form>

    <!-- UPDATE -->
    <form class="text-center" id="update_form" style="display: none;">
        <h5><u>Update</u></h5>
        <label for="car_id">ID</label><br>
        <input type="text" name="car_id" required><br>
        <label for="make">Make</label><br>
        <input type="text" name="make"><br>
        <label for="model">Model</label><br>
        <input type="text" name="model"><br>
        <label for="type">Type</label><br>
        <input type="text" name="type"><br>
        <label for="year">Year</label><br>
        <input type="text" name="year"><br>
        <input type="submit" name="submit" value="Submit">
    </form>

    <!-- DELETE -->
    <form class="text-center" id="delete_form" style="display: none;">
        <h5><u>Delete by id:</u></h5>
        <select name="car_id" id="car_id">
            <option></option>
        </select>
    </form>

    <div class="container text-center">
        <p class="data"></p>
        <table class="table" style="display: none;">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Make</th>
                    <th scope="col">Model</th>
                    <th scope="col">Type</th>
                    <th scope="col">Year</th>
                </tr>
            </thead>
        </table>
    </div>

</body>

</html>