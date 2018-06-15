<h1>All Users</h1>
<div class="table-responsive">
    <table class="table table-hover table-striped">
        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Login</th>
            <th>Address</th>
            <th>Role</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($users as $user): ?>
            <tr>
                <td><?=$user->id?></td>
                <td><?=$user->name?></td>
                <td><?=$user->email?></td>
                <td><?=$user->login?></td>
                <td><?=$user->address?></td>
                <td><?=$user->role?></td>
        <?php endforeach;?>
<!--        <tr>-->
<!--            <td>Total quantity: </td>-->
<!--            <td colspan="4" class="text-right cart-qty">--><?//=$_SESSION['cart_qty']?><!--</td>-->
<!--        </tr>-->
<!--        <tr>-->
<!--            <td>Total sum: </td>-->
<!--            <td colspan="4" class="text-right cart-sum">--><?//=$_SESSION['cart_currency']['symbol_left'] . $_SESSION['cart_sum'] . $_SESSION['cart_currency']['symbol_right']?><!--</td>-->
<!--        </tr>-->
        </tbody>
    </table>
</div>