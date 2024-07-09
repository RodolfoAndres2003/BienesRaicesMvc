<fieldset>
    <legend>Información General</legend>
    <label for="nombre">Nombre:</label>
    <input name="vendedor[nombre]" type="text" id="nombre" placeholder="Nombre Vendedor(a)" value="<?php echo  s($vendedores->nombre);?>">

    <label for="apellido">apellido: </label>
    <input name="vendedor[apellido]" type="text" id="apellido" placeholder="Apellido Vendedor(a)" value="<?php echo s($vendedores->apellido); ?>">

</fieldset>

<fieldset>
    <legend>Informacion Extra</legend>
    <label for="telefono">Telefono:</label>
    <input name="vendedor[telefono]" type="number" id="telefono" placeholder="58 412 555 5555" value="<?php echo s($vendedores->telefono); ?>">
</fieldset>