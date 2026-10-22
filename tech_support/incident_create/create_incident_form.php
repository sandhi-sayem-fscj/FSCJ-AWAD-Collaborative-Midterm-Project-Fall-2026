<?php include '../view/header.php'; ?>
<main>
    <h2 id="incident-header">Create Incident</h2>
    <form action="index.php" id="incident-form" method="post">
        <input type="hidden" name="action" value="create_incident_confirmation">
        <input type="hidden" name="incident-customer-id" value="<?php echo htmlspecialchars($user_data['customerID']); ?>">

        <label>Customer:</label>
        <span><?php echo htmlspecialchars($user_data['fullName']); ?></span>

        <label for="incident-product">Product:</label>
        <select id="incident-product" name="incident-product">
            <?php foreach ($user_products as $product) : ?>
                <option value="<?php echo htmlspecialchars($product['productCode']); ?>">
                    <?php echo htmlspecialchars($product['name']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="incident-title">Title:</label>
        <input type="text" id="incident-title" name="incident-title">

        <label for="incident-description">Description:</label>
        <textarea id="incident-description" name="incident-description" rows="5" cols="50"></textarea>

        <input id="create-incident" type="submit" value="Create Incident">
    </form>
</main>

<style>
    #incident-form {
        display: grid;
        grid-template-columns: 8em auto;
        justify-content: start;
        align-items: center;
        gap: 8px 0;
    }

    #incident-form select,
    #incident-form input[type="text"] {
        justify-self: start;
    }

    #incident-form select {
        width: 177px;
    }

    #incident-form label[for="incident-description"],
    #incident-form textarea {
        align-self: start;
    }

    #incident-form #create-incident {
        grid-column: 2;
        justify-self: start;
    }
</style>

<?php include '../view/footer.php'; ?>