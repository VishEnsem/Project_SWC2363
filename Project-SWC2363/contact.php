<?php include 'includes/header.php'; ?>

<div class="container">
    <h2>Contact Us</h2>
    <p>If you have any questions, concerns, or feedback, please fill out the form below, and we’ll get back to you as soon as possible.</p>

    <!-- Form to trigger the popup without submitting -->
    <form id="contactForm" method="POST">
        <label for="name">Name:</label>
        <input type="text" name="name" required><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br><br>

        <label for="message">Message:</label>
        <textarea name="message" rows="6" required></textarea><br><br>

        <!-- Use label as a fake submit button -->
        <button><label for="popupTrigger" class="submit-btn">Send Message</label></button>
    </form>

    <h3>Our Contact Information</h3>
    <p>Email: support@shoppee.com</p>
    <p>Phone: +123 456 7890</p>
    <p>Address: 123 Shoppee St, E-commerce City</p>
</div>

<?php include 'includes/footer.php'; ?>
