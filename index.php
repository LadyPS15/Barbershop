<?php include 'views/partials/header.php'; ?>

<link rel="stylesheet" href="assets/css/header.css"> 

<section id="servicios">
    <h2>Nuestros Servicios</h2>
    <div class="service-list">
        <div class="service-item">
            <h3>Corte de Cabello</h3>
            <p>Disfruta de un corte de cabello profesional que se adapta a tu estilo.</p>
            <img src="assets/image/SERVICIO1.png" alt="Corte de Cabello">
        </div>
        <div class="service-item">
            <h3>Afeitado Clásico</h3>
            <p>Un afeitado limpio y cómodo, utilizando productos de la más alta calidad.</p>
            <img src="assets/image/SERVICIO3.png" alt="Afeitado Clásico">
        </div>
        <div class="service-item">
            <h3>Tratamiento Capilar</h3>
            <p>Cuida tu cabello con nuestros tratamientos especializados para cada tipo de pelo.</p>
            <img src="assets/image/SERVICIO2.png" alt="Tratamiento Capilar">
        </div>
    </div>
</section>

<section id="productos">
    <h2>Productos Destacados</h2>
    <div class="product-list">
        <div class="product-item">
            <h3>Cera ultrafuerte</h3>
            <p>Cera de alta calidad para mantener tu estilo todo el día.</p>
            <img src="assets/image/PRODUCTO2.png" alt="Cera ultrafuerte">
        </div>
        <div class="product-item">
            <h3>Proraso</h3>
            <p>Protege y nutre tu cabello con nuestro acondicionador premium.</p>
            <img src="assets/image/PRODUCTO1.png" alt="Proraso">
        </div>
        <div class="product-item">
            <h3>Polvo voluminizador</h3>
            <p>La mejor marca para después del afeitado</p>
            <img src="assets/image/PRODUCTO4.png" alt="Polvo voluminizador">
        </div>
    </div>
</section>

<section id="reserva">
    <h2>Reserva tu Cita</h2>

    <!-- Mostrar mensaje de éxito si la cita fue creada -->
    <?php if (isset($_GET['success']) && $_GET['success'] === 'true'): ?>
        <div class="message success" style="background: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 15px; border-radius: 5px; margin-bottom: 15px; font-weight: bold; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
            ¡Cita reservada con éxito!
        </div>
    <?php endif; ?>

    <!-- Mostrar mensaje de error si ya existe una cita en esa fecha y hora -->
    <?php if (isset($_GET['error']) && $_GET['error'] === 'true'): ?>
        <div class="message error" style="background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 15px; border-radius: 5px; margin-bottom: 15px; font-weight: bold; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
            Ya existe una cita en esta fecha y hora. Por favor, elige otro horario.
        </div>
    <?php endif; ?>

    <!-- Formulario para la reserva de citas -->
    <form action="views/appointmrnts.php" method="POST">
        <!-- Cambiar "Selecciona tu nombre" a "Ingresa tu nombre" -->
        <label for="client_name">Ingresa tu nombre:</label>
        <input type="text" name="client_name" required placeholder="Tu nombre completo">

        <label for="client_phone">Ingresa tu número de celular:</label>
        <input type="text" name="client_phone" required placeholder="Tu número de celular">

        <label for="barber_id">Selecciona el barbero:</label>
        <br>
        <select name="barber_id" required>
            <!-- Listar todos los barberos -->
            <?php
            require_once './controllers/adminController.php'; // Corregido con la ruta relativa
            $barbers = getAllBarbers();
            foreach ($barbers as $barber) {
                echo "<option value='{$barber['id']}'>{$barber['barber_name']}</option>";
            }
            ?>
        </select>
        <br>
        <br>
        <label for="date">Selecciona la fecha:</label>
        <input type="date" name="date" required>

        <label for="time">Selecciona la hora:</label>
        <input type="time" name="time" required>
        <br>
        <label for="services">Selecciona los servicios:</label>
        <br>
        <select name="services[]" multiple required>
            <!-- Listar todos los servicios disponibles -->
            <?php
            $services = getAllServices();
            foreach ($services as $service) {
                echo "<option value='{$service['id']}'>{$service['service_name']} - {$service['base_price']} USD</option>";
            }
            ?>
        </select>
            <br>
            <br>
            <br>
        <button type="submit">Reservar</button>
    </form>

</section>

<?php include 'views/partials/footer.php'; ?> 
