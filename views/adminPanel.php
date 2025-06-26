<?php include 'views/partials/header.php'; ?>

<h2>Hola, Pedro</h2>

<h3>Clientes Frecuentes</h3>
<ul>
    <?php foreach ($frequentClients as $client): ?>
        <li><?php echo $client['client_name']; ?> - <?php echo $client['visits']; ?> visitas</li>
    <?php endforeach; ?>
</ul>

<h3>Ingresos del Mes</h3>
<p><?php echo $monthlyIncome['total_income']; ?> USD</p>

<?php include 'views/partials/footer.php'; ?>
