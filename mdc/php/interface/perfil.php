<?php 
if ($userData['acesso'] == 1) { 
    ?>
    <div class="col-6 d-flex flex-column justify-content-center">
        <!-- CURSO -->
        <div class="mb-3">
            <label for="curso" class="form-label fw-bold">Curso</label>

            <select id="curso" name="modulo" class="form-select">
                <option selected value="">Selecione seu curso...</option>
                <option value="1">Informática para Internet</option>
                <option value="2">Mecatrônica</option>
                <option value="3">Internet das Coisas</option>
            </select>
        </div>

        <!-- MÓDULO -->
        <div class="mb-3">
            <label for="modulo" class="form-label fw-bold">Módulo</label>

            <select id="modulo" name="modulo" class="form-select">
                <option selected value="">Selecione seu módulo...</option>
                <option value="1">1° módulo</option>
                <option value="2">2° módulo</option>
                <option value="3">3° módulo</option>
                <option value="4">4° módulo</option>
                <option value="5">5° módulo</option>
                <option value="6">6° módulo</option>
            </select>
        </div>
    </div>
<?php
} else if ($userData['acesso'] == 2) {
    ?>
    <div class="mb-2">
        <label class="form-label" for="texto"> Regras de sala: </label><br>
        <textarea class="w-100" id="texto" name="texto" required rows="6"></textarea>
    </div>
<?php
}
?>