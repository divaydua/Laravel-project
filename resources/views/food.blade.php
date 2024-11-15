<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Menu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #343a40;
            color: white;
            padding: 1em 2em;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            margin: 0 1em;
        }
        .navbar a:hover {
            text-decoration: underline;
        }
        .hero {
            background: url('https://source.unsplash.com/1600x900/?food') no-repeat center center/cover;
            color: white;
            text-align: center;
            padding: 4em 2em;
        }
        .hero h1 {
            font-size: 3em;
            margin: 0;
        }
        .hero p {
            font-size: 1.5em;
            margin-top: 1em;
        }
        .menu {
            max-width: 800px;
            margin: 2em auto;
            padding: 1em;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .menu h2 {
            text-align: center;
            margin-bottom: 1em;
            color: #343a40;
        }
        .menu-item {
            display: flex;
            margin-bottom: 1.5em;
        }
        .menu-item img {
            width: 150px;
            height: 150px;
            border-radius: 8px;
            margin-right: 1em;
        }
        .menu-item h3 {
            margin: 0 0 0.5em;
        }
        .menu-item p {
            margin: 0;
            color: #555;
        }
        .footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 1em;
            margin-top: 2em;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>Foodie's Paradise</h1>
        <nav>
            <a href="/">Home</a>
            <a href="/menu">Menu</a>
            <a href="/contact">Contact</a>
        </nav>
    </div>

    <div class="hero">
        <h1>Welcome to Foodie's Paradise</h1>
        <p>Explore our delicious menu crafted just for you!</p>
    </div>

    <div class="menu">
        <h2>Our Specials</h2>
        
        <div class="menu-item">
            <img src="https://source.unsplash.com/150x150/?pizza" alt="Pizza">
            <div>
                <h3>Margherita Pizza</h3>
                <p>A classic Italian pizza with fresh mozzarella, basil, and a rich tomato sauce.</p>
            </div>
        </div>

        <div class="menu-item">
            <img src="https://source.unsplash.com/150x150/?burger" alt="Burger">
            <div>
                <h3>Cheeseburger Deluxe</h3>
                <p>Juicy beef patty topped with melted cheese, crispy lettuce, and tomatoes.</p>
            </div>
        </div>

        <div class="menu-item">
            <img src="https://source.unsplash.com/150x150/?sushi" alt="Sushi">
            <div>
                <h3>Sushi Platter</h3>
                <p>A variety of fresh sushi rolls served with soy sauce, wasabi, and pickled ginger.</p>
            </div>
        </div>

        <div class="menu-item">
            <img src="https://source.unsplash.com/150x150/?dessert" alt="Dessert">
            <div>
                <h3>Chocolate Lava Cake</h3>
                <p>Warm molten chocolate cake with a gooey center, served with vanilla ice cream.</p>
            </div>
        </div>
    </div>

    <div class="footer">
        <p>&copy; 2024 Foodie's Paradise. All rights reserved.</p>
    </div>
</body>
</html>