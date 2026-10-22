<?php include '../view/header.php'; ?>
<main>
<h2>Get Customer</h2>
<p>You must enter the customer's email address to select the customer.</p>
<form action="incident_create/index.php" method="post" id="get-customer-form">
    <input type="hidden" name="action" value="create_incident_form">

    <label>Email:</label>
    <input style="margin-left: 3px;" type="email" name="customer-email">
    <input style="margin-left: 3px;" type="submit" value="Get Customer">
</form>
</main>

<?php include '../view/footer.php'; ?>