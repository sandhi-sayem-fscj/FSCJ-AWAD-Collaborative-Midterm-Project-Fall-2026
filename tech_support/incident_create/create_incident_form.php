<?php include '../view/header.php'; ?>
<main>
    <h2 id="incident-header">Create Incident</h2>
    <form action="incident_create/index.php" id="incident-form" method="post">
        <input type="hidden" name="action" value="create_incident_confirmation">
        <div>
            <label for="incident-customer">Customer: </label>
            <span style="margin-left: 62px;">
                 <?php echo htmlspecialchars($userData['fullName']); ?>
            </span>
        </div>

        <div>
            <label for="incident-product">Product: </label>
            <select name="incident-product" form="incident-form">
                <?php // Code for displaying options dynamically
                foreach ($products as $product) {
                    echo "<option value='{$product['productCode']}'>{$product['name']}</option>";
                }
                ?>
            </select>  
        </div>

        <div>
            <label for="incident-title">Title: </label>
            <input style="margin-left: 95px;" type="text" name="incident-customer">
        </div>

        <div>
            <label style="position: relative; bottom: 70px;" for="incident-description">Description: </label>
            <textarea style="margin-left: 50px;" name="incident-description" rows="5" cols="50"></textarea>
        </div>

        <input id="create-incident" type="submit" value="Create Incident">
    </form>
    </div>

</main>

<style>
    #incident-header {
        margin-bottom: 0;
    }

    #incident-form {
        div {
            margin: 8px 0 8px 0;

            select {
                margin-left: 75px; 
                height: 22px; 
                width: 177px;
            }
        }

        #create-incident {
            margin-left: 133px;
        }
    }
    
</style>

<?php include '../view/footer.php'; ?>