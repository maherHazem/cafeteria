<form action="services/coffeeReserveService.php" method="post">
    <fieldset class="formDiv">
        <input type="hidden" name="id" id="id" value="<?=$mesa['id']?>">
        <legend>Gestionando reserva de la mesa <?=$mesa['n_mesa']?> para hoy</legend>
        <label for="details" class="formLabel">
            Detalles:
            <textarea name="details" id="details" placeholder="Cumpleaños, juntar mesas..."><?=$mesa['detalles']?></textarea>
        </label>
        <label for="date" class="formLabel">
            Hora:
            <input type="time" name="date" id="date" value="<?=$mesa['hora_reserva']!=null?date('H:i:s', strtotime($mesa['hora_reserva'])):''?>">
        </label>
        <label for="name" class="formLabel">
            Nombre de reserva:
            <input type="text" name="name" id="name" value="<?=$mesa['nombre_reserva']!=null?$mesa['nombre_reserva']:''?>">
        </label>
        <div class="formdiv">
            <label for="submit" class="formLabel">
                Enviar:
                <input type="submit" value="Enviar" id="submit">
            </label>
            <label for="cancel" class="formLabel">
                Cancelar reserva:
                <input type="submit" value="Cancelar reserva" id="cancel" name="cancel">
            </label>
        </div>
    </fieldset>
</form> 