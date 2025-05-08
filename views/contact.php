<?php include '../includes/header.php'; ?>

<header>
    <title>Contact</title>
    <link rel="stylesheet" href="../assets/css/contact.css">
</header>

<body>
    <div class="contact-form">
        <h2>Contact Us</h2>
        <form action="#" method="post">
            <div class="form-group">
                <input type="text" name="name" placeholder="Your name" required>
                <input type="email" name="email" placeholder="Your email" required>
            </div>
            <input type="text" name="subject" placeholder="Your subject">
            <textarea name="message" placeholder="Write your message" required></textarea>
            <button type="submit">SEND MESSAGE</button>
        </form>
    </div>
</body>