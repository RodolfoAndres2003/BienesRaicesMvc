<main class="contenedor seccion contenido-centrado">
    <h1 class="fw-300 centrar-texto">Contacto</h1>
    <?php if($mensaje) { ?>
        <p class="alerta exito"><?php echo $mensaje; ?></p>
    <?php } ?>
    <picture>
        <source srcset="buil/img/destacada3.webp" type="img/webp">
        <source srcset="buil/img/destacada3.jpeg" type="img/jpeg">
        <img loading="lazy" src="build/img/destacada3.jpg" alt="imagen contacto">
    </picture>
    
    <h2 class="fw-300 centrar-texto">Llena el formulario de Contacto</h2>

    <form class="formulario" method="POST" action="/contacto">
        <fieldset>
            <legend>Información Personal</legend>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" placeholder="Tu Nombre" name="contacto[nombre]" >
            <label for="mensaje">Mensaje: </label>
            <textarea id="mensaje" name="contacto[mensaje]" ></textarea>

        </fieldset>


        <fieldset>
            <legend>Información sobre Propiedad</legend>
            <label for="opciones">Vende o Compra</label>
            <select id="opciones" name="contacto[tipo]" >
                <option value="" disabled selected>-- Seleccione --</option>
                <option value="Compra">Compra</option>
                <option value="Vende">Vende</option>
            </select>

            <label for="presupuesto">Presupuesto:</label>
            <input type="number" placeholder="Su presupuesto..." id="presupuesto" name="contacto[precio]" >
        </fieldset>

        <fieldset>
            <legend>Contacto</legend>

            <div class="forma-contacto">
                <label for="telefono">Teléfono</label>
                <input type="radio" value="telefono" id="telefono" name="contacto[contacto]" >

                <label for="correo">E-mail</label>
                <input type="radio" value="correo" id="correo" name="contacto[contacto]" >
            </div>
            <div id="contacto"></div>

        </fieldset>

        <input type="submit" value="Enviar" class="boton boton-verde">

    </form>
</main>
