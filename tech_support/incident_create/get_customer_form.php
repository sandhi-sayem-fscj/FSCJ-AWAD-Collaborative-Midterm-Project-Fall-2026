<?php include '../view/header.php'; ?>
<main>
<h2>Get Customer</h2>
<p>You must enter the customer's email address to select the customer.</p>
<form action="index.php" method="post" id="get-customer-form">
    <input type="hidden" name="action" value="create_incident_form">

    <label>Email:</label>

    <!-- clear validation when user begins to type (CR) -->
    <input style="margin-left: 3px;"
        type="email"
        id="customer-email"
        name="customer-email"
        value="<?php echo htmlspecialchars($clean_email ?? '', ENT_QUOTES, 'UTF-8'); ?>"
        required
        oninput="this.setCustomValidity('')">

    <input style="margin-left: 3px;" type="submit" value="Get Customer">
</form>

<!-- refers back to email_error in index.php (CR) -->
<?php if (!empty($email_error)) : ?>
<script>
    window.addEventListener('load', function() {
        const emailField = document.getElementById('customer-email');

        emailField.setCustomValidity(
            <?php echo json_encode($email_error); ?>
        );

        emailField.reportValidity();
    });
</script>
<?php endif; ?>

</main>

<?php include '../view/footer.php'; ?>
